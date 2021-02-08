<?php
namespace AdminDashboard;
require_once("ManageAuth.class.php");
use AdminDashboard\ManageAuth;
$manage = new ManageAuth();

$image = $manage->captcha();
header('Content-type: image/png');

imagepng($image);
imagedestroy($image);

?>