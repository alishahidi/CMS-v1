<?php
namespace AdminDashboard;

require_once(realpath(dirname(__FILE__) . "/ManageAuth.class.php"));
require_once(realpath(dirname(__FILE__) . "/Admin.Class.php"));
require_once(realpath(dirname(__FILE__) . "/DataBase.php"));
require_once(realpath(dirname(__FILE__) . "/jdf.php"));

use DataBase\DataBase;
use AdminDashboard\Admin;
use AdminDashboard\ManageAuth;



class Dashboard extends Admin
{

    public function index()
    {
        $db = new DataBase();

        $articleCountSql = "SELECT COUNT(*) FROM `articles`;";
        $articleCount = $db->select($articleCountSql)->fetch();

        $articlesViewsSql = "SELECT SUM(view) FROM `articles`;";
        $articlesViews = $db->select($articlesViewsSql)->fetch();

        $commentCountSql = "SELECT COUNT(*) FROM `comments`;";
        $commentCount = $db->select($commentCountSql)->fetch();

        $commentUnseenCountSql = "SELECT COUNT(*) FROM `comments` WHERE `status` = 'unseen';";
        $commentUnseenCount = $db->select($commentUnseenCountSql)->fetch();

        $commentSeenCountSql = "SELECT COUNT(*) FROM `comments` WHERE `status` = 'seen';";
        $commentSeenCount = $db->select($commentSeenCountSql)->fetch();

        $commentApprovedCountSql = "SELECT COUNT(*) FROM `comments` WHERE `status` = 'approved';";
        $commentApprovedCount = $db->select($commentApprovedCountSql)->fetch();

        $userAllCountSql = "SELECT COUNT(*) FROM `users`;";
        $userAllCount = $db->select($userAllCountSql)->fetch();

        $userOwnerCountSql = "SELECT COUNT(*) FROM `users` WHERE `permission` = 'owner';";
        $userOwnerCount = $db->select($userOwnerCountSql)->fetch();

        $userAdminCountSql = "SELECT COUNT(*) FROM `users` WHERE `permission` = 'admin';";
        $userAdminCount = $db->select($userAdminCountSql)->fetch();
        
        $userSubAdminCountSql = "SELECT COUNT(*) FROM `users` WHERE `permission` = 'subadmin';";
        $userSubAdminCount = $db->select($userSubAdminCountSql)->fetch();

        $userCountSql = "SELECT COUNT(*) FROM `users` WHERE `permission` = 'user';";
        $userCount = $db->select($userCountSql)->fetch();

        $userBanCountSql = "SELECT COUNT(*) FROM `users` WHERE `permission` = 'ban';";
        $userBanCount = $db->select($userBanCountSql)->fetch();
        
        $categoryCountSql = "SELECT COUNT(*) FROM `categories`;";
        $categoryCount = $db->select($categoryCountSql)->fetch();

        $articleWitchViewSql = "SELECT `title`,`id`,`view` FROM `articles` ORDER BY `view` DESC LIMIT 0,6;";
        $articleWitchView = $db->select($articleWitchViewSql);

        $articlesCommentsSql ="SELECT `articles`.`title`,`articles`.`id`, COUNT(`comments`.`article_id`) AS `comment_count` FROM `articles` LEFT JOIN `comments` ON `comments`.`article_id` = `articles`.`id` GROUP BY `articles`.`id` ORDER BY `comment_count` DESC LIMIT 0,6;";
        $articlesComments = $db->select($articlesCommentsSql);

        $lastCommentsSql = "SELECT `comments`.`comment`,`comments`.`id`,`comments`.`status`,`users`.`username` FROM `comments`,`users` WHERE `comments`.`user_id` = `users`.`id` ORDER BY `comments`.`created_at` DESC LIMIT 0,6;";
        $lastComments = $db->select($lastCommentsSql);

        require_once (realpath(dirname(__FILE__) . "/../template/panel/index.php"));

    }

}
