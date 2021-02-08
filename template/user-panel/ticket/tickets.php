
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<div class="text-dark mt-3">
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>










