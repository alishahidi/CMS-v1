
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<h4 class="my-3">
    تبیلغات اول سایت
</h4>
<section class="row mt-3">
<section class="col-md-6">
<div class="img-ads">
    <img src="<?php if(isset($ad1Top['image'])){
        echo url($ad1Top['image']);
    } ?>" class="w-100" height="320px"  alt="">
</div>
<div class="ads-edit">
    <a href="<?= url("ads/set/top/1")?>" class="btn btn-info btn-block">ویرایش تبلیغ</a>
</div>
<div class="ads-delete">
    <a href="<?= url("ads/delete/top/1")?>" class="btn btn-danger btn-block">حذف تبلیغ</a>
</div>
</section>
<section class="col-md-6">
<div class="img-ads">
    <img src="<?php if(isset($ad2Top['image'])){
        echo url($ad2Top['image']);
    } ?>" class="w-100" height="320px"  alt="">
</div>
<div class="ads-edit">
    <a href="<?= url("ads/set/top/2")?>" class="btn btn-info btn-block">ویرایش تبلیغ</a>
</div>
<div class="ads-delete">
    <a href="<?= url("ads/delete/top/2")?>" class="btn btn-danger btn-block">حذف تبلیغ</a>
</div>
</section>
</section>
<h4 class="my-3">
    تبلیغات بخش سایدبار
</h4>
<section class="row mt-4">
    <section class="col-md-4">
    <div class="img-ads">
    <img src="<?php if(isset($ad1Sidebar['image'])){
        echo url($ad1Sidebar['image']);
    } ?>" class="w-100" height="320px"  alt="">
</div>
<div class="ads-edit">
    <a href="<?= url("ads/set/sidebar/1")?>" class="btn btn-info btn-block">ویرایش تبلیغ</a>
</div>
<div class="ads-delete">
    <a href="<?= url("ads/delete/sidebar/1")?>" class="btn btn-danger btn-block">حذف تبلیغ</a>
</div>
    </section>
    <section class="col-md-4">
    <div class="img-ads">
    <img src="<?php if(isset($ad2Sidebar['image'])){
        echo url($ad2Sidebar['image']);
    } ?>" class="w-100" height="320px"  alt="">
</div>
<div class="ads-edit">
    <a href="<?= url("ads/set/sidebar/2")?>" class="btn btn-info btn-block">ویرایش تبلیغ</a>
</div>
<div class="ads-delete">
    <a href="<?= url("ads/delete/sidebar/2")?>" class="btn btn-danger btn-block">حذف تبلیغ</a>
</div>
    </section>
    <section class="col-md-4">
    <div class="img-ads">
    <img src="<?php if(isset($ad3Sidebar['image'])){
        echo url($ad3Sidebar['image']);
    } ?>" class="w-100" height="320px"  alt="">
</div>
<div class="ads-edit">
    <a href="<?= url("ads/set/sidebar/3")?>" class="btn btn-info btn-block">ویرایش تبلیغ</a>
</div>
<div class="ads-delete">
    <a href="<?= url("ads/delete/sidebar/3")?>" class="btn btn-danger btn-block">حذف تبلیغ</a>
</div>
    </section>
</section>

<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>








