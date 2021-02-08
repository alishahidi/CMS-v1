
<?php
require_once(BASE_PATH . "/template/auth/layouts/header-tag.php");
?>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-150 p-b-30">
				<form method="post" action="<?= url("user/two-verify/check")?>" class="login100-form validate-form">
					<span class="login100-form-title p-t-20 p-b-45">
                    احراز هویت دو مرحله ای
				    </span>
					<div class="wrap-input100 validate-input m-b-10">
						<input class="input100" type="text" name="key" placeholder="کد فعالسازی">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fas fa-lock-open"></i>
						</span>
					</div>
                    <div class="strong-pass-area mb-0 w-100 border-bottom radius-bottom">
                        <p class="text-info text-center">کد فعالسازی به ایمیل شما اسال گردید<br> لطفا بخش spam را در صورت دریافت نکردن کد چک کنید  </p>
                    </div>
					<div class="container-login100-form-btn p-t-10 ">
						<button class="login100-form-btn">
							ورود
						</button>
					</div>

				</form>
                <div class=" w-full p-t-10 mr-2 w-100 text-center">
                    <a href="<?= url("user/two-verify/send-code")?>" class="txt1">
                        کد را دریافت نکردید؟ ارسال دوباره کد فعالسازی
                    </a>
                </div>
			</div>
		</div>
	</div>

<?php
require_once(BASE_PATH . "/template/auth/layouts/footer-tag.php");
?>

<script>

    <?php if (isset($status['status']) && $status['status'] == "false" ){ ?>
    swal({
        title: "کد فعالسازی اشتباه است",
        text: "کد را درست وارد کنید",
        icon: "error",
        button: "باشه",
    });
    <?php } ?>

    <?php if (isset($status['send']) && $status['send'] == "true" ){ ?>
    swal({
        title: "ایمیل با موفقیت ارسال شد",
        icon: "success",
        button: "باشه",
    });
    <?php } ?>

    <?php if (isset($status['send']) && $status['send'] == "false" ){ ?>
    swal({
        title: "عملیات ارسال ایمیل شکست خورد",
        text: "میتواند بدلیل اشتباه بودن ایمیل باشد",
        icon: "error",
        button: "باشه",
    });
    <?php } ?>

    <?php if (isset($status['exp']) && $status['exp'] == "true" ){ ?>
    swal({
        title: "هنوز 2 دقیقه از ارسال قبلی نگذشته است",
        text: "لطفا هر 2 دقیقه یکبار اقدام کنید",
        icon: "error",
        button: "باشه",
    });
    <?php } ?>

    <?php if (isset($status['codeExp']) && $status['codeExp'] == "true" ){ ?>
    swal({
        title: "کد فعالسازی منقضی شده است",
        icon: "error",
        button: "باشه",
    });
    <?php } ?>

</script>
	





