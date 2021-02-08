
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">تشکیل پست</h1>
</section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("article/store")?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">عنوان</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="عنوان را وارد کنید"
                       required autofocus>
            </div>

            <div class="form-group">
                <label for="cat_id">نام دسته بندی</label>
                <select name="category_id" id="category_id" class="form-control" required autofocus>
                    <?php
                    foreach ($categories as $category){?>
                        <option value="<?php echo  htmlentities($category['id'])?>"> <?php echo  htmlentities($category['name'])?></option>
                    <?}
                    ?>


                </select>
            </div>
            <section class="col-8">
                <img id="image" src="" alt="" class="">
            </section>
            <div class="form-group">
                <label for="image">اپلود تصویر </label>
                <br>
                <section class="inputfile-box">
                    <input type="file" id="file" name="image" class="inputfile form-control-file" onchange='uploadFile(this)'  accept="image/png, image/jpeg" required>
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
                <label for="summary"> توضیحات پست </label>
                <textarea class="form-control" id="summary" name="summary" placeholder="توضیحات ..." rows="3" required
                          autofocus></textarea>
            </div>

            <div class="form-group">
                <label for="body">متن پست</label>
                <textarea class="editor" id="editor" name="body" placeholder="متن ...." rows="5" required
                          autofocus></textarea>
            </div>

            <button type="submit" class="btn btn-info">ارسال</button>
        </form>
    </section>
</section>




<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>

