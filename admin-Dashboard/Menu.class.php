<?php
namespace AdminDashboard;
require_once ("Admin.Class.php");
require_once (realpath(dirname(__FILE__)."/DataBase.php"));
require_once ("jdf.php");
use DataBase\DataBase;
use AdminDashboard\Admin;


class Menu extends Admin
{

    public function index()
    {

        $db = new DataBase();
        $menusql = "SELECT `id`,`name`,`parent_id` FROM `menus` WHERE `parent_id` IS NULL ";
        $menus = $db->select($menusql);
        require_once (realpath(dirname(__FILE__) . "/../template/panel/menus/menus.php"));
    }

    public function show($id)
    {
        $db =  new DataBase();
        $sql = "SELECT * FROM `menus` WHERE `id` = ?";
        $menu = $db->select($sql,[$id])->fetch();
        require_once (realpath(dirname(__FILE__) . "/../template/panel/menus/show.php"));
    }

    public function create($id = null)
    {
        $db = new DataBase();
        $menusql = "SELECT `name`,`id` FROM `menus` WHERE `parent_id` IS NULL ";
        if($id){
            require_once (realpath(dirname(__FILE__) . "/../template/panel/menus/create_submenu.php"));

        }
        else{
            require_once (realpath(dirname(__FILE__) . "/../template/panel/menus/create_menu.php"));
        }
    }

    public function store($request,$id = null)
    {
        $db =  new DataBase();
        if($id){
            $arraypushvalue = ["parent_id"=>$id];
            $db->insert('menus',array_keys(array_merge($request,$arraypushvalue)),array_merge(array_filter($request),$arraypushvalue));
        }
        else{
            $db->insert('menus',array_keys(array_filter($request)),array_filter($request));
        }

        $this->redirect("menu");
    }

    public function edit($id)
    {
        $db =  new DataBase();
        $uri = "menu/edit/menu/{id}";
        $subURIs = explode("/",$uri);
        $request_uri = array_slice(explode("/",$_SERVER["REQUEST_URI"]),2);

        if($request_uri[sizeof($request_uri) - 1 ] == ""){
            unset($request_uri[sizeof($request_uri) - 1 ]);
        }   

        if(sizeof($request_uri) == sizeof($subURIs)){

          foreach (array_combine($subURIs,$request_uri) as $subURI => $request){

            if($request == $subURI){
                $menusql = "SELECT `id`,`name`,`url` FROM `menus` WHERE `id` = ?";
                $menu = $db->select($menusql,[$id])->fetch();
                require_once (realpath(dirname(__FILE__) . "/../template/panel/menus/edit_menu.php"));
            break;
            }
            else{
                $menussql = "SELECT `name`,`id`,`url` FROM `menus` WHERE `parent_id` IS NULL";
                $menus = $db->select($menussql,[$id]);
                $menusql = "SELECT `id`,`name`,`parent_id`,`url` FROM `menus` WHERE `id` = ?";
                $menu = $db->select($menusql,[$id])->fetch();
                require_once (realpath(dirname(__FILE__) . "/../template/panel/menus/edit_submenu.php"));
            break;

            }
           }
        }
    }

    

    public function update($request,$id)
    {
        $db =  new DataBase();
        $db->update('menus',array_keys($request),$request,$id);
        $this->redirect("menu");
    }

    public function delete($id)
    {
        $db = new DataBase();
        $db->delete('menus',$id);
        $this->redirectback();
    }


}