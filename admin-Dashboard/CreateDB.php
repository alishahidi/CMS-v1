<?php

namespace DataBase;

require_once (realpath(dirname(__FILE__)."/DataBase.php"));

class CreateDB extends DataBase {
  public $work ;
  private $createtablequeries = [

     "CREATE TABLE `categories`(
        `id` INT(14) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(200) NOT NULL COLLATE utf8_persian_ci,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
         PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=UTF8 COLLATE=utf8_persian_ci",

     "CREATE TABLE `users`(
        `id` INT(14) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(100) NOT NULL COLLATE utf8_persian_ci,
        `username` VARCHAR(100) NOT NULL COLLATE utf8_persian_ci,
        `email` VARCHAR(100) NOT NULL COLLATE utf8_persian_ci,
        `image` TEXT DEFAULT NULL COLLATE utf8_persian_ci,
        `bio` TEXT DEFAULT NULL COLLATE utf8_persian_ci,
        `phone` INT(100) DEFAULT NULL,
        `password` VARCHAR(100) NOT NULL COLLATE utf8_persian_ci,
        `permission` ENUM('owner','admin','subadmin','user','ban') NOT NULL DEFAULT 'user' COLLATE utf8_persian_ci,
        `verify` ENUM('active','notactive') NOT NULL DEFAULT 'notactive' COLLATE utf8_persian_ci,
        `two-verify` ENUM('active','notactive') NOT NULL DEFAULT 'notactive' COLLATE utf8_persian_ci,
        `verify-code` VARCHAR(8) DEFAULT NULL COLLATE utf8_persian_ci,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
         PRIMARY KEY (`id`),
         UNIQUE KEY `email` (`email`),
         UNIQUE KEY `username` (`username`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci",

     "CREATE TABLE `articles`(
        `id` INT(14) NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(200) NOT NULL COLLATE utf8_persian_ci,
        `summary` TEXT NOT NULL COLLATE utf8_persian_ci,
        `body` TEXT NOT NULL COLLATE utf8_persian_ci,
        `view` INT(14) NOT NULL DEFAULT '0',
        `user_id` INT(14) NOT NULL,
        `category_id` INT(14) NOT NULL,
        `image` VARCHAR(200) COLLATE utf8_persian_ci NOT NULL,
        `status` ENUM('on','off') NOT NULL DEFAULT 'off' COLLATE utf8_persian_ci,
        `suggested` ENUM('on','off') NOT NULL DEFAULT 'off' COLLATE utf8_persian_ci,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
         PRIMARY KEY (`id`),
         FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
         FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci",

     "CREATE TABLE `comments`(
        `id` INT(14) NOT NULL AUTO_INCREMENT,
        `user_id` INT(14) NOT NULL,
        `article_id` INT(14) NOT NULL,
        `comment` TEXT NOT NULL COLLATE utf8_persian_ci,
        `status` ENUM('unseen','seen','approved') NOT NULL DEFAULT 'off' COLLATE utf8_persian_ci,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
         PRIMARY KEY (`id`),
         FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
         FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci",

     "CREATE TABLE `websetting`(
      `id` INT(14) NOT NULL AUTO_INCREMENT,
      `tittle` TEXT  COLLATE utf8_persian_ci DEFAULT NULL,
      `description` VARCHAR(110)  COLLATE utf8_persian_ci DEFAULT NULL,
      `keywords` TEXT  COLLATE utf8_persian_ci DEFAULT NULL,
      `logo` TEXT  COLLATE utf8_persian_ci DEFAULT NULL,
      `icon` TEXT  DEFAULT NULL,
      `created_at` DATETIME NOT NULL,
      `updated_at` DATETIME DEFAULT NULL,
       PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci",

     "CREATE TABLE `menus`(
        `id` INT(14) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(200) NOT NULL COLLATE utf8_persian_ci,
        `url` VARCHAR(400) NOT NULL COLLATE utf8_persian_ci,
        `parent_id` INT(14) DEFAULT NULL,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME DEFAULT NULL,
         PRIMARY KEY (`id`),
         FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci"

 ];
  
 private$tableinitializes = array (["table"=>"users","fields"=>["permission","name","username","password","email"],"values"=>["owner","علی شهیدی","alishahidi1376","1376gtid","alishahidi1376@gmail.com"]]);

  public function run()
  {
      foreach($this->createtablequeries as $createtablequery ){
         $this->createTable($createtablequery);
      }
      foreach($this->tableinitializes as $tableInitialize){
         $this->insert($tableInitialize['table'],$tableInitialize['fields'], $tableInitialize['values']);
      }
  }




}

?>