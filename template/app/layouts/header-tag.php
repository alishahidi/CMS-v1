
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlentities($setting['title']) ?></title>
    <link rel="stylesheet" href="<?= asset("public/css/util/loader.css")?> ">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= asset("public/css/app/style.css")?> ">
    <link rel="stylesheet" href="<?= asset("public/css/app/component.css")?> ">
    <link rel="shortcut icon" href="<?= asset("public/images/Web-Setting/favicon.ico")?> ">

</head>


<body onload="load()">
<section class=" clear-fix">
</section>
<section class="loading" id="loading">
    <div data-loader='spinner'></div>
    <h2 class="clear-fix">لطفا صبر کنید</h2>
</section>
<header>
    <section class="header-top-row">
        <section class="app">
            <section class="header-top">
            <?php
            if(isset($user['image'])){?>
            <div class="header-img-profile">

            <a href="<?= url("user/panel") ?>">
            <img class="header-profile" src="<?= url(htmlentities($user['image'])) ?>" alt="profile image" width="50px" height="50px">
            </a>
            </div>

            <?}else{?>
                <a class="login-header" href="<?= url("login") ?>">ورود به سایت</a>
            <?}
            ?>

            </section>
        </section>
    </section>
    <section class="app">
        <section class=" clear-fix">
        </section>
    <nav class="header">
        <img class="header-logo" src="<?= url(htmlentities($setting['logo'])) ?>" alt="در حال بارگذاری">        <button class="header-menu-burger" onclick="showMenu()" type="button"><i
                    class="fas fa-bars"></i></button>
        <ul class="header-menu" id="menu">
            <?php
            $i=0;
            foreach ($menus as $menu){
                if($menu['submenu_count'] > 0){
                ?>
            <li class="header-menu-item">
                <a class="header-menu-item-link" href="<?= url(htmlspecialchars($menu['url'])) ?>"><?php echo htmlentities($menu['name'])?></a>
                <span class="drop-down" onclick="dropShow(<?php echo $i ?>)">
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                </span>
                <div class="drop-down-content z-index-max" id="drop">
                    <ul class="drop-down-menu">
                        <?php foreach ($submenus as $submenu) {
                            if($submenu['parent_id'] == $menu['id']){
                         ?>
                        <li class="drop-down-menu-item"><a class="header-menu-item-link" href="<?= url(htmlspecialchars($submenu['url'])) ?> >"><?php echo htmlentities($submenu['name'])?></a></li>
                        <?php }} ?>
                    </ul>
                </div>
            </li>
            <?php
                $i++;
                }else{?>
                    <li class="header-menu-item">
                        <a class="header-menu-item-link" href="<?= url(htmlspecialchars($menu['url'])) ?>"><?php echo htmlentities($menu['name'])?></a>
                    </li>
                <?}

            } ?>
        </ul>
    </nav>
        <section class="clear-fix"></section>
    </section>
</header>
<div id="block" class="block"></div>
<section class="app">


