
<?php
require_once(BASE_PATH . "/template/auth/layouts/header-tag.php");
?>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-150 p-b-30">
				<form method="post" action="<?= url("check-login")?>" class="login100-form validate-form">

					<span class="login100-form-title p-t-20 p-b-45">
                    ورود به سایت	
				    </span>

					<div class="wrap-input100 validate-input m-b-10">
						<input class="input200 radius-top" type="text" name="key" placeholder="ایمیل یا نام کاربری">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10">
						<input class="input200" type="password" name="password" placeholder="رمز عبور">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
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


                    
                    <div class="wrap-input100 check-form100 mt-1 ">
                     <div class="form-check100">
                        <input class="form-check-input100" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label100" for="remember">
                            مرا تا ۳۰ روز بخاطر بسپار
                        </label>
                     </div>
                    </div>


					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							ورود
						</button>
					</div>

					<!--<div class="text-center w-full p-t-10">-->
					<!--	<a href="#" class="txt1">-->
     <!--                   فراموشی رمز عبور						-->
     <!--                       </a>-->
					<!--</div>-->

					<div class="text-center w-full p-t-10">
						<a class="txt1" href="register">
                      ساخت حساب جدید							
                       <i class="fa fa-long-arrow-right"></i>						
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
    // swal({
    //     title: "فیلد ها خالی هستند",
    //     text: "لطفا تمام فیلد ها را پر کنید",
    //     icon: "error",
    //     button: "باشه",
    // });
    <?php if ($_SERVER["HTTP_REFERER"] ==  url("login")){ ?>
    swal({
        title: "مشخصات را دوباره وارد کنید",
        text: "نام کاربری,ایمیل یا رمز عبور اشتباه است",
        icon: "error",
        button: "باشه",
    });
    <?php }?>

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
        title: "پسورد وارد شده اشتباه است",
        icon: "error",
        button: "باشه",
    });
    <?php }?>

    <?php if ($verify['available'] ==  "false"){ ?>
    swal({
        title: "کاربری با این مشخصات وجود ندارد",
        text: "لطفا اگر حسابی ندارید ابتدا ثبت نام کنید سپس با حساب ساخته شده وارد حساب خود شوید میتوانید از بخش ساخت حساب جدید اقدام کنید",
        icon: "error",
        button: "باشه",
    });

    <?php } ?>
    <?php

    
    if ($verify['empty'] ==  "true"){ ?>
    swal({
        title: "فیلد ها خالی هستند",
        text: "لطفا تمام فیلد ها را پر کنید",
        icon: "error",
        button: "باشه",
    });
    <?php }?>

</script>
	





