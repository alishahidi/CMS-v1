
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">بازدید از درخواست</h1>
</section>

<section class="row my-3">
    <section class="col-12">
            <div class="form-group">
                <label for="title">عنوان</label>
                <p>سلام</p>
            </div>
            <div class="form-group">
                <label for="summary"> توضیحات درخواست </label>
                <textarea class="form-control" placeholder="توضیحات ..." rows="3" readonly
                          >شششششششش</textarea>
            </div>
    </section>
</section>


<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-info btn-block mb-2">بازگشت</a>


<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
