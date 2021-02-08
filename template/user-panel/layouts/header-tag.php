<?php
if (isset($db)) {
    $payload = $this->getValueFromCookieOrSession("user");

    if ($payload) {
        $usersql = "SELECT * FROM `users` WHERE `id` = ?";
        $user = $db->select($usersql, [$payload['id']])->fetch();
    }
} else {

    $db = new \DataBase\DataBase();

    $payload = $this->getValueFromCookieOrSession("user");

    if ($payload) {
        $usersql = "SELECT * FROM `users` WHERE `id` = ?";
        $user = $db->select($usersql, [$payload['id']])->fetch();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-178893714-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-178893714-1');
</script>

    <script type="text/javascript">
        var timerStart = Date.now();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Setrical</title>
    <link rel="stylesheet" href="<?= asset("public/css/util/bootstrap.min.css")?> ">
    <link rel="stylesheet" href="<?= asset("public/css/util/loader.css")?> ">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="<?= asset("public/css/util/mdbootstrap.min.css")?> "rel="stylesheet">
    <link rel="stylesheet" href="<?= asset("public/css/user-panel/style.css")?> ">
</head>
<body onload="load()">
<section class="loading" id="loading">
    <div data-loader='spinner'></div>
    <h2 class="clear-fix">لطفا صبر کنید</h2>
</section>

<div id="block" class="block"></div>
    <nav class="navbar  navbar-light bg-gradiant-green-blue nav-shadow">
        <a class="navbar-brand" href="#">پنل کاربری</a>
        <span class="">

            <span class="dropdown">
                <a class="dropdown-toggle text-decoration-none text-dark" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> <?php echo htmlentities($user['name']) ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="user/panel/security/#password">بازیابی رمز عبور</a>
                    <a class="dropdown-item" href="<?= url("logout") ?>" >خارج شدن از حساب</a>
                </div>
            </span>
        </span>
    </nav>

<div class="menu-burger" id="bars-menu">
    <i class="fa fa-bars mr-5 mt-5 d-none" aria-hidden="true"></i>
</div>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-block pt-3 bg-sidebar sidebar px-0">
                <a class="text-decoration-none d-block py-1 px-2 mt-0" href="<?= url("user/panel/ticket")?>"><i class='fas fa-comment-alt'></i>
                    پیام های پشتیبانی</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("user/panel/comment")?>"><i
                        class="fas fa-clipboard-list"></i>
                    نظرات داده شده </a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("user/panel/notification")?>"><i class="fas fa-bell"></i> اعلانات
                </a>
                <a class="text-decoration-none d-block py-1 ml-1 px-2 mt-3" href="<?= url("user/panel/profile")?>"><i class="fas fa-user"></i>مدیریت پروفایل کاربری
                </a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("user/panel/security")?>"><i class='fas fa-fingerprint'></i>امنیت</a>
                <?php if($user['permission'] != "user" || $user['permission'] != "ban"){?>
                         <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("admin")?>"><i class='fas fa-fingerprint'></i>ادمین پنل</a>
                <?php } ?>
            </nav>
            <main role="main" class="maintag col-md-9 ml-sm-auto col-lg-10 px-4">
