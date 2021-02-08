<?php
namespace AdminDashboard;

require_once(realpath(dirname(__FILE__) . "/ManageAuth.class.php"));
require_once(realpath(dirname(__FILE__) . "/Admin.Class.php"));
require_once(realpath(dirname(__FILE__) . "/DataBase.php"));
require_once(realpath(dirname(__FILE__) . "/jdf.php"));

use DataBase\DataBase;
use AdminDashboard\Admin;
use AdminDashboard\ManageAuth;

class Home extends ManageAuth
{
    public function index()
    {
        $db = new DataBase();

        $manageAuth = new ManageAuth();

        $payload = $manageAuth->getValueFromCookieOrSession("user");


        $userSql = "SELECT `image`,`name` FROM `users` WHERE `id` = ?";
        $user = $db->select($userSql, [$payload['id']])->fetch();

        $articlesSql = "SELECT `articles`.* , (SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS comments_count ,
       (SELECT name FROM `users` WHERE `users`.`id` = `articles`.`user_id`) AS name FROM `articles` ORDER BY `created_at` DESC LIMIT 0,6;";
        $articles = $db->select($articlesSql)->fetchAll();

        $adsTopSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `type` = ? ";
        $adsTop = $db->select($adsTopSql,['top'])->fetchAll();

        $adsSidebarSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `type` = ? ";
        $adsSidebar = $db->select($adsSidebarSql,['sidebar'])->fetchAll();

        $suggestedSql = "SELECT `articles`.* , (SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS comments_count ,
       (SELECT name FROM `users` WHERE `users`.`id` = `articles`.`user_id`) AS name FROM `articles` WHERE `suggested` = 'on' ORDER BY `created_at`  DESC LIMIT 0,6;";
        $suggested = $db->select($suggestedSql)->fetchAll();

        $popularArticlesSql = "SELECT `articles`.* , (SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS comments_count,
        (SELECT `name` FROM `users` WHERE `users`.`id` = `articles`.`user_id`) AS name FROM `articles` ORDER BY `view` DESC LIMIT 0,4;";
        $popularArticles = $db->select($popularArticlesSql)->fetchAll();

        $sidebarPopularArticles = $popularArticles;

        $categoriesSql = "SELECT * FROM `categories` ORDER BY `created_at` DESC ;";
        $categories = $db->select($categoriesSql);

        $categoriesIdSql = "SELECT `id`,`name` FROM `categories` ORDER BY `created_at` DESC;";
        $categoriesId = $db->select($categoriesIdSql)->fetchAll();

        $articleOrderCommentSql = "SELECT `articles`.* ,(SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS `comment_count` FROM `articles` ORDER BY comment_count DESC LIMIT 0,4; ";
        $articleOrderComment = $db->select($articleOrderCommentSql)->fetchAll();



        $findArticleOrderView = false;
        $i = 0;
        while ($findArticleOrderView == false) {
            $categoriesLength = count($categoriesId);
            $categoriesIdRand = mt_rand(0, intval($categoriesLength) - 1);

            $categoryId = $categoriesId[$categoriesIdRand];

            $articleFromCategoryIdRandOrderViewSql = "SELECT `title`,`created_at`,`id` FROM `articles` WHERE `category_id` = ? ORDER BY `view` DESC LIMIT 0,2; ";
            $articleFromCategoryIdOrderViewRand = $db->select($articleFromCategoryIdRandOrderViewSql, [intval($categoryId['id'])])->fetchAll();

            if ($articleFromCategoryIdOrderViewRand) {
                $findArticleOrderView = true;
            } elseif($i = 100) {            
                $findArticleOrderView = true;
            }
            else {
                $i++;
            }
        }

        $findArticleOrderComment = false;
        $b = 0;
        while ($findArticleOrderComment == false) {

            $categoriesLength = count($categoriesId);
            $categoriesIdRand = mt_rand(0, intval($categoriesLength) - 1);

            $categoryId2 = $categoriesId[$categoriesIdRand];

            $articleFromCategoryIdRandOrderCommentSql = "SELECT `title`,`created_at`,`id` ,(SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS `comment_count` FROM `articles` WHERE `category_id` = ? ORDER BY comment_count DESC LIMIT 0,2; ";
            $articleFromCategoryIdOrderCommentRand = $db->select($articleFromCategoryIdRandOrderCommentSql, [intval($categoryId2['id'])])->fetchAll();

            if ($articleFromCategoryIdOrderCommentRand) {
                $findArticleOrderComment = true;
            } elseif($b = 100) {
                $findArticleOrderComment = true;
                
            }
            else{
                $b++;
            }


        }



        $menusSql = "SELECT `menus`.*,(SELECT COUNT(*) FROM `menus` AS `submenus` WHERE  `submenus`.`parent_id` = `menus`.`id`) AS 
        `submenu_count`  FROM `menus` WHERE `parent_id` IS NULL;";
        $menus = $db->select($menusSql)->fetchAll();

        $submenusSql = "SELECT * FROM `menus` WHERE `parent_id` IS NOT NULL ;";
        $submenus = $db->select($submenusSql)->fetchAll();

        $settingsql = "SELECT * FROM `websetting`";
        $setting = $db->select($settingsql)->fetch();
        require_once(BASE_PATH . "/template/app/Index.php");
    }

