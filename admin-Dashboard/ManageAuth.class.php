<?php

namespace AdminDashboard;

use DataBase\DataBase;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once(realpath(dirname(__FILE__) . "/mail/vendor/autoload.php"));

class ManageAuth
{




    // i'm get help from https://github.com/firebase/php-jwt
    private $key = "Youre secret key";

    private $chars = "Your captcha chars";

    function __construct()
    {
        session_start();
    }


    protected function dayToS($day)
    {
        return $day * 24 * 60 * 60;
    }

    protected function hashPass($input)
    {
        return password_hash($input, PASSWORD_BCRYPT, ["cost" => 10]);
    }

    protected function hashValue($input)
    {
        //$this->getIp()
        return hash_hmac("SHA512", $input, $this->key);
    }


    protected function generateString($strength = 10)
    {
        $chars = $this->chars;
        $input_length = strlen($chars);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    public function captcha()
    {
        $image = imagecreatetruecolor(200, 50);

        imageantialias($image, true);

        $colors = [];

        $red = rand(125, 175);
        $green = rand(125, 175);
        $blue = rand(125, 175);

        for ($i = 0; $i < 5; $i++) {
            $colors[] = imagecolorallocate($image, $red - 20 * $i, $green - 20 * $i, $blue - 20 * $i);
        }

        imagefill($image, 0, 0, $colors[0]);

        for ($i = 0; $i < 10; $i++) {
            imagesetthickness($image, rand(2, 10));
            $line_color = $colors[rand(1, 4)];
            imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $line_color);
        }

        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $textColors = [$black, $white];

        $fonts = [dirname(__FILE__) . '/Captcha-Fonts/hard1.ttf', dirname(__FILE__) . '/Captcha-Fonts/hard3.ttf', dirname(__FILE__) . '/Captcha-Fonts/hard4.ttf', dirname(__FILE__) . '/Captcha-Fonts/hard5.ttf', dirname(__FILE__) . '/Captcha-Fonts/hard6.ttf'];

        $stringLength = 6;
        $captchaString = $this->generateString($stringLength);


        for ($i = 0; $i < $stringLength; $i++) {
            $letter_space = 170 / $stringLength;
            $initial = 15;

            imagettftext($image, 24, rand(-15, 15), $initial + $i * $letter_space, rand(25, 45), $textColors[rand(0, 1)], $fonts[array_rand($fonts)], $captchaString[$i]);
        }

        if (isset($_SESSION['captchaText'])) {
            $this->removeSession("captchaText");
            $this->setSession("captchaText", $captchaString);
        } else {
            $this->setSession("captchaText", $captchaString);
        }
        return $image;
    }


