
<head>
    <style>
        .waves-input-wrapper{
            display: block;
        }

    </style>
</head>
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<a href="<?= url("register")?>" class="btn btn-success mt-3">جدید</a>
<table class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>شناسه دیتابیس</th>
                <th>نام</th>
                <th>نام کاربری</th>
                <th>ایمیل</th>
                <th>پسورد</th>
                <th>نقش</th>
                <th>تاریخ ساخت</th>
                <th>تاریخ اپدیت</th>
                <th>مدیریت کاربر</th>
                <th>ویرایش کابر</th>
                <th>حذف کاربر</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach($users as $user){ 
                $datetimecreat = explode(" ",$user['created_at']);
                $datecreat = explode("-",$datetimecreat[0]);
                $timecreat = $datetimecreat[1];
                ?>
            <tr>
                <td><?php echo htmlentities($user['id']) ?></td>
                <td><?php echo htmlentities($user['name']) ?></td>
                <td><?php echo htmlentities($user['username']) ?></td>
                <td><?php echo htmlentities($user['email']) ?></td>
                <td><?php echo htmlentities($user['password']) ?></td>
                <td><?php echo htmlentities($user['permission']) ?></td>
                <td><?php echo gregorian_to_jalali($datecreat[0],$datecreat[1],$datecreat[2],"/")."  ".$timecreat; ?></td>
                <td><?php
                if($user['updated_at'] == NULL){
                 echo "<p class='text-info'>هنوز اپدیت صورت نگرفته است</p>";
                }else{
                    $datetimeupdate = explode(" ",$user['updated_at']);
                    $dateupdate = explode("-",$datetimeupdate[0]);
                    $timeupdate = $datetimeupdate[1];
                    echo gregorian_to_jalali($dateupdate[0],$dateupdate[1],$dateupdate[2],"/")."  ".$timeupdate;
                }
                
                
            
            ?>
            </td>
                <td>

                     <a type="button" class="btn btn-info  btn-sm" data-toggle="modal" data-target="#permission<?php echo htmlentities($user['id'])?>">
                       مدیریت نقش
                     </a>
                    <div class="modal fade" id="permission<?php echo htmlentities($user['id'])?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">نقش را انتخواب کنید</h5>

                                </div>
                                <div class="modal-body">
                                    <form method="post" action="<?= url("user/permission/".htmlentities($user['id']))?>">
                                        <input type="submit" class="btn <?php
                                        if ($user['permission'] == "user"){
                                            echo "btn-outline-warning disabled";
                                        }
                                        else{
                                            echo "btn-warning";
                                        }
                                        ?> btn-block my-2" name="user" value="کاربر">
                                    </form>
                                    <form method="post" action="<?= url("user/permission/".htmlentities($user['id']))?>">
                                        <input type="submit" class="btn <?php
                                        if ($user['permission'] == "ban"){
                                            echo "btn-outline-danger disabled";
                                        }
                                        else{
                                            echo "btn-danger";
                                        }
                                        ?> btn-block my-2" name="ban" value="مسدود">
                                    </form>
                                    <form method="post" action="<?= url("user/permission/".htmlentities($user['id']))?>">
                                        <input type="submit" class="btn <?php
                                        if ($user['permission'] == "admin"){
                                            echo "btn-outline-success disabled";
                                        }
                                        else{
                                            echo "btn-success";
                                        }
                                        ?> btn-block my-2" name="admin" value="ادمین">
                                    </form>
                                    <form method="post" action="<?= url("user/permission/".htmlentities($user['id']))?>">
                                        <input type="submit" class="btn <?php
                                        if ($user['permission'] == "subadmin"){
                                            echo "btn-outline-primary disabled";
                                        }
                                        else{
                                            echo "btn-primary";
                                        }
                                        ?> btn-block my-2" name="subadmin" value="ساب ادمین">
                                    </form>
                                    <form method="post" action="<?= url("user/permission/".htmlentities($user['id']))?>">
                                        <input type="submit" class="btn <?php
                                        if ($user['permission'] == "owner"){
                                            echo "btn-outline-secondary disabled";
                                        }
                                        else{
                                            echo "btn-secondary";
                                        }
                                        ?> btn-block my-2" name="owner" value="مالک">
                                    </form>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info btn-block" data-dismiss="modal">بستن</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <a role="button" class="btn btn-sm btn-success text-white"
                        href="<?= url("user/edit/".htmlentities($user['id'])) ?>">ویرایش</a>
                </td>
                <td>
                    <a role="button" class="btn btn-sm btn-danger  my-1  text-white"
                        href="<?= url("user/delete/".htmlentities($user['id'])) ?>">حذف</a>
                </td>



            </tr>
            <? } ?>
        </tbody>
    </table>

<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