    public function show($id)
    {
        $db = new DataBase();



        $articleSql = "SELECT * FROM `articles` WHERE `id` = ? ORDER BY `id` DESC";
        $article = $db->select($articleSql, [$id])->fetch();

        $adsSidebarSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `type` = ? ";
        $adsSidebar = $db->select($adsSidebarSql,['sidebar'])->fetchAll();

        $namesql = "SELECT * FROM `users` WHERE `id` = ?";
        $name = $db->select($namesql, [$article['user_id']])->fetch();

        $commentsCountSql = "SELECT COUNT(*) FROM `comments` WHERE `article_id` = ? ";
        $commentsCount = $db->select($commentsCountSql, [$article['id']])->fetchAll();

        $commentsSql = "SELECT * ,(SELECT `name` FROM `users` WHERE `users`.`id` = `comments`.`user_id`) AS `name` ,(SELECT `created_at` FROM `users` WHERE `users`.`id` = `comments`.`user_id`) AS `date` ,(SELECT `image` FROM `users` WHERE `users`.`id` = `comments`.`user_id`) AS `image` FROM `comments` WHERE `article_id` = ? AND `status` = 'approved' ORDER BY `created_at` DESC;";
        $comments = $db->select($commentsSql, [$article['id']])->fetchAll();

        $relatedArticleSql = "SELECT * FROM `articles` WHERE `category_id` =  ?";
        $relatedArticle = $db->select($relatedArticleSql, [$article['category_id']])->fetchAll();

        $popularArticlesSql = "SELECT `articles`.* , (SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS comments_count,
        (SELECT `name` FROM `users` WHERE `users`.`id` = `articles`.`user_id`) AS name FROM `articles` ORDER BY `view` DESC LIMIT 0,4;";
        $popularArticles = $db->select($popularArticlesSql)->fetchAll();

        $sidebarPopularArticles = $popularArticles;

        $categoriesSql = "SELECT * FROM `categories` ORDER BY `created_at` DESC ;";
        $categories = $db->select($categoriesSql);

        $categoriesIdSql = "SELECT `id`,`name` FROM `categories` ORDER BY `created_at` DESC;";
        $categoriesId = $db->select($categoriesIdSql)->fetchAll();

        $articleOrderCommentSql = "SELECT `articles`.* ,(SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS `comment_count` FROM `articles` ORDER BY comment_count DESC LIMIT 0,4; ";
        $articleOrderComment = $db->select($articleOrderCommentSql)->fetchAll();



        $findArticleOrderView = false;
        $i = 0;
        while ($findArticleOrderView == false) {
            $categoriesLength = count($categoriesId);
            $categoriesIdRand = mt_rand(0, intval($categoriesLength) - 1);

            $categoryId = $categoriesId[$categoriesIdRand];

            $articleFromCategoryIdRandOrderViewSql = "SELECT `title`,`created_at`,`id` FROM `articles` WHERE `category_id` = ? ORDER BY `view` DESC LIMIT 0,2; ";
            $articleFromCategoryIdOrderViewRand = $db->select($articleFromCategoryIdRandOrderViewSql, [intval($categoryId['id'])])->fetchAll();

            if ($articleFromCategoryIdOrderViewRand) {
                $findArticleOrderView = true;
            } elseif($i = 100) {            
                $findArticleOrderView = true;
            }
            else {
                $i++;
            }
        }

        $findArticleOrderComment = false;
        $b = 0;
        while ($findArticleOrderComment == false) {

            $categoriesLength = count($categoriesId);
            $categoriesIdRand = mt_rand(0, intval($categoriesLength) - 1);

            $categoryId2 = $categoriesId[$categoriesIdRand];

            $articleFromCategoryIdRandOrderCommentSql = "SELECT `title`,`created_at`,`id` ,(SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS `comment_count` FROM `articles` WHERE `category_id` = ? ORDER BY comment_count DESC LIMIT 0,2; ";
            $articleFromCategoryIdOrderCommentRand = $db->select($articleFromCategoryIdRandOrderCommentSql, [intval($categoryId2['id'])])->fetchAll();

            if ($articleFromCategoryIdOrderCommentRand) {
                $findArticleOrderComment = true;
            } elseif($b = 100) {
                $findArticleOrderComment = true;
                
            }
            else{
                $b++;
            }
        }


        $menusSql = "SELECT `menus`.*,(SELECT COUNT(*) FROM `menus` AS `submenus` WHERE  `submenus`.`parent_id` = `menus`.`id`) AS 
        `submenu_count`  FROM `menus` WHERE `parent_id` IS NULL;";
        $menus = $db->select($menusSql)->fetchAll();

        $submenusSql = "SELECT * FROM `menus` WHERE `parent_id` IS NOT NULL ;";
        $submenus = $db->select($submenusSql)->fetchAll();

        $settingsql = "SELECT * FROM `websetting`";
        $setting = $db->select($settingsql)->fetch();

        $db->update("articles", ['view'], [intval($article['view']) + 1], $id);
        require_once(BASE_PATH . "/template/app/show-article/post.php");
    }

