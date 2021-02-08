<?php

namespace AdminDashboard;

require_once(BASE_PATH . "/admin-Dashboard/Admin.Class.php");
require_once(BASE_PATH . "/admin-Dashboard/DataBase.php");
require_once(BASE_PATH . "/admin-Dashboard/jdf.php");

use DataBase\DataBase;
use AdminDashboard\Admin;


class Ads extends Admin
{

    public function index()
    {

        $db = new DataBase();

        $ad1TopSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `ad_id` = ? AND `type` = ? ";
        $ad1Top = $db->select($ad1TopSql, [1,'top'])->fetch();

        $ad2TopSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `ad_id` = ? AND `type` = ? ";
        $ad2Top = $db->select($ad2TopSql, [2,'top'])->fetch();

        $ad1SidebarSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `ad_id` = ? AND `type` = ? ";
        $ad1Sidebar = $db->select($ad1SidebarSql, [1,'sidebar'])->fetch();


        $ad2SidebarSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `ad_id` = ? AND `type` = ? ";
        $ad2Sidebar = $db->select($ad2SidebarSql, [2,'sidebar'])->fetch();


        $ad3SidebarSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `ad_id` = ? AND `type` = ? ";
        $ad3Sidebar = $db->select($ad3SidebarSql, [3,'sidebar'])->fetch();

        require_once(BASE_PATH . "/template/panel/ads/index.php");
    }

    public function set($type)
    {
        $db = new DataBase();
        $type = explode(",", $type);
        $pos = $type[0];
        $id = $type[1];

        $adSql = "SELECT `id`,`image`,`url` FROM `ads` WHERE `ad_id` = ? AND `type` = ? ";
        $ad = $db->select($adSql, [$id, $pos])->fetch();


        require_once(BASE_PATH . "/template/panel/ads/set.php");
    }

    public function store($request, $type)
    {
        $db = new DataBase();
        $type = explode(",", $type);
        $pos = $type[0];
        $id = $type[1];

        $adSql = "SELECT `ad_id`,`image`,`id`,`url` FROM `ads` WHERE `ad_id` = ? AND `type` = ?  ";
        $ad = $db->select($adSql, [$id, $pos])->fetch();


        if ($request["image"]["tmp_name"] != null) {
            if ($ad['image']) {
                $this->removeImage($ad['image']);
                if ($pos == "top") {
                    $request['image'] = $this->saveImage($request['image'], "Ads", "top-" . $id);
                } elseif ($pos == "sidebar") {
                    $request['image'] = $this->saveImage($request['image'], "Ads", "sidebar-" . $id);
                }
            } else {
                if ($pos == "top") {
                    $request['image'] = $this->saveImage($request['image'], "Ads", "top-" . $id);
                } elseif ($pos == "sidebar") {
                    $request['image'] = $this->saveImage($request['image'], "Ads", "sidebar-" . $id);
                }
            }
        } else {
            unset($request['image']);
        }
        $request["ad_id"] = $id;
        $request['type'] = $pos;

        if ($ad != null) {
            $db->update('ads', array_keys($request), $request, $ad['id']);
        } else {
            $db->insert('ads', array_keys($request), $request);
        }

        $this->redirect("ads");
    }

    public function delete($type)
    {
        $db = new DataBase();
        $type = explode(",", $type);
        $pos = $type[0];
        $id = $type[1];

        $adSql = "SELECT `ad_id`,`image`,`id`,`url` FROM `ads` WHERE `ad_id` = ? AND `type` = ?  ";
        $ad = $db->select($adSql, [$id, $pos])->fetch();

        if ($ad['image']) {
            $this->removeImage($ad['image']);
        }

        $db->delete("ads",$ad['id']);

        $this->redirectback();
    }
}
