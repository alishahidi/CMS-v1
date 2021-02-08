

<?php
require_once(BASE_PATH . "/template/auth/layouts/header-tag.php");
?>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-b-30">
            <form method="post" onsubmit="return checkForm()" action="<?= url("register/store")?>" class="login100-form validate-form">

					<span class="login100-form-title p-t-20 p-b-45">
                    ثبت نام در سایت
				    </span>

                <div class="wrap-input100 validate-input m-b-10">
                    <input class="input200 radius-top" type="text" id="name" name="name" placeholder="نام (بزرگتر از 5 کارکتر)" onchange="nameValid()" oninput="nameValid()">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-address-card" aria-hidden="true"></i>
                    </span>
                    <span  class="symbol-input100-valid">
                        <i id="validate-name" class=""></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input m-b-10">
                    <input class="input200" type="text" id="username" name="username" placeholder=" نام کاربری (بزرگتر از 5 کارکتر)" onchange="usernameValid()" oninput="usernameValid()">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user"></i>
                    </span>
                    <span  class="symbol-input100-valid">
                        <i id="validate-username" class=""></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input m-b-10">
                    <input class="input200" type="email" id="email" name="email" placeholder="ایمیل" onchange="emailValid()" oninput="emailValid()">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    <span  class="symbol-input100-valid">
                        <i id="validate-email" class=""></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input m-b-10">
                    <input class="input200" type="password" id="password" name="password" placeholder="رمز عبور (بزرگتر از ۸ کارکتر)" onchange="testPass()"  oninput="testPass()">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                <i class="fa fa-lock position-relative bottom-fix"></i>
                    </span>
                    <span  class="symbol-input100-valid">
                        <i id="validate-password" class=""></i>
                    </span>
                    <div class="strong-pass-area mb-0 border-bottom">
                        <p class="text-info text-center">حداقل باید شامل حروف کوچک , حروف بزرگ , اعداد  , بزرگتر از ۸ کارکتر و انگلیسی و همچنین بهتر است شامل  ^&*%$?#@! نیز باشد. وقتی نوار پایین به رنگ آبی در بیاید پسورد شما پسورد قابل قبول سیستم میباشد  </p>
                    </div>
                    <div class="strong-pass-area ltr mt-0">
                        <div class="progress ltr" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" id="strongPass" style="width: 0;height: 20px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="wrap-input100 validate-input m-b-10">
                    <input class="input200 padding-right-big" type="password" id="rePass" name="repassword" onchange="reCheck()" oninput="reCheck()" placeholder="تکرار رمز عبور">
                    <span class="focus-input100"></span>
                    <span id="icon-group-rePass" class="symbol-input100">
                <i class="fa fa-lock pl-1"></i><i class="fa fa-lock"></i>
                    </span>
                    <span id="icon-group" class="symbol-input100-valid">
                        <i id="validate-repassword" class=""></i>
                    </span>
                </div>

                <div class="wrap-input100 m-b-10 d-flex justify-content-center">
                        <!-- <div class="captcha d-flex justify-content-start m-b-10">
                            <div class="captcha-inner">
                        <img src="<?= url("admin-Dashboard/Captcha.php")?>" id="captcha" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha" onclick="refreshCaptcha()"></i>

                            </div>
                        </div>

                        <input class="input200 radius-bottom" type="text" id="captcha" name="captcha" placeholder="لطفا کد امنیتی را وارد کنید" autocomplete="off"> -->

                        <div class="g-recaptcha d-block" data-sitekey="6LfngNAZAAAAAGPRBeZLNLldcQQT-IeTqUDq3x0Y
"></div>
                    </div>

                <div class="container-login100-form-btn p-t-10">
                    <button type="submit" class="login100-form-btn">
                        ثبت نام
                    </button>
                </div>

                <div class=" w-full p-t-10 mr-2">
                    <a href="#" class="txt1">
ورود به حساب
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<?php
require_once(BASE_PATH . "/template/auth/layouts/footer-tag.php");
?>

<script>

    <?php if ($_SERVER["HTTP_REFERER"] ==  url("register")){ ?>
    swal({
        title: "مشخصات را دوباره وارد کنید",
        text: "خطایی رخ داده است",
        icon: "error",
        button: "باشه",
    });
    <?}?>

    <?php if ($verify['captcha'] ==  "false"){?>
    swal({
        title: "خطر امنیتی",
        text: "لطفا reCAPTCHA را تکمیل یا درست تکیل کنید",
        icon: "error",
        button: "باشه",
    });
    <?php }?>

    <?php if ($verify['password'] ==  "false"){ ?>
    swal({
        title: "پسورد وارد شده ضعیف است",
        text: "قدرت پسورد را میتوانید از  نوار پایینی آن تشخیص دهید پسورد باید حداقل باید شامل حروف کوچک , حروف بزرگ , اعداد , بزرگتر از ۸ کارکتر و انگلیسی و همچنین بهتر است شامل ^&*%$?#@! نیز باشد وقتی نوار پایین به رنگ آبی در بیاید پسورد شما پسورد قابل قبول سیستم میباشد  ",
        icon: "error",
        button: "باشه",
    });
    <?}?>


    <?php if ($verify['email'] ==  "false"){ ?>
    swal({
        title: "ایمیل اشتباه وارد شده است",
        text: "لطفا ایمیل را درست وارد کنید",
        icon: "error",
        button: "باشه",
    });
    <?}?>


    <?php if ($verify['available'] ==  "true"){ ?>
    swal({
        title: "کاربری با این مشخصات وجود دارد",
        text: "لطفا اگر این مشخصات حساب شماست در بخش ورود به سایت به حساب خود وارد شوید همچنین در صورت فراموشی رمز عبور خود میتوانید در بخش ورود به سایت در قسمت فراموشی رمز عبور اقدام به بازیابی رمز عبور خود کنید",
        icon: "error",
        button: "باشه",
    });
    <?}?><?php if ($verify['empty'] ==  "true"){ ?>
    swal({
        title: "فیلد ها خالی هستند",
        text: "لطفا تمام فیلد ها را پر کنید",
        icon: "error",
        button: "باشه",
    });
    <?}?>

</script>






