<?php
session_start();

require "anti_ddos/anti-ddos-lite.php";
define("BASE_PATH", __DIR__);
define("CURRENT_DOMAIN", currentDomain() . "/");
define('DISPLAY_ERROR', false);


if (DISPLAY_ERROR) {
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
} else {
    ini_set("display_errors", 0);
    ini_set("display_startup_errors", 0);
    error_reporting(0);
}

require_once("admin-Dashboard/CreateDB.php");
require_once("admin-Dashboard/Category.class.php");
require_once("admin-Dashboard/Article.class.php");
require_once("admin-Dashboard/Menu.class.php");
require_once("admin-Dashboard/WebSetting.class.php");
require_once("admin-Dashboard/Ads.class.php");
require_once("admin-Dashboard/User.class.php");
require_once("admin-Dashboard/Comment.class.php");
require_once("admin-Dashboard/Home.class.php");
require_once("admin-Dashboard/Dashboard.Class.php");
require_once("admin-Dashboard/Auth.class.php");
require_once("admin-Dashboard/userPanel.class.php");


// if (isset($_POST['run'])) {
//    $createdb = new CreateDB();
//    $createdb->run();
// }

// if (isset($_POST['testrun'])) {

//     $category = new Category();
//     $category->update(["name"=>'sport'],2);
// }

function uri($uri, $class, $method, $requestMethod = 'GET')
{
    $values = array();
    $subURIs = explode("/", $uri);
    $request_uri = array_slice(explode("/", $_SERVER["REQUEST_URI"]), 1);


    if ($request_uri[sizeof($request_uri) - 1] == "") {
        unset($request_uri[sizeof($request_uri) - 1]);
    }
    if ($request_uri[0] == "" || $request_uri[0] == "/" || $request_uri[0] == null) {
        $request_uri[0] = "home";
    }

    $braek = false;
    if (sizeof($request_uri) == sizeof($subURIs) && $_SERVER["REQUEST_METHOD"] == $requestMethod) {
        foreach (array_combine($subURIs, $request_uri) as $subURI => $request) {
            if (strpos($subURI, "?") && strpos($request, "?")) {
                $splitUri = explode("?", $subURI);
                $splitRequest = explode("?", $request);
                $subURI = $splitUri[0];
                $request = $splitRequest[0];
                if ($splitUri[1] == $splitRequest[1]) {
                    $valueSplit = explode("=", $splitUri[1]);
                    $values[$valueSplit[0]] = $valueSplit[1];
                    $range = true;
                } else {
                    $braek = true;
                    break;
                }
            }
            if ($subURI[0] == "{" and $subURI[strlen($subURI) - 1] == "}") {
                array_push($values, $request);
            } else {
                if ($request != $subURI) {
                    $braek = true;
                    break;
                }
            }
        }
    } else {
        $braek = true;
    }

    if (!$braek) {

        $class = "AdminDashboard\\" . $class;
        $object = new $class;
        if (sizeof($values) > 0) {
            if ($requestMethod == "POST") {
                if (isset($_FILES)) {

                    $request = array_merge($_POST, $_FILES);
                    $value = implode(",", $values);
                    $object->$method($request, $value);
                    exit;
                } else {
                    $request = $_POST;
                    $value = implode(",", $values);
                    $object->$method($request, $value);
                    exit;
                }
            } else {
                if ($range) {
                    $object->$method($values);
                    exit;
                } else {
                    $value = implode(",", $values);
                    $object->$method($value);
                    exit;
                }
            }
        } else {
            if ($requestMethod == "POST") {
                if (isset($_FILES)) {
                    $request = array_merge($_POST, $_FILES);
                    $object->$method($request);
                    exit;
                } else {
                    $request = $_POST;
                    $object->$method($request);
                    exit;
                }
            } else {
                $object->$method();
                exit;
            }
        }
    } else {
    }



    // $currentUrl = explode("?", currentUrl());
    // $currentUrl = $currentUrl[0];
    // $currentUrl = str_replace(CURRENT_DOMAIN, "", $currentUrl);
    // $currentUrl = trim($currentUrl, "/");

    // $currentUrlArray = explode("/", $currentUrl);
    // $currentUrlArray = array_filter($currentUrlArray);
    // $currentUrlArray = array_slice($currentUrlArray,1);


    // $reservedUrl = trim($reservedUrl, "/");

    // $reservedUrlArray = explode("/", $reservedUrl);
    // $reservedUrlArray = array_filter($reservedUrlArray);

    // if ($currentUrlArray[0] == "" || $currentUrlArray[0] == "/" || $currentUrlArray[0] == null) {
    //     $currentUrlArray[0] = "home";
    // }


    // if (sizeof($currentUrlArray) != sizeof($reservedUrlArray) || $requestMethod != methodField()) {
    //     return false;
    // }

    // $parameters = [];

    // for ($index = 0; $index < sizeof($currentUrlArray); $index++) {

    //     if ($reservedUrlArray[$index][0] == "{" && $reservedUrlArray[$index][strlen($reservedUrlArray[$index]) - 1] == "}") {
    //         array_push($parameters, $currentUrlArray[$index]);
    //     } elseif ($reservedUrlArray[$index] !== $currentUrlArray[$index]) {
    //         return false;
    //     }
    // }


    // if (methodField() == "POST") {
    //     $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
    //     $parameters = array_merge($parameters,$request);
    // }

    // $class = "AdminDashboard\\" . $class;

    // $object = new $class;
    // call_user_func_array([$object, $method], $parameters);

    // exit;
}

