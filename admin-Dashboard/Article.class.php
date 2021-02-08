<?php
namespace AdminDashboard;
require_once ("Admin.Class.php");
require_once (realpath(dirname(__FILE__)."/DataBase.php"));
require_once (realpath(dirname(__FILE__)."/ManageAuth.class.php"));
require_once ("jdf.php");
use DataBase\DataBase;
use AdminDashboard\Admin;
use AdminDashboard\ManageAuth;

class Article extends Admin{


    public function index($verify = null)
    {
        $db = new DataBase();
        $sql = "SELECT * FROM `articles` ORDER BY `id` DESC ";
        $articles = $db->select($sql);
        require_once (realpath(dirname(__FILE__) . "/../template/panel/articles/articles.php"));

    }
    public function show($id)
    {
        $db = new DataBase();
        $articlesql = "SELECT * FROM `articles` WHERE `id` = ?";
        $article = $db->select($articlesql,[$id])->fetch();
        $categorysql = "SELECT name FROM `categories` WHERE `id` = ?";
        $category = $db->select($categorysql,[$article['category_id']])->fetch();
        $usersql = "SELECT name,username FROM `users` WHERE `id` = ?";
        $user = $db->select($usersql,[$article['user_id']])->fetch();

        require_once (realpath(dirname(__FILE__) . "/../template/panel/articles/show.php"));

    }
    public function create()
    {
        $db = new DataBase();
        $sql = "SELECT `id`,`name` FROM `categories` ORDER BY `id` ASC;";
        $categories = $db->select($sql);
        require_once (realpath(dirname(__FILE__) . "/../template/panel/articles/create.php"));

    }
    public function store($request)
    {

        $manage = new ManageAuth();

        $db = new DataBase();
        if($request['category_id'] != NULL){
            $request['image'] = $this->saveImage($request["image"],"article-images");
            if($request['image']){
                $request = array_merge($request,["user_id"=>$manage->getValueFromCookieOrSession("user")['id']]);
                $db->insert('articles',array_keys($request),$request);
                $this->redirect('article');

            }
            else{
                $this->redirectback();
            }
        }
        else{
            $this->redirectback();
        }

    }

    public function suggested($id){
        $db = new DataBase();
        $article = $db->select("SELECT `suggested` FROM `articles` WHERE `id` = ? ;", [$id])->fetch();
        if ($article['suggested'] == "off"){
            $articleFind = $db->select("SELECT `suggested` FROM `articles` WHERE `suggested` ='on' ;");
            if ($articleFind->rowCount() >= 6){
                $this->redirect("article?suggested=full");
            }
            else{
                $db->update("articles",["suggested"],["on"],$id);
                $this->redirect("article");
            }
        }
        else{
            $db->update("articles",["suggested"],["off"],$id);
            $this->redirect("article");
        }

    }

    public function edit ($id)
    {
        $db = new DataBase();
        $sqlcategory = "SELECT `id`,`name` FROM `categories` ORDER BY `id` ASC;";
        $categories = $db->select($sqlcategory);
        $sqlarticle = "SELECT * FROM `articles` WHERE `id` = ?";
        $article = $db->select($sqlarticle,[$id])->fetch();
        require_once (realpath(dirname(__FILE__) . "/../template/panel/articles/edit.php"));

    }
    public function update($request,$id)
    {
        $manage = new ManageAuth();
        $db = new DataBase();
        if($request['category_id'] != NULL){
            if($request['image']['tmp_name'] != null){
                $article = $db->select("SELECT * FROM `articles` WHERE (`id` = ?); ", [$id])->fetch();
                $this->removeImage($article['image']);
                $request['image'] = $this->saveImage($request['image'], 'article-images');
            }
            else{
                unset($request['image']);
            }
            $request = array_merge($request,['user_id'=>$manage->getValueFromCookieOrSession("user")['id']]);
            $db->update("articles",array_keys($request),$request,$id);
            $this->redirect('article');
        }
        else{
            $this->redirectback();
        }

    }
    public function delete($id)
    {
        $db = new DataBase();
        $sqlarticle = "SELECT `image` FROM `articles` WHERE `id` = ?";
        $article = $db->select($sqlarticle,[$id])->fetch();
        $this->removeImage($article['image']);
        $db->delete('articles',$id);
        $this->redirectback();
    }




}