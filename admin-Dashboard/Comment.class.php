<?php
namespace AdminDashboard;
require_once ("Admin.Class.php");
require_once (realpath(dirname(__FILE__)."/DataBase.php"));
require_once ("jdf.php");
use DataBase\DataBase;
use AdminDashboard\Admin;



class Comment extends Admin{

   
    public function index()
    {
      $db =  new DataBase();
      $commentsSql = "SELECT `comments`.* ,(SELECT `name` FROM `users` WHERE `users`.`id` = `comments`.`user_id`) AS `name` ,(SELECT `username` FROM `users` WHERE `users`.`id` = `comments`.`user_id`) AS `username` ,(SELECT `id` FROM `users` WHERE `users`.`id` = `comments`.`user_id`) AS `userId` ,(SELECT `title` FROM `articles` WHERE `articles`.`id` = `comments`.`article_id`) AS `title` ,(SELECT `id` FROM `articles` WHERE `articles`.`id` = `comments`.`article_id`) AS `articleId` FROM `comments` ORDER BY `id` DESC";
      $comments =  $db->select($commentsSql);

      foreach($comments as $comment){
          if($comment['status'] == "unseen"){
              $db->update("comments",["status"],["seen"],$comment['id']);
          }
      }
      $comments =  $db->select($commentsSql);

      require_once (realpath(dirname(__FILE__) . "/../template/panel/comments/comments.php"));
    }



    public function show($id)
    {
      $db =  new DataBase();

      $commentSql = "SELECT * FROM `comments` WHERE `id` = ?";
      $comment = $db->select($commentSql,[$id])->fetch();

      require_once (realpath(dirname(__FILE__) . "/../template/panel/comments/show.php"));
      
    }



}

if(isset($_REQUEST['approved'])){
    $id = $_REQUEST['approved'];
    $db =  new DataBase();

    $commentSql = "SELECT * FROM `comments` WHERE `id` = ?";
    $comment = $db->select($commentSql,[$id])->fetch();

    if($comment['status'] == "approved"){
        $db->update("comments",['status'],["seen"],$id);
        echo 0;
    }
    else{
        $db->update("comments",['status'],["approved"],$id);
        echo 1;
    }
}