function asset($src)
{
    $domain = trim(CURRENT_DOMAIN, "/");
    $src = $domain . "/" . trim($src, "/");
    return $src;
}

function url($url)
{
    $domain = trim(CURRENT_DOMAIN, "/");
    $url = $domain . "/" . trim($url, "/");
    return $url;
}

function protocol()
{
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], "HTTPS") == true ? 'http://' : 'https://';
    return $protocol;
}

function currentDomain()
{
    $domain = protocol() . $_SERVER["HTTP_HOST"];
    return $domain;
}

function currentUrl()
{
    $url = currentDomain() . $_SERVER['REQUEST_URI'];
    return $url;
}

function methodField()
{
    $method = $_SERVER["REQUEST_METHOD"];
    return $method;
}



uri('admin', 'Dashboard', 'index');


uri('home', 'Home', 'index');
uri('show/article/{id}', 'Home', 'show');
uri('show/category/{id}', 'Home', 'category');
uri('comment/store/{id}', 'Home', 'commentStore', 'POST');


uri('category', 'Category', 'index');
uri('category/show/{id}', 'Category', 'show');
uri('category/create', 'Category', 'create');
uri('category/store', 'Category', 'store', 'POST');
uri('category/edit/{id}', 'Category', 'edit');
uri('category/update/{id}', 'Category', 'update', 'POST');
uri('category/delete/{id}', 'Category', 'delete');


uri('article', 'Article', 'index');
uri('article/show/{id}', 'Article', 'show');
uri('article/create', 'Article', 'create');
uri('article/store', 'Article', 'store', 'POST');
uri('article/suggested/{id}', 'Article', 'suggested');
uri('article?suggested=full', 'Article', 'index');
uri('article/edit/{id}', 'Article', 'edit');
uri('article/update/{id}', 'Article', 'update', 'POST');
uri('article/delete/{id}', 'Article', 'delete');


uri('menu', 'Menu', 'index');
uri('menu/show/{id}', 'Menu', 'show');
uri('menu/create/menu', 'Menu', 'create');
uri('menu/create/submenu/{id}', 'Menu', 'create');
uri('menu/store', 'Menu', 'store', 'POST');
uri('menu/store/{id}', 'Menu', 'store', 'POST');
uri('menu/edit/menu/{id}', 'Menu', 'edit');
uri('menu/edit/submenu/{id}', 'Menu', 'edit');
uri('menu/update/{id}', 'Menu', 'update', 'POST');
uri('menu/delete/{id}', 'Menu', 'delete');

uri('user', 'User', 'index');
uri('user/permission/{id}', 'User', 'permission', 'POST');
uri('user/edit/{id}', 'User', 'edit');
uri('user/update/{id}', 'User', 'update', 'POST');
uri('user/delete/{id}', 'User', 'delete');


