
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>


<a href="<?= url("category/create")?>" class="btn btn-success mt-3">جدید</a>
<table class="table table-hover table-fix table-responsive">
    <thead>
        <tr>
            <th>شناسه دیتابیس</th>
            <th>نام دسته بندی</th>
            <th>تاریخ ساخت</th>
            <th>تاریخ آپدیت</th>
            <th>مدیریت</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach($categories as $category){
            $datetimecreat = explode(" ",$category['created_at']);
            $datecreat = explode("-",$datetimecreat[0]);
            $timecreat = $datetimecreat[1];
            
            
            ?>
        <tr>
            <td><a href="<?= url("category/show/".htmlentities($category['id'])) ?>"
                    class=" text-primary"><?php echo  htmlentities($category['id']) ?></a></td>
            <td><?php echo  htmlentities($category['name']) ?></td>
            <td><?php echo gregorian_to_jalali($datecreat[0],$datecreat[1],$datecreat[2],"/")."  ".$timecreat; ?></td>
            <td><?php
             if($category['updated_at'] == NULL){
                echo "<p class='text-info'>هنوز اپدیت صورت نگرفته است</p>";
            }else{
                $datetimeupdate = explode(" ",$category['updated_at']);
                $dateupdate = explode("-",$datetimeupdate[0]);
                $timeupdate = $datetimeupdate[1];
                echo gregorian_to_jalali($dateupdate[0],$dateupdate[1],$dateupdate[2],"/")."  ".$timeupdate;
            }
            
            
            ?>
            </td>
            <td><a href="<?= url("category/edit/".htmlentities($category['id'])) ?>"
                    class="btn btn-success btn-sm text-dark">ویرایش</a><a
                    href="<?= url("category/delete/".htmlentities($category['id'])) ?>"
                    class=" mr-2 btn btn-danger btn-sm text-dark" onclick="return confirm('آیا حذف انجام شود');">حذف</a>
            </td>
        </tr>
        <?php } ?>



    </tbody>
</table>



<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
