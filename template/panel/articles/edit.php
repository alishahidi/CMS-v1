
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">ویرایش پست</h1>
</section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("article/update/".$article['id'])?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">عنوان</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="عنوان را وارد کنید" value="<?php echo  htmlentities($article['title']) ?>"
                       required autofocus>
            </div>

            <div class="form-group">
                <label for="category_id">نام دسته بندی</label>
                <select name="category_id" id="category_id" class="form-control" required autofocus>
                    <?php
                    foreach ($categories as $category){?>
                        <option value="<?php echo  htmlentities($category['id'])?>" <?php
                        if ($article['category_id'] == $category['id']){
                            echo "selected";
                        }
                        ?>> <?php echo  htmlentities($category['name'])?></option>
                    <?}
                    ?>


                </select>
            </div>
            <section class="col-8">
                <img id="image" src="<?= url(htmlentities($article['image'])) ?>" alt="loading" class="d-block article-image my-4">
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
                <label for="summary"> توضیحات پست </label>
                <textarea class="form-control" id="summary" name="summary" placeholder="توضیحات ..." rows="3" required
                          autofocus><?php echo  htmlentities($article['summary']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="body">متن پست</label>
                <textarea id="editor" name="body" placeholder="متن ...." rows="5" required
                          autofocus><?php echo  htmlentities($article['body']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-secondary">ارسال</button>
        </form>
        <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-info btn-block mb-2">بازگشت</a>

    </section>

</section>




<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>