uri('web-setting', 'WebSetting', 'index');
uri('web-setting/set', 'WebSetting', 'set');
uri('web-setting/store', 'WebSetting', 'store', 'POST');

uri('ads', 'Ads', 'index');
uri('ads/set/{type}/{id}', 'Ads', 'set');
uri('ads/store/{type}/{id}', 'Ads', 'store', 'POST');
uri('ads/delete/{type}/{id}', 'Ads', 'delete');

uri('comment', 'Comment', 'index');
uri('comment/show/{id}', 'Comment', 'set');

uri('login', 'Auth', 'login');
uri('login?captcha=false', 'Auth', 'login');
uri('login?empty=true', 'Auth', 'login');
uri('login?email=false', 'Auth', 'login');
uri('login?password=false', 'Auth', 'login');
uri('login?available=false', 'Auth', 'login');

uri('login/two-verify', 'Auth', 'loginTwoVerify');
uri('login/two-verify?status=false', 'Auth', 'loginTwoVerify', "GET");
uri('login/two-verify?send=true', 'Auth', 'loginTwoVerify', "GET");
uri('login/two-verify?send=false', 'Auth', 'loginTwoVerify', "GET");
uri('login/two-verify?exp=true', 'Auth', 'loginTwoVerify', "GET");
uri('login/two-verify?codeExp=true', 'Auth', 'loginTwoVerify', "GET");
uri('login?verify=true', 'Auth', 'login', "GET");
uri('check-login', 'Auth', 'checkLogin', 'POST');
uri('register', 'Auth', 'register');
uri('register?captcha=false', 'Auth', 'register');
uri('register?empty=true', 'Auth', 'register');
uri('register?email=false', 'Auth', 'register');
uri('register?password=false', 'Auth', 'register');
uri('register?available=true', 'Auth', 'register');
uri('register/store', 'Auth', 'registerStore', 'POST');
uri('register/profile', 'Auth', 'setProfile');
uri('register/profile/store', 'Auth', 'set', "POST");

uri('user/panel', 'userPanel', 'panel');
uri('user/panel/security', 'userPanel', 'security', "GET");
uri('user/panel/security?verify=true', 'userPanel', 'security', "GET");
uri('user/panel/security?verify=false', 'userPanel', 'security', "GET");
uri('user/panel/security?two-verify=true', 'userPanel', 'security', "GET");
uri('user/panel/security?two-verify=false', 'userPanel', 'security', "GET");
uri('user/panel/security?two-verify-disable=true', 'userPanel', 'security', "GET");
uri('user/panel/security?two-verify-disable=false', 'userPanel', 'security', "GET");
uri('user/panel/security?send=true', 'userPanel', 'security', "GET");
uri('user/panel/security?send=false', 'userPanel', 'security', "GET");
uri('user/panel/security?exp=true', 'userPanel', 'security', "GET");
uri('user/panel/security?change-password=true', 'userPanel', 'security', "GET");
uri('user/panel/security?change-password=false', 'userPanel', 'security', "GET");
uri('user/panel/show', 'userPanel', 'security', "GET");
uri('user/panel/profile', 'userPanel', 'profile', "GET");
uri('user/profile/update', 'userPanel', 'updateProfile', "POST");

uri('user/email-verify/send', 'userPanel', 'sendEmailVerify');
uri('user/verify/active/{token}', 'userPanel', 'verify', "GET");
uri('user/email-two-verify/send', 'userPanel', 'sendEmailTwoVerify');
uri('user/two-verify/disable', 'userPanel', 'twoVerifyDisable');
uri('user/two-verify/active/{token}', 'userPanel', 'twoVerify', "GET");


uri('user/two-verify/send-code', 'Auth', 'sendCodeTwoVerify');
uri('user/two-verify/check', 'Auth', 'checkCodeTwoVerify', "POST");

uri('user/change-password', 'Auth', 'changePassword', 'POST');
uri('set/profile/{id}', 'Auth', 'update', "POST");
uri('logout', 'Auth', 'logout');


echo "404 Not Found.";
exit;

?>

<!-- <form method="post">
    <input type="submit" name="run" value="run sqls">
    <input type="submit" name="testrun" value="run testing">
</form> -->