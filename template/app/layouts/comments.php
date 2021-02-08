
<section class="comment send-comment app">
        <h2 class="tittle">
            ارسال نظر
        </h2>
        <form method="post" action="<?= url("comment/store/".htmlentities($article['id'])) ?>">
            <textarea name="comment" class="send-comment-text"  placeholder="متن نظر" ></textarea>
            <input class="btn-send-comment" type="submit" value="ارسال نظر">
        </form>

    </section>
    <h2 class="tittle">
    نظرات
</h2>
<?php
foreach ($comments as $comment) {
    $datetimecreat = explode(" ", $comment['date']);
    $datecreat = explode("-", $datetimecreat[0]);
    $timecreat = $datetimecreat[1];
?>
<section class="comment">
    <section class="comment-row">


        <section class="comment-img">
            <img src="<?= url(htmlentities($comment['image'])) ?>" alt=""
                class="comment-side-post-img">
        </section>
        <section class="comment-side-post-tittle">
            <section class="comment-row">
                <span
                    class="date-comment text-mute"><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") ?></span>
                <span class="date-comment text-mute"><?php echo $timecreat ?></span>
                <a href="#" class="comment-user-name">
                    <b><?php echo htmlentities($comment['name']) ?></b>
                </a>
            </section>
            <section class="comment-row">
                <p class="comment-p">
                    <?php echo htmlentities($comment['comment']) ?>
                </p>
            </section>
        </section>
    </section>
    <section class="clear-fix"></section>

</section>
<?php } ?>

</body>

</html>