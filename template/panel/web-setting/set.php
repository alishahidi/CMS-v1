
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<head>
    <link rel="stylesheet" href="<?= asset("public/css/jquery.fileuploader.min.css")?>">
    <link rel="stylesheet" href="<?= asset("public/css/font.fileuploader.css")?>">

</head>
<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5"> ویرایش تنظیمات سایت</h1>
</section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url("web-setting/store")?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">عنوان</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="عنوان را وارد کنید"
                       required autofocus value="<?php
                if ($setting != null){
                    echo htmlentities($setting['title']);
                }
                ?>">
            </div>

            <div class="form-group">
                <label for="description"> توضیحات  </label>
                <textarea class="form-control" id="description" name="description" placeholder="توضیحات ..." rows="3"
                          autofocus required>
                    <?php
                    if ($setting != null){
                        echo htmlentities($setting['description']);
                    }
                    ?>
                </textarea>
            </div>

            <div class="form-group">
                <label for="keyword">کلمات کلیدی</label>
                <input class="form-control" id="keywords" name="keywords" placeholder="با فاصله از هم جدا کنید" 
                          autofocus value = "<?php
                if ($setting != null){
                    echo htmlentities($setting['keywords']);
                }
                ?>" required>
            </div>
            <?php
            if ($setting != null) {?>
                <section class="col-8">
                <img id="imagelogo" src = "<?= url(htmlentities($setting['logo']))

                ?>" alt = "loading" class="d-block article-image my-4" >

                 </section>
            <?}
            ?>

            <div class="form-group">
                <label for="logo">اپلود لوگو </label>
                <br>
                <section class="inputfile-box">
                    <input type="file" id="filelogo" name="logo" class="inputfile form-control-file" onchange='uploadFileLogo(this)'  accept="image/png, image/jpeg">
                    <label for="filelogo" class="uploade-input">
                        <span id="file-logo" class="file-box"> png و jpg فرمت های قابل قبول</span>
                        <span class="file-button btn btn-info">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                         انتخواب فایل
                        </span>
                    </label>
                    <section class=" clear-fix"></section>
                </section>
            </div>

            <?php
            if ($setting != null) {?>
            <section class="col-8">

                <img id="imageicon" src="<?= url(htmlentities($setting['icon']))

                ?>" alt="loading" class="d-block article-image my-4">
            </section>
            <?}
            ?>

            <div class="form-group">
                <label for="icon">اپلود ایکون </label>
                <br>
                <section class="inputfile-box">
                    <input type="file" id="fileicon" name="icon" class="inputfile form-control-file" onchange='uploadFileIcon(this)'  accept="image/png, image/jpeg">
                    <label for="fileicon" class="uploade-input">
                        <span id="file-icon" class="file-box"> png و jpg فرمت های قابل قبول</span>
                        <span class="file-button btn btn-info">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                         انتخواب فایل
                        </span>
                    </label>
                    <section class=" clear-fix"></section>
                </section>
            </div>

            <button type="submit" class="btn btn-info">ارسال</button>
        </form>
    </section>
</section>




<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
