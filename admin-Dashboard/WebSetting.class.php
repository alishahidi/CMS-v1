<?php
namespace AdminDashboard;
require_once ("Admin.Class.php");
require_once (realpath(dirname(__FILE__)."/DataBase.php"));
require_once ("jdf.php");
use DataBase\DataBase;
use AdminDashboard\Admin;
use function Sodium\crypto_aead_aes256gcm_decrypt;
use function Sodium\crypto_sign_ed25519_sk_to_curve25519;


class WebSetting extends Admin
{

    public function index()
    {
        $db = new DataBase();
        $settingsql = "SELECT * FROM `websetting`";
        $setting = $db->select($settingsql)->fetch();
        require_once (realpath(dirname(__FILE__) . "/../template/panel/web-setting/web-setting.php"));
    }

    public function set()
    {
        $db = new DataBase();
        $settingsql = "SELECT * FROM `websetting`";
        $setting = $db->select($settingsql)->fetch();
        require_once (realpath(dirname(__FILE__) . "/../template/panel/web-setting/set.php"));
    }

    public function store($request)
    {
        $db = new DataBase();
        $settingsql = "SELECT * FROM `websetting`";
        $setting = $db->select($settingsql)->fetch();


        if ($request["logo"]["tmp_name"] != null) {
            $this->removeImage($setting['logo']);
            $request['logo'] = $this->saveImage($request['logo'], "Web-Setting", "logo");
        }
        else{
            unset($request['logo']);
        }

        if ($request['icon']['tmp_name'] != null){
            $this->removeImage($setting['icon']);
            $request['icon'] = $this->saveImage($request['icon'],"Web-Setting","icon");
        }
        else{
            unset($request['icon']);
        }

        if($setting != null){
            $db->update('websetting',array_keys($request),$request,$setting['id']);
        }
        else{
            $db->insert('websetting',array_keys($request),$request);
        }
        $this->redirect("web-setting");
    }



}