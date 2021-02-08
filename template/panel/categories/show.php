
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
$datetimecreat = explode(" ",$category['created_at']);
$datecreat = explode("-",$datetimecreat[0]);
$timecreat = $datetimecreat[1];
?>


<table class="table table-hover table-fix table-responsive">
    <thead>
        <tr>
            <th>شناسه دیتابیس</th>
            <th>نام دسته بندی</th>
            <th>تاریخ ساخت</th>
            <th>تاریخ بروزرسانی</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo  htmlentities($category['id']); ?></td>
            <td><?php echo  htmlentities($category['name']); ?></td>
            <td><?php
             echo gregorian_to_jalali($datecreat[0],$datecreat[1],$datecreat[2],"/")."  ".$timecreat; ?></td>
            <td><?php
             if($category['updated_at'] == NULL){
                echo "<p class='text-info'>هنوز اپدیت صورت نگرفته است</p>";
            }else{
                $datetimeupdate = explode(" ",$category['updated_at']);
                $dateupdate = explode("-",$datetimeupdate[0]);
                $timeupdate = $datetimeupdate[1];
                echo gregorian_to_jalali($dateupdate[0],$dateupdate[1],$dateupdate[2],"/")."  ".$timeupdate;
            }
             ?></td>

        </tr>
    </tbody>
</table>
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-info btn-block">بازگشت</a>


<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