    protected function checkCaptcha($captchaValue)
    {
        if (isset($_SESSION['captchaText'])) {
            if ($captchaValue == $_SESSION['captchaText']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    protected function getPrtocol()
    {
        return stripos($_SERVER['SERVER_PROTOCOL'], "http") === true ? "https://" : "http://";
    }

    protected function getHostName()
    {
        return $_SERVER['HTTP_HOST'];
    }

    protected function getHtmlTemplate($header, $body, $subBody, $footer)
    {
        $template = '
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="margin: 0px auto;padding: 0px">
<h2 style="background-color: #333333;color: snow; padding: 30px;text-align: center; width: 100%;">' . $header . '</h2>
<div style="width: 100%; padding: 25px;
margin-top: 15px;text-align: center">
    <div style=" margin: 20px 0px; font-size: 20px">' . $body . '</div>
    <div>' . $subBody . '</div>
</div>

<div style="width: 100%; margin-top: 30px; padding: 30px; text-align: center; color: #3366ff;font-size: 25px">
           ' . $footer . '
        </div>
</body>
</html>
        ';
        return $template;
    }



    protected function activeCookie()
    {
        setcookie("test", "test", time() + 3600, "/");
        if (count($_COOKIE) > 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function generateCode($length)
    {
        $content = "";
        for ($i = 0; $i <= $length; $i++) {
            $random = rand(0, 9);
            $content .= $random;
        }
        return $content;
    }

    protected function saveImage($image, $imagepath, $imagename = NULL)
    {


        if ($imagename) {
            $splitimage = explode("/", $image['type']);
            $imagename = $imagename . "." . substr($image['type'], strlen($splitimage[0]) + 1, strlen($image['type']));
        } else {
            $b = rand(1, 93472829); //کاهش خطا های احتمالی
            $splitimage = explode("/", $image['type']);
            $imagename = jdate('Y-n-j', '', '', 'Asia/Tehran', 'en') . "_" . jdate('H-i-s', '', '', 'Asia/Tehran', 'en') . "_" . $b . "_" . "." . substr($image['type'], strlen($splitimage[0]) + 1, strlen($image['type']));
        }

        $imagetmp = $image['tmp_name'];
        $imagepath = "public/images/" . $imagepath . "/";

        if (is_uploaded_file($imagetmp)) {
            if (move_uploaded_file($imagetmp, $imagepath . $imagename)) {
                return $imagepath . $imagename;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    protected function removeImage($imagePath)
    {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/" . $imagePath;
        unlink($imagePath);
    }

    protected function sendMail($name, $subject, $body, $address)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );


            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "Your usename";
            $mail->Password = "Your password";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->isHTML(true);


            $mail->setFrom("Yourcms@gmail.com", $name);
            $mail->addAddress($address);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "cant send mail for " . $mail->ErrorInfo;
            return false;
        }
    }



    protected function getValueFromCookieOrSession($name)
    {
        if (isset($_COOKIE[$name])) {
            $payload = $this->jwtDecode($_COOKIE[$name]);
            if ($payload) {
                $payload = (array)$payload;
                return $payload;
            } else {
                return false;
            }
        } elseif ($_SESSION[$name]) {
            $payload = $this->jwtDecode($_SESSION[$name]);
            if (isset($payload["sessionDuration"]) && isset($payload["loginTime"])) {
                if ($this->checkSessionExp($_SESSION[$name])) {
                    if ($payload) {
                        $payload = (array)$payload;
                        return $payload;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                $payload = $this->jwtDecode($_SESSION[$name]);
                if ($payload) {
                    $payload = (array)$payload;
                    return $payload;
                } else {
                    return false;
                }
            }
        }
    }

    protected function setCookie($cookieName, $cookieValue, $day, $remove = false, $place = "/")
    {
        if ($remove) {
            $valueCrypt = $cookieValue;
            setcookie($cookieName, $valueCrypt, time() - 3600, $place);
        } else {
            $valueCrypt = $cookieValue;
            setcookie($cookieName, $valueCrypt, time() + $this->dayToS($day), $place);
        }
    }

    protected function removeCookie($cookieName, $place = "/")
    {
        setcookie($cookieName, $_COOKIE[$cookieName], time() - 3600, $place);
    }

    protected function checkCookie($cookieName)
    {
        if (isset($_COOKIE[$cookieName])) {
            $head = $this->jwtDecode($_COOKIE[$cookieName], "head");
            $payload =  $this->jwtDecode($_COOKIE[$cookieName]);
            $sig =  $this->jwtDecode($_COOKIE[$cookieName], "sig");
            if ($this->jwtVerify($head, $payload, $sig)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setSession($sessionName, $sessionValue)
    {
        $_SESSION[$sessionName] = $sessionValue;
    }

    protected function removeSession($sessionName)
    {
        if (isset($_SESSION[$sessionName])) {
            unset($_SESSION[$sessionName]);
            return true;
        } else {
            return false;
        }
    }

    protected function checkSession($sessionName)
    {
        if (isset($_SESSION[$sessionName])) {
            $head = $this->jwtDecode($_SESSION[$sessionName], "head");
            $payload =  $this->jwtDecode($_SESSION[$sessionName]);
            $sig =  $this->jwtDecode($_SESSION[$sessionName], "sig");
            if ($this->jwtVerify($head, $payload, $sig && $this->checkSessionExp($_SESSION[$sessionName]))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    protected function checkSessionExp($sessionName)
    {
        $session = $_SESSION[$sessionName];
        $payload = $this->jwtDecode($session);
        if ($payload) {
            $payload = (array)$payload;
            $timestamp = time();
            if (isset($payload['loginTime']) && isset($payload['sessionDuration'])) {
                if ($timestamp - intval($payload['loginTime']) < intval($payload['sessionDuration'])) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    protected function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


    protected function jwtEncode($payload)
    {
        $headerArray = ["alg" => "HS256", "typ" => "JWT"];
        $headerJson = json_encode($headerArray);
        $base64UrlHeader = $this->base64Encode($headerJson);

        $payloadArray = [];
        foreach ($payload as $index => $value) {
            $payloadArray[$index] = $value;
        }
        $payloadJson = json_encode($payloadArray);
        $base64UrlPayload = $this->base64Encode($payloadJson);

        $signature = $this->hashValue($base64UrlHeader . "." . $base64UrlPayload);
        $base64UrlSignature = $this->base64Encode($signature);

        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }

    protected function base64Encode($input)
    {
        return str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($input));
    }

    protected function base64Decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= \str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    protected function jwtDecode($jwt, $name = "payload")
    {
        $timestamp = time();
        $tks = explode('.', $jwt);
        list($headb64, $payloadb64, $cryptob64) = $tks;
        $header = json_decode($this->base64Decode($headb64));
        $payload = json_decode($this->base64Decode($payloadb64));
        $sig = $this->base64Decode($cryptob64);
        if ($this->jwtVerify($headb64, $payloadb64, $sig)) {
            if (isset($payload->exp) && isset($payload->iat)) {
                if ($this->expJwt($payload->exp, $payload->iat)) {
                    if ($name == "sig" || $name == "sing" || $name == "signature") {
                        return $sig;
                    }
                    if ($name == "head" || $name == "header") {
                        return $header;
                    }
                    if ($name == "payload" || $name == "data") {
                        return $payload;
                    }
                    if ($name == "jwt" || $name == "JWT") {
                        return $jwt;
                    }
                } else {
                    return false;
                }
            } else {
                if ($name == "sig" || $name == "sing" || $name == "signature") {
                    return $sig;
                }
                if ($name == "head" || $name == "header") {
                    return $header;
                }
                if ($name == "payload" || $name == "data") {
                    return $payload;
                }
                if ($name == "jwt" || $name == "JWT") {
                    return $jwt;
                }
            }
        } else {
            return false;
        }
    }

    protected function jwtVerify($header, $payload, $signature)
    {
        $hash = $this->hashValue($header . "." . $payload);
        return hash_equals($signature, $hash);
    }

    protected function expJwt($exptime, $logintime)
    {

        $timestamp = time();
        if (($timestamp - intval($logintime)) < intval($exptime)) {
            return true;
        } else {
            return false;
        }
    }

    protected function redirect($url)
    {
        header('location:' . trim($this->currentDomain, "/ ") . "/" . trim($url, "/ "));
        exit;
    }

    protected function redirectback()
    {
        header('location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