    public function category($id)
    {
        $db = new DataBase();

        $categorySql = "SELECT `name` FROM `categories` WHERE `id` = ?;";
        $category = $db->select($categorySql,[$id])->fetch();

        $articlesSql = "SELECT `articles`.* , (SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS `commnets_count` , (SELECT `name` FROM `users` WHERE `users`.`id` = `articles`.`user_id`) AS `name` FROM `articles` WHERE `articles`.`category_id` = ?;";
        $articles = $db->select($articlesSql,[$id])->fetchAll();

        
        $adsSidebarSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `type` = ? ";
        $adsSidebar = $db->select($adsSidebarSql,['sidebar'])->fetchAll();

        $popularArticlesSql = "SELECT `articles`.* , (SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS comments_count,
        (SELECT `name` FROM `users` WHERE `users`.`id` = `articles`.`user_id`) AS name FROM `articles` ORDER BY `view` DESC LIMIT 0,4;";
        $popularArticles = $db->select($popularArticlesSql)->fetchAll();

        $sidebarPopularArticles = $popularArticles;

        $categoriesSql = "SELECT * FROM `categories` ORDER BY `created_at` DESC ;";
        $categories = $db->select($categoriesSql);

        $categoriesIdSql = "SELECT `id`,`name` FROM `categories` ORDER BY `created_at` DESC;";
        $categoriesId = $db->select($categoriesIdSql)->fetchAll();

        $articleOrderCommentSql = "SELECT `articles`.* ,(SELECT COUNT(*) FROM `comments` WHERE `comments`.`article_id` = `articles`.`id`) AS `comment_count` FROM `articles` ORDER BY comment_count DESC LIMIT 0,4; ";
        $articleOrderComment = $db->select($articleOrderCommentSql)->fetchAll();



        $findArticleOrderView = false;
        $i = 0;
        while ($findArticleOrderView == false) {
            $categoriesLength = count($categoriesId);
            $categoriesIdRand = mt_rand(0, intval($categoriesLength) - 1);

            $categoryId = $categoriesId[$categoriesIdRand];

            $articleFromCategoryIdRandOrderViewSql = "SELECT `title`,`created_at`,`id` FROM `articles` WHERE `category_id` = ? ORDER BY `view` DESC LIMIT 0,2; ";
            $articleFromCategoryIdOrderViewRand = $db->select($articleFromCategoryIdRandOrderViewSql, [intval($categoryId['id'])])->fetchAll();

            if ($articleFromCategoryIdOrderViewRand) {
                $findArticleOrderView = true;
            } elseif($i = 100) {            
                $findArticleOrderView = true;
            }
            else {
                $i++;
            }
        }

        $findArticleOrderComment = false;
        $b = 0;
        while ($findArticleOrderComment == false) {

            $categoriesLength = count($categoriesId);
            $categoriesIdRand = mt_rand(0, intval($categoriesLength) - 1);

            $categoryId2 = $categoriesId[$categoriesIdRand];

            $articleFromCategoryIdRandOrderCommentSql = "SELECT `articles`.`title`,`articles`.`created_at`,`articles`.`id`,COUNT(`comments`.`article_id`) AS `comment_count` FROM  `articles` RIGHT JOIN `comments` ON `articles`.`id` = `comments`.`article_id` WHERE `category_id` = ? GROUP BY `articles`.`id`  ORDER BY `comment_count` DESC LIMIT 0,2; ";
            $articleFromCategoryIdOrderCommentRand = $db->select($articleFromCategoryIdRandOrderCommentSql, [intval($categoryId2['id'])])->fetchAll();

            if ($articleFromCategoryIdOrderCommentRand) {
                $findArticleOrderComment = true;
            } elseif($b = 100) {
                $findArticleOrderComment = true;
                
            }
            else{
                $b++;
            }
        }



        $menusSql = "SELECT `menus`.*,(SELECT COUNT(*) FROM `menus` AS `submenus` WHERE  `submenus`.`parent_id` = `menus`.`id`) AS 
        `submenu_count`  FROM `menus` WHERE `parent_id` IS NULL;";
        $menus = $db->select($menusSql)->fetchAll();

        $submenusSql = "SELECT * FROM `menus` WHERE `parent_id` IS NOT NULL ;";
        $submenus = $db->select($submenusSql)->fetchAll();

        $settingsql = "SELECT * FROM `websetting`";
        $setting = $db->select($settingsql)->fetch();
        require_once(BASE_PATH . "/template/app/show-category/category.php");
    }

            
    public function commentStore($request,$id)
    {
        $payload = $this->getValueFromCookieOrSession("user");
        if($payload){
            $userId = $payload['id'];
            $artcileId = $id;
            $comment = $request['comment'];
            $db = new DataBase();
            $db->insert("comments",["user_id","article_id","comment"],[$userId,$artcileId,$comment]);
            $this->redirectback();
        }
        else{
            $this->redirect("login");
        }
    }

    protected function redirect($url){
        header('location:'.trim($this->currentDomain,"/ ")."/".trim($url,"/ "));
        exit;
    }

    protected function redirectback(){
         header('location:'.$_SERVER['HTTP_REFERER']);
        exit;

    }
}
