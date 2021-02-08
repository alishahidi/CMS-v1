
<?php
require_once(BASE_PATH . "/template/user-panel/layouts/header-tag.php");
?>
<div class="text-dark mt-3 pb-1 border-bottom">
    <h5 class="">وضعیت حساب</h5>
</div>

<div class="verify ml-4 mt-4 mb-2 p-4 col-10">

    <?php
    if ($user['verify'] == "active"){?>
        <span class="text-dark">وضعیت:</span><span class="badge badge-pill badge-success mr-2">فعال</span>
    <?}
    else{?>
        <div class="row mb-3">
            <span class="text-dark">وضعیت:</span><span class="badge badge-pill badge-danger mr-2">غیر فعال</span>
        </div>
        <div class="row mb-3">
            <a href="<?= url("user/email-verify/send")?>" class="btn btn-sm btn-outline-primary text-dark">فعالسازی</a>
        </div>
        <div class="row">
            <blockquote>پس از درخواست به ایمیل خود مراجعه کرده و روی لینک ارسال شده کلیک کنید اگر ایمیلی دریافت نکردید پوشه spam خود را چک کنید.</blockquote>
            <small>هر 2 دقیقه فقط یکبار میتوانید درخواست ایمیل فعالسازی بکنید.</small>
        </div>
    <?}
    ?>
</div>
<div class="text-dark mt-4 mt-3 pb-1 border-bottom">
    <h5 class="">تغییر رمز عبور</h5>
</div>
<div class="change-pass" id="changePass">
    <form method="post" action="<?= url("user/change-password")?>">
        <div class="row mt-2">
            <div class="col-12">
                <div class="form-group">
                    <label for="title">رمز فعلی</label>
                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder=" پسور فعلی را وارد کنید"
                           required>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">رمز جدید</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="پسورد جدید را وارد کنید"
                           required oninput="testPass()" onchange="testPass()">
                    <div class="strong-pass-area mb-0 border-bottom mt-3">
                        <p class="text-info text-center">حداقل باید شامل حروف کوچک , حروف بزرگ , اعداد , ^&*%$?#@! , بزرگتر از ۸ کارکتر و انگلیسی باشد </p>
                    </div>
                    <div class="strong-pass-area ltr mt-0">
                        <div class="progress ltr" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" id="strongPass" style="width: 0;height: 20px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">تکرار رمز</label>
                    <input type="password" class="form-control" id="repassword" name="repassword" placeholder="تکرار پسور را وارد کنید"
                           required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-success">ثبت پسورد جدید</button>
    </form>
</div>

<div class="text-dark mt-4 mt-3 pb-1 border-bottom">
    <h5 class="">تایید دو مرحله ای</h5>
    <blockquote class="mt-1">با انجام اینکار بعد از  خروج از حساب برای وارد شدن باید از طریق ایمیل نیز احراز هویت انجام دهید (اگر در هنگام ورود گزینه مرا بخاطر بسپار را بزنید تا 30 روز ئس از اولین ورود لازم به انجام اینکار نیست مگر اینکه خودتان از حساب دوباره خارج شوید)</blockquote><br>

</div>

<div class="two-verify ml-4 mt-4 mb-2 p-4 col-10">
    <?php
    if ($user['two-verify'] == "active"){?>
        <span class="text-dark">وضعیت:</span><span class="badge badge-pill badge-success mr-2">فعال</span>
        <a href="<?= url("user/two-verify/disable")?>" class="btn btn-sm btn-danger text-light">غیر فعال کردن</a>
    <?}
    else{?>
        <div class="row mb-3">
            <span class="text-dark">وضعیت:</span><span class="badge badge-pill badge-danger mr-2">غیر فعال</span>
        </div>
        <div class="row mb-3">
            <a href="<?= url("user/email-two-verify/send")?>" class="btn btn-sm btn-outline-primary text-dark">فعالسازی</a>
        </div>
        <div class="row">
            <blockquote>پس از درخواست به ایمیل خود مراجعه کرده و روی لینک ارسال شده کلیک کنید اگر ایمیلی دریافت نکردید پوشه spam خود را چک کنید.</blockquote>
            <small>هر 2 دقیقه فقط یکبار میتوانید درخواست ایمیل فعالسازی بکنید.</small>
        </div>
    <?}
    ?>
</div>


<?php
require_once(BASE_PATH . "/template/user-panel/layouts/footer-tag.php");
?>
<script>
<?php if (isset($verify['verify']) && $verify['verify'] == "true" ) { ?>
swal({
    title: "ایمیل با موفقیت ثبت شد",
    icon: "success",
    button: "باشه",
});

<?php } ?>

<?php if (isset($verify['verify']) && $verify['verify'] == "false" ){ ?>
swal({
    title: "عملیات تایید ایمیل شکست خورد",
    text: "میتواند بدلیل منقضی شدن لینک باشد",
    icon: "error",
    button: "باشه",
});
<?php } ?>


<?php if (isset($verify['two-verify']) && $verify['two-verify'] == "true" ){ ?>
swal({
    title: "احراز هویت دو مرحله ای با موفقیت فعال شد",
    icon: "success",
    button: "باشه",
});
<?php } ?>

<?php if (isset($verify['two-verify']) && $verify['two-verify'] == "false" ){ ?>
swal({
    title: "عملیات فعالسازی احراز هویت دو مرحله ای شکست خورد",
    text: "میتواند بدلیل منقضی شدن لینک باشد",
    icon: "error",
    button: "باشه",
});
<?php } ?>
<?php if (isset($verify['two-verify-disable']) && $verify['two-verify-disable'] == "true" ){ ?>
swal({
    title: "احراز هویت دو مرحله ای با موفقیت غیر فعال شد",
    icon: "success",
    button: "باشه",
});
<?php } ?>

<?php if (isset($verify['two-verify-disable']) && $verify['two-verify-disable'] == "false" ){ ?>
swal({
    title: "عملیات غیر فعالسازی احراز هویت دو مرحله ای شکست خورد",
    text: "لطفا دوباره ورود به سیستم را انجام دهید",
    icon: "error",
    button: "باشه",
});
<?php } ?>

<?php if (isset($verify['send']) && $verify['send'] == "true" ){ 
    ?>

swal({
    title: "ایمیل با موفقیت ارسال شد",
    icon: "success",
    button: "باشه",
});
<?php } ?>

<?php if (isset($verify['send']) && $verify['send'] == "false" ){ ?>
swal({
    title: "عملیات ارسال ایمیل شکست خورد",
    text: "میتواند بدلیل اشتباه بودن ایمیل باشد",
    icon: "error",
    button: "باشه",
});
<?php } ?>


<?php if (isset($verify['exp']) && $verify["exp"] == "true" ){ ?>
swal({
    title: "هنوز 2 دقیقه از ارسال قبلی نگذشته است",
    text: "لطفا هر 2 دقیقه یکبار اقدام کنید",
    icon: "error",
    button: "باشه",
});
<?php } ?>

<?php if (isset($verify['change-password']) && $verify["change-password"] == "true" ){ ?>
swal({
    title: "پسورد با موفقیت تغییر شد",
    icon: "success",
    button: "باشه",
});
<?php } ?>

<?php if (isset($verify['change-password']) && $verify["change-password"] == "false" ){ ?>
swal({
    title: "عملیات تغییر رمز شکست خورد",
    text: "لطفا پسورد فعلی را درست وارد کنید و حتما قدرت پسورد جدید شما آبی یا سبز باشد",
    icon: "error",
    button: "باشه",
});
<?php } ?>



</script>
