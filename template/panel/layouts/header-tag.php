<?php
if (isset($db)) {
    $settingsql = "SELECT * FROM `websetting`";
    $setting = $db->select($settingsql)->fetch();
    $userssql = "SELECT * FROM `users`";
    $users = $db->select($userssql);

    $payload = $this->getValueFromCookieOrSession("user");

    if ($payload) {
        $usersql = "SELECT `name`,`image` FROM `users` WHERE `id` = ?";
        $user = $db->select($usersql, [$payload['id']])->fetch();
    }

    $commentUnseenCountSql = "SELECT COUNT(*) FROM `comments` WHERE `status` = 'unseen';";
    $commentUnseenCount = $db->select($commentUnseenCountSql)->fetch();
} else {

    $db = new \DataBase\DataBase();
    $settingsql = "SELECT * FROM `websetting`";
    $setting = $db->select($settingsql)->fetch();
    $userssql = "SELECT * FROM `users`";
    $users = $db->select($userssql);

    $payload = $this->getValueFromCookieOrSession("user");

    if ($payload) {
        $usersql = "SELECT `name`,`image` FROM `users` WHERE `id` = ?";
        $user = $db->select($usersql, [$payload['id']])->fetch();
    }

    $commentUnseenCountSql = "SELECT COUNT(*) FROM `comments` WHERE `status` = 'unseen';";
    $commentUnseenCount = $db->select($commentUnseenCountSql)->fetch();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-178893714-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-178893714-1');
    </script>

    <script type="text/javascript">
        var timerStart = Date.now();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo htmlentities($setting['title']) ?></title>
    <link rel="shortcut icon" href="<?= asset(htmlentities($setting['icon'])) ?>" />
    <link rel="stylesheet" href="<?= asset("public/css/util/bootstrap.min.css") ?> ">
    <link rel="stylesheet" href="<?= asset("public/css/util/loader.css") ?> ">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="<?= asset("public/css/util/mdbootstrap.min.css") ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset("public/css/admin-panel/style.css") ?> ">

</head>

<body onload="load()">
    <section class="loading" id="loading">
        <div data-loader='spinner'></div>
        <h2 class="clear-fix">لطفا صبر کنید</h2>
    </section>
    <div id="block" class="block"></div>
    <nav class="navbar  navbar-light bg-gradiant-green-blue nav-shadow">
        <a class="navbar-brand" href="<?= url("home") ?>"><?php echo htmlentities($setting['title']) ?></a>
        <span class="">

            <span class="dropdown">
                <a class="dropdown-toggle text-decoration-none text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="header-profile-img" src="<?= url($user['image']) ?>" alt="loading"> <?= $user['name'] ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= url("user/panel/security#changePass") ?>">تغییر رمز
                        عبور</a>
                    <a class="dropdown-item" href="<?= url("logout") ?>">خارج شدن از حساب</a>
                </div>
            </span>
            <a class="text-decoration-none px-3 text-dark" href="<?= url("comment") ?>"><svg width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-chat-text-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z" />
                </svg>
                </svg> <?php if ($commentUnseenCount['COUNT(*)']) { ?>
                    <span class="badge badge-secondary"><?php echo htmlentities($commentUnseenCount['COUNT(*)']) ?>
                        جدید!</span> <?php } ?></a>
        </span>
    </nav>

    <div class="menu-burger" id="bars-menu">
        <i class="fa fa-bars mr-5 mt-5 d-none" aria-hidden="true"></i>
    </div>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 pt-3 bg-sidebar sidebar px-0">
                <a class="text-decoration-none d-block py-1 px-2 mt-0" href="<?= url("admin") ?>"><i class=" fas fa-home"></i>
                    خانه</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("category") ?>"><i class="fas fa-clipboard-list"></i>
                    دسته بندی ها </a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("article") ?>"><i class="fas fa-newspaper"></i> پست ها
                </a>
                <a class="text-decoration-none d-block py-1 ml-1 px-2 mt-3" href="<?= url("menu") ?>"><i class="fas fa-bars"></i>منو
                </a>

                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("comment") ?>"><i class="fas fa-comments"></i> نظرات</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("user") ?>"> <i class="fa fa-users" aria-hidden="true"></i>

                    کاربران</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("web-setting") ?>"><i class="fa fa-cogs" aria-hidden="true"></i>
                    تنظیمات سایت</a>

                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("ads") ?>">
                    <i class="fas fa-ad    "></i>
                    تبلیغات</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("user/panel") ?>">
                    <i class="fas fa-solar-panel"></i>
                    پنل کاربری</a>
                    <a class="text-decoration-none d-block py-1 px-2 mt-3" href="<?= url("home") ?>"><i class="fas fa-globe"></i>
                    وبسایت</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="https://185.94.97.202:2095/" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i>
                    webMail</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="https://www.alishahidinet.ir:2082" target="_blank"><i class="fab fa-cpanel"></i>
                    cpanel Link 1</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="https://www.alishahidinet.ir:2083" target="_blank"><i class="fab fa-cpanel"></i>
                    cpanel Link 2 <span class="badge badge-success badge-pill">Active</span></a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="https://185.94.97.202:2082" target="_blank"><i class="fab fa-cpanel"></i>
                    cpanel Link 3</a>
                <a class="text-decoration-none d-block py-1 px-2 mt-3" href="https://dash.cloudflare.com/c26ce26092da157dbf5726cf298b4fb5/alishahidinet.ir" target="_blank"><i class="fas fa-cloud"></i>
                    cloudflare <span class="badge badge-warning badge-pill">just Owner</span></a>

            </nav>
            <main role="main" class="maintag col-md-9 ml-sm-auto col-lg-10 px-4 pb-5">