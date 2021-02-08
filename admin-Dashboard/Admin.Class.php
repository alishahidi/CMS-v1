<?php
  namespace AdminDashboard;
  require_once ("jdf.php");
  require_once("ManageAuth.class.php");
  require_once("Auth.class.php");
  use AdminDashboard\ManageAuth;
  use AdminDashboard\Auth;

  class Admin extends ManageAuth{

      function __construct()
      {
          if(session_status() == PHP_SESSION_NONE){
              session_start();
          }
          if(isset($_SESSION['user'])){
              if (!$this->checkSessionExp($_SESSION['user'])){
                  $this->removeSession($_SESSION['user']);
              }
          }
          $auth = new Auth();
          $auth->checkAdmin();
          $this->currentDomain = CURRENT_DOMAIN;
          $this->basePath = BASE_PATH;
    }


      protected function redirect($url){
          header('location:'.trim($this->currentDomain,"/ ")."/".trim($url,"/ "));
          exit;
      }

      protected function redirectback(){
           header('location:'.$_SERVER['HTTP_REFERER']);
          exit;

      }

      protected function saveImage($image,$imagepath,$imagename=NULL){
          

          if($imagename) {
              $splitimage = explode("/", $image['type']);
              $imagename = $imagename . "." . substr($image['type'], strlen($splitimage[0]) + 1, strlen($image['type']));
          }
          else{
              $b = rand(1,93472829); //کاهش خطا های احتمالی
              $splitimage = explode("/",$image['type']);
              $imagename = jdate('Y-n-j','','','Asia/Tehran','en')."_".jdate('H-i-s','','','Asia/Tehran','en')."_".$b."_".".".substr($image['type'],strlen($splitimage[0]) + 1,strlen($image['type']));
          }

          $imagetmp = $image['tmp_name'];
          $imagepath = "public/images/".$imagepath."/";

          if(is_uploaded_file($imagetmp)){
                  if(move_uploaded_file($imagetmp,$imagepath.$imagename)){
                      return $imagepath.$imagename;
                      return true;
                  }
                  else{
                      return false;
                  }
          }
          else{
              return false;
          }
      }

      protected function removeImage($imagePath){
          $imagePath = $this->basePath."/".$imagePath;
          unlink($imagePath);
      }

  }





