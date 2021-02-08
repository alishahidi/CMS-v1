
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>


<section class="pt-3 pb-1 mb-2 border-bottom">
        <h1 class="h5">دسته بندی جدید</h1>
</section>

<section class="row my-3">
    <section class="col-12">
        <form method="post" id="form" action="<?= url("category/store")?>" class="validate-form">
            <div class="form-group">
                <label for="name">عنوان</label>
                <input type="text" class="form-control input" id="name" name="name" placeholder="مقدار را وارد کنید"
                 data-validate="لطفا مقدار را وارد کنید" >
              
                <strong id="valid"></strong>
                <!--            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
            </div>
            <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
        </form>
    </section>
</section>

<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>

