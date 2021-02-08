
<?php
require_once(BASE_PATH . "/template/user-panel/layouts/header-tag.php");
?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">ویرایش حساب کاربری</h1>
</section>

<section class="row my-3">
    <section class="col-12">
        <form method="post" action="<?= url("user/profile/update")?>" enctype="multipart/form-data">
        <section class="col-8">
                <img id="image" src="<?= url(htmlentities($user['image'])) ?>" alt="loading" class="d-block article-image my-4">
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
                <label for="title">ویرایش نام</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="نام را وارد کنید" value="<?= htmlentities($user['name']) ?>"
                       required autofocus>
            </div>
            <div class="form-group">
                <label for="title">ویرایش موبایل</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="موبایل را وارد کنید" required autofocus value="<?= htmlentities($user['phone']) ?>">
            </div>
            <div class="form-group">
                <label for="title">ویرایش بیوگرافی</label>
                <textarea class="form-control" id="bio" name="bio" placeholder="بیوگرافی را وارد کنید"
                          required autofocus>
                          <?= htmlentities($user['bio']) ?>
                </textarea>
            </div>
            <button type="submit" class="btn btn-info">ارسال</button>
        </form>
    </section>
</section>



<?php
require_once(BASE_PATH . "/template/user-panel/layouts/footer-tag.php");
?>
