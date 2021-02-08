<?php

namespace AdminDashboard;

require_once("Auth.class.php");
require_once(realpath(dirname(__FILE__) . "/DataBase.php"));
require_once("jdf.php");

use DataBase\DataBase;
use AdminDashboard\Admin;

class userPanel extends Auth
{

    public function panel()
    {

        $payload = $this->getValueFromCookieOrSession('user');
        if ($payload) {
            require_once(BASE_PATH . "/template/user-panel/index.php");
        } else {
            $this->redirect("login");
        }
    }
    public function security($verify = null)
    {
        
        $payload = $this->getValueFromCookieOrSession('user');
        if ($payload) {
            $payload = (array)$payload;
            require_once(BASE_PATH . "/template/user-panel/security/index.php");
        } else {
            $this->redirect("login");
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

    public function sendEmailVerify()
    {

        if (isset($_COOKIE['user'])) {
            $payload = $this->jwtDecode($_COOKIE['user']);
            if ($payload) {
                $payload =  (array)$payload;
                $db = new DataBase();
                $usersql = "SELECT `email`,`id` FROM `users` WHERE `id` = ?";
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
                if ($this->sendMail("DONT REPLY", "تایید احراز هویت دو مرحله ای", $this->getHtmlTemplate("احراز هویت دو مرحله ای", "لینک فعالسازی شما", $this->getPrtocol() . $this->getHostName() . "/user/two-verify/active/" . $this->jwtEncode(["id" => $user['id'], "action" => "two-verify", "exp" => $this->dayToS(1), 'iat' => time()]), "تمامی حقوق متعلق به شرکت ستریکال میباشد"), $user['email'])) {
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

    public function profile()
    {
        $payload = $this->getValueFromCookieOrSession('user');
        if ($payload) {
            require_once(BASE_PATH . "/template/user-panel/user/edit.php");
        } else {
            $this->redirect("login");
        }
    }

    public function updateProfile($request)
    {
        $payload = $this->getValueFromCookieOrSession("user");
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
            if (isset($request['name'])) {
                $parameters['name'] = $request['name'];
            }
            if (isset($request['phone'])) {
                $parameters['phone'] = $request['phone'];
            }
            $db->update("users", array_keys($parameters), $parameters, $payload['id']);
            $this->redirect("user/panel");
        }
    }
}
