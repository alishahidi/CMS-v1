
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>


<a href="<?= url("article/create")?>" class="btn btn-success mt-3">جدید</a>
<table class="table table-bordered table-hover table-fix table-responsive">
    <thead>
        <tr>
            <th>شناسه دیتابیس</th>
            <th> عنوان </th>
            <th> توضیحات </th>
            <th> متن پست </th>
            <th> عکس </th>
            <th> تاریخ ساخت </th>
            <th> تاریخ اپدیت </th>
            <th>مدیریت پست</th>
            <th>ویرایش</th>
            <th>حذف</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach($articles as $article){
            $datetimecreat = explode(" ",$article['created_at']);
            $datecreat = explode("-",$datetimecreat[0]);
            $timecreat = $datetimecreat[1];
            
            
            ?>
        <tr>
            <td><a href="<?= url("article/show/".htmlentities($article['id'])) ?>"
                    class=" text-primary"><?php echo  htmlentities($article['id']) ?></a></td>
            <td><?php echo  htmlentities($article['title']); ?></td>



            <td>
                <a type="button" class="text-info" data-toggle="modal" data-target="#summary<?php echo  htmlentities($article['id']); ?>">
                    بازدید
                </a>
                <div class="modal fade" id="summary<?php echo  htmlentities($article['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">توضیحات پست</h5>
                            </div>
                            <div class="modal-body">
                                <?php echo  htmlentities($article['summary']) ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info btn-block" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>






            <td>
                <a type="button" class="text-info" data-toggle="modal" data-target="#body<?php echo $article['id']; ?>">
                    بازدید
                </a>
                <div class="modal fade" id="body<?php echo  htmlentities($article['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">متن پست</h5>
                            </div>
                            <div class="modal-body">
                         <textarea class="textarea-fix" readonly>
                             <?php echo htmlentities($article['body']);?>
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
                <a type="button" class="text-info" data-toggle="modal" data-target="#image<?php echo  htmlentities($article['id']); ?>">
                    بازدید
                </a>
                <div class="modal fade" id="image<?php  echo htmlentities($article['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"> عکس پست</h5>
                            </div>
                            <div class="modal-body">
                                <img src="<?= url(htmlentities($article['image'])) ?>" alt="" class="d-block article-image-100 mr-2">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info btn-block" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>

            <td><?php echo gregorian_to_jalali($datecreat[0],$datecreat[1],$datecreat[2],"/")."  ".$timecreat; ?></td>
            <td><?php
             if($article['updated_at'] == NULL){
                echo "<p class='text-info'>هنوز اپدیت صورت نگرفته است</p>";
            }else{
                $datetimeupdate = explode(" ",$article['updated_at']);
                $dateupdate = explode("-",$datetimeupdate[0]);
                $timeupdate = $datetimeupdate[1];
                echo gregorian_to_jalali($dateupdate[0],$dateupdate[1],$dateupdate[2],"/")."  ".$timeupdate;
            }
            
            
            ?>
            </td>
            <td>
                <a type="button" class="btn btn-info  btn-sm" data-toggle="modal" data-target="#permission<?php echo htmlentities($article['id'])?>">
                    مدیریت پست
                </a>
                <div class="modal fade" id="permission<?php echo htmlentities($article['id'])?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">انتخواب کنید</h5>

                            </div>
                            <div class="modal-body">
                                    <a href="<?= url("article/suggested/".htmlentities($article['id'])) ?>" type="submit" class="btn <?php
                                    if ($article['suggested'] == "on"){
                                        echo "btn-outline-success";
                                    }
                                    else{
                                        echo "btn-success";
                                    }
                                    ?> btn-block my-2" ><?php
                                        if ($article['suggested'] == "on"){
                                            echo "حذف از پست پیشنهادی";
                                        }
                                        else{
                                            echo "تبدیل به پست پیشنهادی";
                                        }
                                    ?>

                                        </a>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info btn-block" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td><a href="<?= url("article/edit/".htmlentities($article['id'])) ?>"
                    class="btn btn-success btn-sm text-dark">ویرایش</a>
            </td>
            <td><a
                    href="<?= url("article/delete/".htmlentities($article['id']))?>"
                    class=" mr-2 btn btn-danger btn-sm text-dark" onclick="return confirm('آیا حذف انجام شود');">حذف</a>
            </td>
        </tr>
        <?php } ?>



    </tbody>
</table>

<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>

<script>
    <?php if ($verify['suggested'] ==  "full"){ ?>
    swal({
        title: "حداکثر فقط میتوان ۶ پست را بعنوان پست پیشنهادی انتخواب کرد",
        text: "لطفا ابتدا یک مورد از پست های پیشنهادی کم کنید سپس این پست را به عنوان پست پیشنهادی قرار دهید",
        icon: "error",
        button: "باشه",
    });
    <?}?>
</script>









