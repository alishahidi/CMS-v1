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
    <script src="https://www.google.com/recaptcha/api.js?hl=fa" async defer></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Setrical Login</title>
    <link rel="stylesheet" href="<?= asset("public/css/util/bootstrap.min.css") ?>">
    <script src="<?= asset("public/js/auth/main.js") ?>"></script>

    <link rel="stylesheet" href="<?= asset("public/css/util/loader.css") ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= asset("public/css/auth/login-register-style.css") ?>">

</head>

<body onload="load()">
    <section class="loading" id="loading">
        <div data-loader='spinner'></div>
        <h2 class="clear-fix">لطفا صبر کنید</h2>
    </section>