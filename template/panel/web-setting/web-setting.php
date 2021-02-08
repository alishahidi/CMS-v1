
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>


<a href="<?= url("web-setting/set")?>" class="btn btn-success mt-3">ویرایش</a>
<table class="table table-bordered table-hover table-fix table-responsive">
    <thead>
        <tr>
            <th> عنوان </th>
            <th> توضیحات </th>
            <th> کلمات کلیدی </th>
            <th> لوگو </th>
            <th> ایکون </th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><?php echo  htmlentities($setting['id']) ?></td>
            <td><?php echo  htmlentities($setting['title']); ?></td>
            <td>
                <a type="button" class="text-info" data-toggle="modal" data-target="#summary<?php echo  htmlentities($setting['id']); ?>">
                    بازدید
                </a>
                <div class="modal fade" id="summary<?php echo  htmlentities($setting['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">توضیحات پست</h5>
                            </div>
                            <div class="modal-body">
                                <?php echo  htmlentities($setting['description']) ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info btn-block" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>

            <td>
                <a type="button" class="text-info" data-toggle="modal" data-target="#body<?php echo $setting['id']; ?>">
                    بازدید
                </a>
                <div class="modal fade" id="body<?php echo  htmlentities($setting['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">لوگو</h5>
                            </div>
                            <div class="modal-body">
                                <img src="<?= url(htmlentities($setting['logo']))?>" alt="" class="d-block article-image-100">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info btn-block" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>


            </td>


            <td>
                <a type="button" class="text-info" data-toggle="modal" data-target="#image<?php echo  htmlentities($setting['id']); ?>">
                    بازدید
                </a>
                <div class="modal fade" id="image<?php  echo htmlentities($setting['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                ایکون سایت</h5>
                            </div>
                            <div class="modal-body">
                                <img src="<?= url(htmlentities($setting['icon'])) ?>" alt="" class="d-block article-image-100">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info btn-block" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
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









