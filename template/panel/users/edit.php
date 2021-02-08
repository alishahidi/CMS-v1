
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">ویرایش کاربر</h1>
</section>

<section class="row my-3">
    <section class="col-12">
        <form method="post" id="form" action="<?= url("user/update/".htmlentities($id)) ?>" class="validate-form">
            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" class="form-control input" id="name" name="name" placeholder="مقدار را وارد کنید"
                       value="<?php echo htmlentities($user['name'])?>" >
                <label for="name">نام کاربری</label>
                <input type="text" class="form-control input" id="username" name="username" placeholder="مقدار را وارد کنید"
                       value="<?php echo htmlentities($user['username'])?>" >
                <label for="name">ایمیل</label>
                <input type="text" class="form-control input" id="email" name="email" placeholder="مقدار را وارد کنید"
                       value="<?php echo htmlentities($user['email'])?>" >
                <label for="name">پسورد</label>
                <input type="password" class="form-control input" id="password" name="password" placeholder="مقدار را وارد کنید"
                       value="<?php echo htmlentities($user['password'])?>" >
                <label for="name">نقش</label>
                <strong class="badge badge-pill badge-info d-block py-2">لطفا نقش را در پنل مربوطه ویرایش کنید</strong>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
        </form>
    </section>
</section>

<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
