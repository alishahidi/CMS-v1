
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>


<section class="pt-3 pb-1 mb-2 border-bottom">
        <h1 class="h5"> ویرایش منو </h1>
</section>

<section class="row my-3">
    <section class="col-12">
        <form method="post" action="<?= url("menu/update/".htmlentities($menu['id'])); ?>">
            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="مقدار جدید را وارد کنید" value="<?php echo  htmlentities($menu['name']) ?>">
  
            </div>
            <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
        </form>
    </section>
</section>



<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
