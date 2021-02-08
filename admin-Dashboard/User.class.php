<?php
namespace AdminDashboard;
require_once ("Admin.Class.php");
require_once (realpath(dirname(__FILE__)."/DataBase.php"));
require_once ("jdf.php");
use DataBase\DataBase;
use AdminDashboard\Admin;

class User extends Admin{
         
    public function index()
    {
        $db = new DataBase();
        $userssql = "SELECT * FROM `users`";
        $users = $db->select($userssql);
        require_once (realpath(dirname(__FILE__) . "/../template/panel/users/users.php"));
    }

    public function permission($request,$id)
    {

        $db = new DataBase();
        // $usersql = "SELECT * FROM `users` WHERE `id` = ?";
        // $user = $db->select($usersql,[$id]);

        if(isset($_POST['owner'])){
            $db->update("users",["permission"],["owner"],$id);
        }

        if(isset($_POST['admin'])){
            $db->update("users",["permission"],["admin"],$id);
        }

        if(isset($_POST['subadmin'])){
            $db->update("users",["permission"],["subadmin"],$id);
        }

        if(isset($_POST['user'])){
            $db->update("users",["permission"],["user"],$id);
        }

        if(isset($_POST['ban'])){
            $db->update("users",["permission"],["ban"],$id);
        }
        $this->redirectback();



    }

    function edit($id)
    {
        $db = new DataBase();
        $usersql = "SELECT * FROM `users` WHERE `id` = ?";
        $user = $db->select($usersql,[$id])->fetch();
        require_once (realpath(dirname(__FILE__) . "/../template/panel/users/edit.php"));
    }

    public function update($request,$id)
    {
        $db = new DataBase();
        $db->update('users',array_keys($request),$request,$id);
        $this->redirect('user');
    }

    public function delete($id)
    {
        $db = new DataBase();
        $db->delete("users",$id);
        $this->redirectback();
    }
}
