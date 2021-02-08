<?php
namespace AdminDashboard;
require_once ("Admin.Class.php");
require_once (realpath(dirname(__FILE__)."/DataBase.php"));
require_once ("jdf.php");
use DataBase\DataBase;
use AdminDashboard\Admin;

class Category extends Admin{

   
    public function index()
    {
      $db =  new DataBase();
      $sql = "SELECT * FROM categories ORDER BY `id` ASC";
      $categories =  $db->select($sql);
      require_once (realpath(dirname(__FILE__) . "/../template/panel/categories/categories.php"));
    }


    
    public function show($id)
    {
      $db =  new DataBase();
      $sql = "SELECT * FROM categories WHERE `id` = ?";
      
      $category = $db->select($sql,[$id])->fetch();
      require_once (realpath(dirname(__FILE__) . "/../template/panel/categories/show.php"));
      
    }




    public function create()
    {
      require_once (realpath(dirname(__FILE__) . "/../template/panel/categories/create.php"));

    }




    public function store($request)
    {
      if($request['name'] == "" ){
        $this->redirectback();
      }
      else{
        $db =  new DataBase();
        $db->insert('categories',array_keys($request),$request);
        $this->redirect("category");
      }
 

    }




    public function edit($id)
    {
      $db =  new DataBase();
      $sql = "SELECT * FROM categories WHERE `id` = ?";
      $category = $db->select($sql,[$id])->fetch();
      require_once (realpath(dirname(__FILE__) . "/../template/panel/categories/edit.php"));

    }

    public function update($request,$id)
    {
      $db =  new DataBase();
      $db->update('categories',array_keys($request),$request,[$id]);
      $this->redirect("category");
    }

    public function delete($id)
    {
        $db= new DataBase();
        $db->delete('categories',$id);
        $this->redirectBack();

    }

      



}


?>