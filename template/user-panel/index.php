
<?php
require_once(BASE_PATH . "/template/user-panel/layouts/header-tag.php");
?>
<div class="text-dark mt-3 pb-1 border-bottom">
    <h5 class="">اطلاعات حساب شما</h5>
</div>
<div class="row">
<div class="user-information ml-4 mt-4 mb-4 p-4 col-10">
    <div class="row mb-3">
        <div class="col-md-6">
            <span class="text-dark"> نام حساب: </span><span class="text-muted"><?php echo htmlentities($user['name'])?></span>
        </div>
        <div class="col-md-6">
            <span class="text-dark"> نام کاربری: </span><span class="text-muted"><?php echo htmlentities($user['username'])?></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <span class="text-dark"> ایمیل: </span><span class="text-muted"><?php echo htmlentities($user['email'])?></span>
        </div>
        <div class="col-md-6">
            <span class="text-dark"> موبایل: </span><span class="text-muted"><?php
                if ($user['phone'] == null){
                    echo "ندارد";
                }
                else{
                    echo htmlentities($user['phone']);
                }
                ?></span>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <?php
            if ($user['verify'] == "active"){?>
                <span class="text-dark">وضعیت:</span><span class="badge badge-pill badge-success mr-2">فعال</span>
            <?}
            else{?>
                <span class="text-dark">وضعیت:</span><span class="badge badge-pill badge-danger mr-2">غیر فعال</span>
            <?}
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            <span class="text-dark "> بیوگرافی:   </span><br>
            <textarea class="form-control p-2 mt-2" placeholder="توضیحی قرار داده نشده است" rows="3" readonly>
<?php if($user['bio'] == null){
    echo "ندارد";
}
else{
    echo htmlentities($user['bio']);
}?>
            </textarea>
        </div>
    </div>

</div>
</div>

<div class="text-dark mt-3 pb-1 border-bottom">
    <h5 class="">پیام های پشتیبانی</h5>
</div>
<table class="table table-bordered table-hover table-fix table-responsive mt-3">
    <thead>
    <tr>
        <th>شناسه</th>
        <th> عنوان </th>
        <th> توضیحات </th>
        <th> وضعیت </th>
        <th> تاریخ ساخت </th>
        <th>مدیریت</th>
    </tr>
    </thead>
    <tbody>

        <tr>
            <td><a href=""
                   class=" text-primary">۱</a>
            </td>
            <td>
                بسته شدن اکانت
            </td>

            <td>
                <a type="button" class="text-info" data-toggle="modal" data-target="#body">
                    بازدید
                </a>
                <div class="modal fade" id="body" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">متن پیام</h5>
                            </div>
                            <div class="modal-body">
                         <textarea class="textarea-fix" readonly>

                         </textarea>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info btn-block" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <span class="badge badge-pill badge-success">فعال</span>
            </td>
            <td>#</td>
            <td><a href="/article/edit/"
                   class="btn btn-success btn-sm text-dark">ویرایش</a><a
                        href="/article/delete/"
                        class=" mr-2 btn btn-danger btn-sm text-dark" onclick="return confirm('آیا حذف انجام شود');">حذف</a>
            </td>
        </tr>

    </tbody>
</table>
<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>

