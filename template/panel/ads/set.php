
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">ویرایش تبلیغ</h1>
</section>

<section class="row my-3">
    <section class="col-12">
        <form method="post" action="<?= url("ads/store/".$pos."/".$id)?>" enctype="multipart/form-data">
            <section class="col-8">
                <img id="image" src="<?= url(htmlentities($ad['image'])) ?>" alt="loading" class="d-block article-image my-4">
            </section>
            <div class="form-group">
                <label for="image">اپلود تصویر جدید</label>
                <br>
                <section class="inputfile-box">
                    <input type="file" name="image" id="file" class="inputfile form-control-file" onchange='uploadFile(this)'  accept="image/png, image/jpeg" >
                    <label for="file" class="uploade-input">
                        <span id="file-name" class="file-box"> png و jpg فرمت های قابل قبول</span>
                        <span class="file-button btn btn-info">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                         انتخواب فایل
                        </span>
                    </label>
                    <section class=" clear-fix"></section>
                </section>
            </div>

            <div class="form-group">
                <label for="title">آدرس تبلیغ</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="آدرس تبلیغ را وارد کنید"
                       required autofocus value="<?php if(isset($ad['url'])){
                           echo htmlentities($ad['url']);
                       } ?>">
            </div>


            <button type="submit" class="btn btn-secondary">ارسال</button>
        </form>
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-info btn-block mb-2">بازگشت</a>

    </section>

</section>




<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>

