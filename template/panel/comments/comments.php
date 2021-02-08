<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>
<div class="text-dark mt-3 pb-1 border-bottom">
    <h5 class="">کامنت های ارسال شده</h5>
</div>
<?php foreach($comments as $comment){
    $datetimecreat = explode(" ",$comment['created_at']);
    $datecreat = explode("-",$datetimecreat[0]);
    $timecreat = $datetimecreat[1];
?>
<section class=" my-3 border-bottom">
    <section class="comment p-3 ">
        <section class="comment-side-post-tittle">
            <section class="row">
                <div class="col-md-6">
                    <div class="d-inline-block">
                        <h6>ارسال شده در پست</h6>
                    </div>
                    <div class="d-inline-block">
                    <a href="<?= url("show/article/".htmlentities($comment['articleId']))?>">
                            <?php echo htmlentities($comment['title']) ?>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-inline-block">
                        <h6>ارسال شده توسط</h6>
                    </div>
                    <div class="d-inline-block">
                        <a href="<?= url("show/user/".htmlentities($comment['userId']))?>">
                            <?php echo htmlentities($comment['name']) ?>
                        </a>
                    </div>
                    <div class="d-inline-block">
                        <h6>با نام کاربری</h6>
                    </div>
                    <div class="d-inline-block">
                        <a href="<?= url("show/user/".htmlentities($comment['userId']))?>">
                            <?php echo htmlentities($comment['username']) ?>
                        </a>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="col-md-6">
                    <div class="d-inline-block">
                        <h6>ارسال شده در تاریخ</h6>
                    </div>
                    <div class="d-inline-block">
                        <small
                            class="my-1"><?php echo gregorian_to_jalali($datecreat[0],$datecreat[1],$datecreat[2],"/") ?></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-inline-block">
                        <h6>ارسال شده در ساعت</h6>
                    </div>
                    <div class="d-inline-block">
                        <small
                            class="my-1"><?php echo $timecreat ?></small>
                    </div>
                </div>
            </section>
            <section class="row mr-2">
                <h6 class="mt-3">متن نظر:</h6>
            </section>
            <section class="row mr-2">
            <p class="comment-p text-secondary" >
                <?php echo htmlentities($comment['comment'])?>
            </p>
            </section>
        </section>
        <section class="row mr-2">
            <section class="col-md-6">
                <?php if($comment['status'] == "approved"){ ?>
                    <button id="approved<?php echo htmlentities($comment['id']) ?>"  class="btn btn-outline-success" id="approved" 
                     onclick="approved(<?php echo htmlentities($comment['id']) ?>)" >حذف از حالت تایید شده</button>
                <?php }else{ ?>
                    <button class="btn btn-success" id="approved<?php echo htmlentities($comment['id']) ?>" 
                     onclick="approved(<?php echo htmlentities($comment['id']) ?>)">تایید کردن نظر </button>
                <?php } ?>
            </section>
        </section>

    </section>

</section>

<?php } ?>
<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>