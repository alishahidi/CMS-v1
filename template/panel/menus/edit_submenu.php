
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>


<section class="pt-3 pb-1 mb-2 border-bottom">
        <h1 class="h5"> ویرایش منو </h1>
</section>

<section class="row my-3">
    <section class="col-12">
        <form method="post" action="<?= url("menu/update/".$id) ?>">
            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="مقدار جدید را وارد کنید" value="<?php echo  htmlentities($menu['name']) ?>">
                <label for="url">آدرس</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="مقدار جدید را وارد کنید" value="<?php echo  htmlentities($menu['url']) ?>">
            </div>
            <div class="form-group">
                <label for="parent_id">نام زیر دسته جدید</label>
                <select name="parent_id" id="parent_id" class="form-control" autofocus>
                <?php
                foreach($menus->fetchAll() as $parent){?>
                    <option value="<?php echo $parent['id']?>" <?php if($menu['parent_id'] == $parent['id']){
                        echo "selected";
                        
                    } ?>><?php  echo htmlentities($parent['name']) ?></option>

                <?}?>
                
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
        </form>
    </section>
</section>


<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
