<?php
namespace Valid;
require_once(realpath(dirname(__FILE__)."/../../admin-Dashboard/DataBase.php"));
use DataBase\DataBase;

$check = new check();

if (isset($_REQUEST['check'])){
    $pass = urldecode($_REQUEST['pass']);
    $email = urldecode($_REQUEST['email']);
    $username = urldecode($_REQUEST['username']);
    $name = urldecode($_REQUEST['name']);

    if ($check->testPass($pass) && $check->checkName($name) && $check->checkUsername($username) && $check->checkEmail($email)){
        echo 1;
    }
    else{
        echo 2;
    }
}

if (isset($_REQUEST['pass'])){
    $pass = urldecode($_REQUEST['pass']);
    $check->testPass($pass);
}

if(isset($_REQUEST['email'])){
    $email = urldecode($_REQUEST['email']);
    $check->checkEmail($email);
}

if(isset($_REQUEST['username'])){
    $username = urldecode($_REQUEST['username']);
    $check->checkUsername($username);
}

if(isset($_REQUEST['name'])){
    $name = urldecode($_REQUEST['name']);
    $check->checkName($name);
}


class check{
    public function testPass($pass)
    {
        $uppercase = preg_match("@[A-Z]@", $pass);
        $lowercase = preg_match("@[a-z]@", $pass);
        $number = preg_match("@[0-9]@", $pass);
        $specialWord = preg_match("@[\^&*%$?#\@!]@", $pass);
        $length = strlen($pass);
        $validStatus = 0;
        if ($uppercase == 1){
            $validStatus +=1;
        }
        if ($lowercase == 1){
            $validStatus +=1;
        }
        if ($number == 1){
            $validStatus +=1;
        }
        if ($specialWord == 1){
            $validStatus +=1;
        }
        if ($length > 8){
            $validStatus +=1;
        }
        echo intval($validStatus);
    }

    public function checkEmail($email)
    {
        $db = new DataBase();
        $getEmailSql = "SELECT `email` FROM `users` WHERE (`email` = ?)";
        $getEmail = $db->select($getEmailSql, [$email])->fetch();

        if (filter_var($email,FILTER_VALIDATE_EMAIL) && $getEmail == null){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    public function checkUsername($username)
    {
        $db = new DataBase();
        $getEmailSql = "SELECT `username` FROM `users` WHERE (`username` = ?)";
        $getEmail = $db->select($getEmailSql, [$username])->fetch();

        if ($getEmail == null && strlen($username) > 5){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    public function checkName($name)
    {
        $db = new DataBase();
        if (strlen($name) > 5){
            echo 1;
        }
        else{
            echo 0;
        }
    }
}








