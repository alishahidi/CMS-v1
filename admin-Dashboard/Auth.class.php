<?php

namespace AdminDashboard;

require_once(realpath(dirname(__FILE__) . "/ManageAuth.class.php"));
require_once(realpath(dirname(__FILE__) . "/DataBase.php"));
require_once("jdf.php");

use DataBase\DataBase;
use AdminDashboard\ManageAuth;

class Auth extends ManageAuth
{
    function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            if (!$this->checkSessionExp($_SESSION['user'])) {
                $this->removeSession($_SESSION['user']);
            }
        }
    }


    public function login($verify = null)
    {
        require_once(BASE_PATH . "/template/auth/login.php");
    }


    public function checkLogin($request)
    {
        if (empty($request['key']) || empty($request['password'])) {
            $this->redirect("login?empty=true");
        } else {
            $secret = '6LfngNAZAAAAABtAHfNvSRKszungmr5pmwRBf1n4';
            if (isset($request['g-recaptcha-response']) && !empty($request['g-recaptcha-response'])) {
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);
                if ($responseData->success) {

                    unset($request['g-recaptcha-response']);

                    $db = new DataBase();

                    $getEmailSql = "SELECT `email`,`password`,`id`,`two-verify` FROM `users` WHERE (`email` = ?)";
                    $getEmail = $db->select($getEmailSql, [$request['key']])->fetch();

                    $getUserNameSql = "SELECT `username`,`password`,`id`,`two-verify` FROM `users` WHERE (`username` = ?)";
                    $getUsername = $db->select($getUserNameSql, [$request['key']])->fetch();
                    if ($getEmail != null) {
                        if (password_verify($request['password'], $getEmail['password'])) {

                            if ($getEmail['two-verify'] == "active") {
                                if (isset($_SESSION['two-verify'])) {
                                    $this->removeSession("two-verify");
                                }
                                $this->setSession("two-verify-code", $this->jwtEncode(["id" => intval($getEmail['id'])]));
                                $this->redirect("user/two-verify/send-code");
                            } else {
                                // if (isset($request['remember'])) { 
                                if ($this->activeCookie()) {
                                    if (isset($_COOKIE['user'])) {
                                        $this->removeCookie("user");
                                    }
                                    $this->setcookie("user", $this->jwtEncode(["id" => $getEmail['id']]), 30);
                                } else {
                                    if (isset($_SESSION['user'])) {
                                        $this->removeSession("user");
                                    }
                                    $this->setSession("user", $this->jwtEncode(["id" => intval($getEmail['id']), "loginTime" => time()]));
                                }
                                // } else {
                                //     if (isset($_SESSION['user'])) {
                                //         $this->removeSession("user");
                                //     }
                                //     $this->setSession("user", $this->jwtEncode(["id" => intval($getEmail['id']), "loginTime" => time()]));
                                // }

                                $this->redirect("admin");
                            }
                        } else {
                            $this->redirect("login?password=false");
                        }
                    } elseif ($getUsername != null) {
                        if (password_verify($request['password'], $getUsername['password'])) {
                            if ($getUsername['two-verify'] == "active") {
                                if (isset($_SESSION['two-verify'])) {
                                    $this->removeSession("two-verify");
                                }
                                $this->setSession("two-verify-code", $this->jwtEncode(["id" => intval($getUsername['id'])]));
                                $this->redirect("user/two-verify/send-code");
                            } else {
                                // if (isset($request['remember'])) {
                                    if ($this->activeCookie()) {
                                        if (isset($_COOKIE['user'])) {
                                            $this->removeCookie("user");
                                        }
                                        $this->setcookie("user", $this->jwtEncode(["id" => $getUsername['id']]), 30);
                                    } else {
                                        if (isset($_SESSION['user'])) {
                                            $this->removeSession("user");
                                        }
                                        $this->setSession("user", $this->jwtEncode(["id" => intval($getUsername['id']), "loginTime" => time()]));
                                    }
                                // } else {
                                //     if (isset($_SESSION['user'])) {
                                //         $this->removeSession("user");
                                //     }
                                //     $this->setSession("user", $this->jwtEncode(["id" => intval($getUsername['id']), "loginTime" => time()]));
                                // }
                                $this->redirect("admin");
                            }
                        } else {
                            $this->redirect("login?password=false");
                        }
                    } else {
                        $this->redirect("login?available=false");
                    }
                } else {
                    $this->redirect("login?captcha=false");
                }
            } else {
                $this->redirect("login?captcha=false");
            }
        }
    }

    public function loginTwoVerify($status = null)
    {
        if (strstr($_SERVER["HTTP_REFERER"], "login")) {
            require_once(BASE_PATH . "/template/auth/two-verify-login.php");
        } else {
            $this->redirect("login");
        }
    }

    public function panel()
    {
        $db = new DataBase();
        $sql = "SELECT * FROM `users` WHERE `id` = ?";
        $payload = $this->getValueFromCookieOrSession('user');
        if ($payload) {
            $user = $db->select($sql, [$payload['id']])->fetch();
            require_once(BASE_PATH . "/template/user-panel/index.php");
        } else {
            $this->redirect("login");
        }
    }
    public function security($verify = null)
    {
        $db = new DataBase();
        $sql = "SELECT * FROM `users` WHERE `id` = ?";
        $payload = $this->getValueFromCookieOrSession('user');
        if ($payload) {
            $payload = (array)$payload;
            $user = $db->select($sql, [$payload['id']])->fetch();
            require_once(BASE_PATH . "/template/user-panel/security/index.php");
        } else {
            $this->redirect("login");
        }
    }

    public function register($verify = null)
    {
        require_once(BASE_PATH . "/template/auth/register.php");
    }

    public function registerStore($request)
    {
        $uppercase = preg_match("@[A-Z]@", $request['password']);
        $lowercase = preg_match("@[a-z]@", $request['password']);
        $number = preg_match("@[0-9]@", $request['password']);
        $specialword = preg_match("@[^&*%$?#\@!]@", $request['password']);
        $lenght = strlen($request['password']);

        if (empty($request['email']) || empty($request['password']) || $request['password'] != $request['repassword']) {
            $this->redirect("register?empty=true");
        } elseif ((!$specialword || !$uppercase || !$lowercase || !$number || $lenght  < 8)) {
            $this->redirect("register?password=false");
        } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $this->redirect("register?email=false");
        } else {
            $secret = '6LfngNAZAAAAABtAHfNvSRKszungmr5pmwRBf1n4';
            if (isset($request['g-recaptcha-response']) && !empty($request['g-recaptcha-response'])) {
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);
                if ($responseData->success) {
                    unset($request['g-recaptcha-response']);

                $db = new DataBase();

                $getEmailSql = "SELECT `email` FROM `users` WHERE (`email` = ?)";
                $getEmail = $db->select($getEmailSql, [$request['email']])->fetch();

                $getUserNameSql = "SELECT `username`,`id` FROM `users` WHERE (`username` = ?)";
                $getUsername = $db->select($getUserNameSql, [$request['username']])->fetch();

                if ($getEmail != null || $getUsername['username'] != null) {
                    $this->redirect("register?available=true");
                } else {
                    unset($request['repassword']);
                    unset($request['captcha']);
                    $db = new DataBase();
                    $request['password'] = $this->hashPass($request['password']);
                    $request['image'] = "public/images/Web-Setting/profile-avatar.jpg";
                    $db->insert('users', array_keys($request), $request);
                    $getUsername = $db->select($getUserNameSql, [$request['username']])->fetch();

                    $this->setSession("setProfile", $this->jwtEncode(["id" => $getUsername['id']]));
                    $this->redirect('register/profile');
                }
            } else {
                $this->redirect("register?captcha=false");
            }
            } else {
                $this->redirect("register?captcha=false");
            }
        }
    }

    public function changePassword($request)
    {

        $uppercase = preg_match("@[A-Z]@", $request['password']);
        $lowercase = preg_match("@[a-z]@", $request['password']);
        $number = preg_match("@[0-9]@", $request['password']);
        $specialword = preg_match("@[^&*%$?#\@!]@", $request['password']);
        $lenght = strlen($request['password']);

        if (isset($_COOKIE['user'])) {
            $payload = $this->jwtDecode($_COOKIE['user']);
            if ($payload) {
                $payload =  (array)$payload;

                if ((!$specialword || !$uppercase || !$lowercase || !$number || $lenght  < 8)) {
                    $this->redirect("user/panel/security?change-password=false");
                } else {
                    $db = new DataBase();
                    $userSql = "SELECT `password` FROM `users` WHERE (`id` = ?)";
                    $user = $db->select($userSql, [$payload['id']])->fetch();
                    if (password_verify($request['oldpassword'], $user['password'])) {
                        if ($request['repassword'] == $request['password']) {
                            unset($request['oldpassword']);
                            unset($request['repassword']);
                            $db = new DataBase();
                            $request['password'] = $this->hashPass($request['password']);

                            $db->update('users', array_keys($request), $request, $payload['id']);

                            $this->redirect("user/panel/security?change-password=true");
                        } else {
                            $this->redirect("user/panel/security?change-password=false");
                        }
                    } else {
                        $this->redirect("user/panel/security?change-password=false");
                    }
                }
            } else {
                $this->redirect("login");
            }
        } elseif (isset($_SESSION['user'])) {
            $payload = $this->jwtDecode($_SESSION['user']);
            if ($payload) {
                $payload =  (array)$payload;

                if ((!$specialword || !$uppercase || !$lowercase || !$number || $lenght  < 8)) {
                    $this->redirect("user/panel/security?change-password=false");
                } else {
                    $db = new DataBase();

                    $userSql = "SELECT `username` FROM `users` WHERE (`username` = ?)";
                    $user = $db->select($userSql, [$request['username']])->fetch();
                    if (password_verify($request['repassword'], $user['password'])) {
                        unset($request['repassword']);
                        $db = new DataBase();
                        $request['password'] = $this->hashPass($request['password']);
                        $db->update('users', ["password"], $request['password'], $payload['id']);
                        $this->redirect("user/panel/security?change-password=true");
                    } else {
                        $this->redirect("user/panel/security?change-password=false");
                    }
                }
            } else {
                $this->redirect("login");
            }
        } else {
            $this->redirect("login");
        }
    }

    public function setProfile()
    {
        if (strstr($_SERVER["HTTP_REFERER"], "/register")) {
            if (isset($_SESSION['setProfile'])) {
                $payload = $this->jwtDecode($_SESSION['setProfile']);
                if ($payload) {
                    require_once(BASE_PATH . "/template/auth/set-profile.php");
                } else {
                    $this->redirect("register");
                }
            } else {
                $this->redirect("register");
            }
        } else {
            $this->redirect("register");
        }
    }

    public function set($request)
    {
        $payload = $this->jwtDecode($_SESSION['setProfile']);
        if ($payload) {
            $payload = (array)$payload;
            $db = new DataBase();
            $usersql = "SELECT `image`,`username` FROM `users` WHERE `id` =?";
            $user = $db->select($usersql, [$payload['id']])->fetch();
            $parameters = [];
            if ($request["image"]["tmp_name"] != null) {
                if(!$user['image'] == "public/images/Web-Setting/profile-avatar.jpg"){
                    $this->removeImage($user['image']);
                }
                $parameters['image'] = $this->saveImage($request['image'], "user", $user['username']);
            }
            if (isset($request['bio'])) {
                $parameters['bio'] = $request['bio'];
            }
            $db->update("users", array_keys($parameters), $parameters, $payload['id']);
            $this->redirect("login");
        }
    }

    public function logout()
    {
        if (isset($_COOKIE['user'])) {
            $this->removeCookie("user");
        } elseif (isset($_SESSION['user'])) {
            $this->removeSession('user');
        }
        $this->redirectback();
    }



    public function checkAdmin()
    {
        if (isset($_COOKIE['user'])) {

            $payload = $this->jwtDecode($_COOKIE['user']);
            if ($payload) {

                $db = new DataBase();
                $usersql = "SELECT `permission`,`id` FROM `users` WHERE `id` = ?";
                $payload =  (array)$payload;
                $user = $db->select($usersql, [$payload['id']])->fetch();
                if ($user != null) {
                    if ($user['permission'] == "ban") {
                        $this->redirect('home');
                    } elseif ($user['permission'] == "user") {
                        $this->redirect('home');
                    }
                } else {
                    $this->redirect("home");
                }
            } else {
                $this->redirect("home");
            }
        } elseif (isset($_SESSION['user'])) {
            $payload = $this->jwtDecode($_SESSION['user']);
            if ($payload) {
                $db = new DataBase();
                $usersql = "SELECT `permission`,`id` FROM `users` WHERE `id` = ?";
                $payload =  (array)$payload;
                $user = $db->select($usersql, [$payload['id']])->fetch();
                if ($user != null) {
                    if ($user['permission'] == "ban") {
                        $this->redirect('home');
                    } elseif ($user['permission'] == "user") {
                        $this->redirect('home');
                    }
                } else {
                    $this->redirect("home");
                }
            } else {
                $this->redirect("home");
            }
        } else {
            $this->redirect("home");
        }
    }

    public function sendEmailVerify()
    {

        if (isset($_COOKIE['user'])) {
            $payload = $this->jwtDecode($_COOKIE['user']);
            if ($payload) {
                $payload =  (array)$payload;
                $db = new DataBase();
                $usersql = "SELECT `email`,`id` FROM `users` WHERE `id` = ?";
                $payload =  (array)$payload;
                $user = $db->select($usersql, [$payload['id']])->fetch();
            } else {
                $this->redirect("login?security=false");
            }
        } elseif (isset($_SESSION['user'])) {
            $payload = $this->jwtDecode($_SESSION['user']);
            if ($payload) {
                $payload =  (array)$payload;
                $db = new DataBase();
                $usersql = "SELECT `email`,`id` FROM `users` WHERE `id` = ?";
                $user = $db->select($usersql, [$payload['id']])->fetch();
            } else {
                $this->redirect("login");
            }
        }

        if (isset($_SESSION['verify-code'])) {
            if ($this->checkSessionExp("verify-code") === false) {
                if ($this->sendMail("DONT REPLY", "تایید حساب کاربری", $this->getHtmlTemplate("تایید حساب کاربری", "لطفا برای تایید حساب کاربری خود بر روی لینک زیر کلیک کنید(پس از گذشت یک روز لینک منقضی میشود)", $this->getPrtocol() . $this->getHostName() . "/user/verify/active/" . $this->jwtEncode(["id" => $user['id'], "action" => "verify", "exp" => $this->dayToS(1), 'iat' => time()]), "تمامی حقوق متعلق به شرکت ستریکال میباشد"), $user['email'])) {
                    $this->removeSession("verify-code");
                    $this->setSession("verify-code", $this->jwtEncode(["loginTime" => time(), "sessionDuration" => 120]));
                    $this->redirect("user/panel/security?send=true");
                } else {
                    $this->redirect("user/panel/security?send=false");
                }
            } else {
                $this->redirect("user/panel/security?exp=true");
            }
        } else {
            $this->setSession("verify-code", $this->jwtEncode(["loginTime" => time(), "sessionDuration" => 120]));
            if ($this->sendMail("DONT REPLY", "تایید حساب کاربری", $this->getHtmlTemplate("تایید حساب کاربری", "لطفا برای تایید حساب کاربری خود بر روی لینک زیر کلیک کنید(پس از گذشت یک روز لینک منقضی میشود)", $this->getPrtocol() . $this->getHostName() . "/user/verify/active/" . $this->jwtEncode(["id" => $user['id'], "action" => "verify", "exp" => $this->dayToS(1), 'iat' => time()]), "تمامی حقوق متعلق به شرکت ستریکال میباشد"), $user['email'])) {
                $this->redirect("user/panel/security?send=true");
            } else {
                $this->redirect("user/panel/security?send=false");
            }
        }
    }

    public function sendEmailTwoVerify()
    {
        if (isset($_COOKIE['user'])) {
            $payload = $this->jwtDecode($_COOKIE['user']);
            if ($payload) {
                $db = new DataBase();
                $usersql = "SELECT `email`,`id` FROM `users` WHERE `id` = ?";
                $payload =  (array)$payload;
                $user = $db->select($usersql, [$payload['id']])->fetch();
            } else {
                $this->redirect("login?security=false");
            }
        } elseif (isset($_SESSION['user'])) {
            $payload = $this->jwtDecode($_SESSION['user']);
            if ($payload) {
                $db = new DataBase();
                $usersql = "SELECT `email`,`id` FROM `users` WHERE `id` = ?";
                $payload =  (array)$payload;
                $user = $db->select($usersql, [$payload['id']])->fetch();
            } else {
                $this->redirect("login");
            }
        }

        if (isset($_SESSION['two-verify'])) {
            if ($this->checkSessionExp("two-verify") === false) {
                if ($this->sendMail("DONT REPLY", "تاید احراز هویت دو مرحله ای", $this->getHtmlTemplate("احراز هویت دو مرحله ای", "لینک فعالسازی شما", $this->getPrtocol() . $this->getHostName() . "/user/two-verify/active/" . $this->jwtEncode(["id" => $user['id'], "action" => "two-verify", "exp" => $this->dayToS(1), 'iat' => time()]), "تمامی حقوق متعلق به شرکت ستریکال میباشد"), $user['email'])) {
                    $this->removeSession("two-verify");
                    $this->setSession("two-verify", $this->jwtEncode(["loginTime" => time(), "sessionDuration" => 120]));
                    $this->redirect("user/panel/security?send=true");
                } else {
                    $this->redirect("user/panel/security?send=false");
                }
            } else {
                $this->redirect("user/panel/security?exp=true");
            }
        } else {
            $this->setSession("two-verify", $this->jwtEncode(["loginTime" => time(), "sessionDuration" => 120]));
            if ($this->sendMail("DONT REPLY", "تاید احراز هویت دو مرحله ای", $this->getHtmlTemplate("احراز هویت دو مرحله ای", "لینک فعالسازی شما", $this->getPrtocol() . $this->getHostName() . "/user/two-verify/active/" . $this->jwtEncode(["id" => $user['id'], "action" => "two-verify", "exp" => $this->dayToS(1), 'iat' => time()]), "تمامی حقوق متعلق به شرکت ستریکال میباشد"), $user['email'])) {
                $this->redirect("user/panel/security?send=true");
            } else {
                $this->redirect("user/panel/security?send=false");
            }
        }
    }

    public function sendCodeTwoVerify()
    {
        if (isset($_SESSION['two-verify-code'])) {
            $payload = $this->jwtDecode($_SESSION['two-verify-code']);
            if ($payload) {
                $payload = (array)$payload;
                $db = new DataBase();
                $usersql = "SELECT `verify-code`,`email` FROM `users` WHERE `id` = ?";
                $payload =  (array)$payload;
                $code = $this->generateCode(6);
            } else {
                $this->redirect("login");
            }
        } else {
            $this->redirect("login");
        }


        if (isset($_SESSION['two-verify-email'])) {
            if ($this->checkSessionExp("two-verify-email") === false) {
                $db->update('users', ['verify-code'], [$code . "-" . time() . "-" . "300"], $payload['id']);
                $user = $db->select($usersql, [$payload['id']])->fetch();
                $verifyCode = explode("-", $user['verify-code'])[0];
                if ($this->sendMail("DONT REPLY", "تاید احراز هویت دو مرحله ای", $this->getHtmlTemplate("احراز هویت دو مرحله ای", "کد فعالسازی شما", $verifyCode . "<br> محل اسفاده تا ۵ دقیقه", "تمامی حقوق متعلق به شرکت ستریکال میباشد"), $user['email'])) {
                    $this->removeSession("two-verify-email");
                    $this->setSession("two-verify-email", $this->jwtEncode(["loginTime" => time(), "sessionDuration" => 120]));
                    $this->redirect("login/two-verify?send=true");
                } else {
                    $this->redirect("login/two-verify?send=false");
                }
            } else {
                $this->redirect("login/two-verify?exp=true");
            }
        } else {

            $this->setSession("two-verify-email", $this->jwtEncode(["loginTime" => time(), "sessionDuration" => 120]));
            $db->update('users', ['verify-code'], [$code . "-" . time() . "-" . "300"], $payload['id']);
            $user = $db->select($usersql, [$payload['id']])->fetch();
            $verifyCode = explode("-", $user['verify-code'])[0];

            if ($this->sendMail("DONT REPLY", "تاید احراز هویت دو مرحله ای", $this->getHtmlTemplate("احراز هویت دو مرحله ای", "کد فعالسازی شما", $verifyCode . "<br> محل اسفاده تا ۵ دقیقه", "تمامی حقوق متعلق به شرکت ستریکال میباشد"), $user['email'])) {
                $this->redirect("login/two-verify?send=true");
            } else {
                $this->redirect("login/two-verify?send=false");
            }
        }
    }
    public function checkCodeTwoVerify($code)
    {
        $timestamp = time();
        if (isset($_SESSION['two-verify-code'])) {
            $payload = $this->jwtDecode($_SESSION['two-verify-code']);
            if ($payload) {
                $payload = (array)$payload;
                $db = new DataBase();
                $usersql = "SELECT `verify-code`,`id` FROM `users` WHERE `id` = ?";
                $payload =  (array)$payload;
                $user = $db->select($usersql, [$payload['id']])->fetch();
                $codeContent = explode("-", $user['verify-code']);
                $dbCode = $codeContent[0];
                $loginTime = $codeContent[1];
                $duration = $codeContent[2];
            } else {
                $this->redirect("login");
            }
        } else {
            $this->redirect("login");
        }

        if ($timestamp - intval($loginTime) < intval($duration)) {
            if ($code['key'] == $dbCode) {
                if ($this->activeCookie()) {
                    if (isset($_COOKIE['user'])) {
                        $this->removeCookie("user");
                    }
                    $this->setcookie("user", $this->jwtEncode(["id" => $user['id']]), 30);
                } else {
                    if (isset($_SESSION['user'])) {
                        $this->removeSession("user");
                    }
                    $this->setSession("user", $this->jwtEncode(["id" => $user['id'], "loginTime" => time()]));
                }
                $this->removeSession("two-verify-code");
                $this->redirect("admin");
            } else {
                $this->redirect("login/two-verify?status=false");
            }
        } else {
            $this->redirect("login/two-verify?codeExp=true");
        }
    }

    public function verify($token)
    {
        $payload = $this->jwtDecode($token);
        if ($payload) {
            $payload =  (array)$payload;
            if ($payload['action'] == "verify") {
                $db =  new DataBase();
                $db->update('users', ["verify"], ["active"], $payload['id']);
                $this->redirect("user/panel/security?verify=true");
            } else {
                $this->redirect("user/panel/security");
            }
        } else {
            $this->redirect("user/panel/security?verify=false");
        }
    }

    public function twoVerify($toekn)
    {
        $payload = $this->jwtDecode($toekn);
        if ($payload) {
            $payload = (array)$payload;
            $db =  new DataBase();
            if ($payload['action'] == "two-verify") {
                $db->update('users', ["two-verify"], ["active"], $payload['id']);
                $this->redirect("user/panel/security?two-verify=true");
            } else {
                $this->redirect("user/panel/security");
            }
        } else {
            $this->redirect("user/panel/security?two-verify=false");
        }
    }
    public function twoVerifyDisable()
    {
        $payload = $this->getValueFromCookieOrSession('user');
        if ($payload) {
            $payload = (array)$payload;
            $db =  new DataBase();
            $db->update('users', ["two-verify"], ["notactive"], $payload['id']);
            $this->redirect("user/panel/security?two-verify-disable=true");
        } else {
            $this->redirect("user/panel/security?two-verify-disable=false");
        }
    }
}
