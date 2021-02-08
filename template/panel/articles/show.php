
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");

$datatimecreat = explode(" ",$article['created_at']);
$datacreat = explode("-",$datatimecreat[0]);
$timecreat = $datatimecreat[1];

$colorclass = null;
$statustext = null;
if ($article['status'] == "off") {
    $colorclass = "text-danger";
    $statustext = "غیر فعال";
} else {
    $colorclass = "text-success";
    $statustext = "فعال";
}

?>
<section class="row">
    <section class="col-8">


        <section class="d-block">
            <h2 class="article-header border-r">نام </h2>
            <h2 class="d-block article-title mr-2"><?php echo htmlentities($article['title']) ?></h2>
        </section>


        <section class="d-block">
        <h2 class="article-header border-r">عکس </h2>
        <img src="<?= url(htmlentities($article['image'])) ?>" alt="loading" class="d-block article-image mr-2">
        </section>

        <section class="d-block">
            <h2 class="article-header border-r">توضیحات </h2>
            <textarea class="d-block summary mr-2 textarea-fix txta" readonly><?php echo htmlentities($article['summary']) ?></textarea>
        </section>


        <section class="d-block " >
            <h2 class="article-header border-r">متن </h2>


            <textarea class="d-block textarea-fix txta" readonly>
                <?php echo htmlentities($article['body']) ?>
            </textarea>

        </section>


        <section class="d-block">
            <h2 class="article-header border-r">نام دسته بندی </h2>
            <p class="d-block article-cat mr-2"><?php echo htmlentities($category['name']) ?></p>
        </section>


        <section class="d-block">
            <h2 class="article-header border-r">ارسال کننده</h2>
            <p class="d-block article-user mr-2">  <?php echo htmlentities("( ".$user['name']." )")?>  با نام کاربری <?php echo htmlentities("( ".$user['username']." )") ?>  </p>
        </section>



        <section class="d-block">
            <h2 class="article-header border-r">وضعیت</h2>
            <p class="d-block article-status mr-2
            <?php echo $colorclass;?>"><?php echo $statustext;?></p>
        </section>


        <section class="d-block">
            <h2 class="article-header border-r">تاریخ ساخت</h2>
            <p class="d-block article-date mr-2"><?php echo gregorian_to_jalali($datacreat[0],$datacreat[1],$datacreat[2],"/")." ".$timecreat;  ?></p>
        </section>

        <section class="d-block">
            <h2 class="article-header border-r">تاریخ بروزرسانی</h2>
            <p class="d-block article-date mr-2"><?php
                if($article['updated_at'] == NULL){
                    echo "<p class='text-info'>هنوز اپدیت صورت نگرفته است</p>";
                }else{
                    $datetimeupdate = explode(" ",$article['updated_at']);
                    $dateupdate = explode("-",$datetimeupdate[0]);
                    $timeupdate = $datetimeupdate[1];
                    echo htmlentities(gregorian_to_jalali($dateupdate[0],$dateupdate[1],$dateupdate[2],"/")."  ".$timeupdate);
                }


                ?></p>
        </section>

    </section>
</section>


<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-info btn-block mb-2">بازگشت</a>

<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>
