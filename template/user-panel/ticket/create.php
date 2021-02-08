
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">تشکیل درخواست</h1>
</section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("user/ticket/store")?>">
            <div class="form-group">
                <label for="title">عنوان</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="عنوان را وارد کنید"
                       required autofocus>
            </div>
            <div class="form-group">
                <label for="summary"> توضیحات درخواست </label>
                <textarea class="form-control" id="summary" name="summary" placeholder="توضیحات ..." rows="3" required
                          autofocus></textarea>
            </div>
            <button type="submit" class="btn btn-info">ارسال</button>
        </form>
    </section>
</section>

<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
