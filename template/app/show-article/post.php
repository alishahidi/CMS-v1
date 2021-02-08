<?php
require_once(BASE_PATH . "/template/app/layouts/header-tag.php");

$datetimecreat = explode(" ", $article['created_at']);
$datecreat = explode("-", $datetimecreat[0]);
$timecreat = $datetimecreat[1];
?>
<section class="main">
    <section class=" article-w-100">
        <img class="article-post-img" src="<?= url(htmlentities($article['image'])) ?>" alt="#">
        <section class="article-info">

            <i class="fas fa-star important-news "></i>
            <h3 class="article-tittle">
                <?php echo htmlentities($article['title']) ?>
            </h3>
            <ul class="info-bar ">
            <li> <span class="text-mute">در تاریخ</span> <span
                                class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                            <span class="text-mute ">توسط</span> <b
                                class="text-yellow"><?php echo htmlentities($name['name']) ?></b></li>
                        <li>
                            <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                <?php echo htmlentities($article['view']) ?> </span>
                        </li>
                        <li>
                            <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                <?php echo htmlentities($commentsCount[0]['COUNT(*)']) ?> </span>
                        </li>
            </ul>
            <h3 class="article-tittle">
                خلاصه پست
            </h3>
            <p class="article-p">
            <?php echo htmlentities($article['summary']) ?>
            </p>
            <h3 class="article-tittle">
                متن پست
            </h3>
            <div">
            <?php echo $article['body'] ?>
            </div>
        </section>
        <section class=" clear-fix">
        </section>
    </section>
    <section class=" clear-fix">
    </section>
    <section class="related-post">
        <h2 class="tittle">
            پست های مرتبط
        </h2>
        <?php if (isset($relatedArticle[0])) { ?>
            <section class="main-news-row">
                <?php if (isset($relatedArticle[0])) {
                    $datetimecreat = explode(" ", $relatedArticle[0]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                    <a href="<?= url("show/article/".htmlentities($relatedArticle[0]['id'])) ?>">
                        <article>
                            <img class="main-news-img" src="<?= url(htmlentities($relatedArticle[0]['image'])) ?>" alt="">
                            <h3 class="article-tittle width-tittle-fix">
                            <a href="<?= url("show/article/".htmlentities($relatedArticle[0]['id'])) ?>">
                                    <?php echo htmlentities($relatedArticle[0]['title']) ?>
                                </a>

                            </h3>
                            <ul class="info-bar ">
                                <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                    <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($relatedArticle[0]['name']) ?></b></li>
                                <li>
                                    <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                        <?php echo htmlentities($relatedArticle[0]['view']) ?> </span>
                                </li>
                                <li>
                                    <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                        <?php echo htmlentities($relatedArticle[0]['comments_count']) ?> </span>
                                </li>
                            </ul>
                        </article>
                    </a>
                        <section class=" clear-fix">
                        </section>
                    </section>
                <?php  } ?>
                <?php if (isset($relatedArticle[1])) {
                    $datetimecreat = explode(" ", $relatedArticle[1]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                    <a href="<?= url("show/article/".htmlentities($relatedArticle[1]['id'])) ?>">
                        <article>
                            <img class="main-news-img" src="<?= url(htmlentities($relatedArticle[1]['image'])) ?>" alt="">
                            <h3 class="article-tittle width-tittle-fix">
                            <a href="<?= url("show/article/".htmlentities($relatedArticle[1]['id'])) ?>">
                                    <?php echo htmlentities($relatedArticle[1]['title']) ?>
                                </a>

                            </h3>
                            <ul class="info-bar ">
                                <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                    <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($relatedArticle[1]['name']) ?></b></li>
                                <li>
                                    <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                        <?php echo htmlentities($relatedArticle[1]['view']) ?> </span>
                                </li>
                                <li>
                                    <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                        <?php echo htmlentities($relatedArticle[1]['comments_count']) ?> </span>
                                </li>
                            </ul>
                        </article>
                    </a>
                        <section class=" clear-fix">
                        </section>
                    </section>
                <?php  } ?>
                <section class=" clear-fix">
                </section>
            </section>
        <?php }
        if (isset($relatedArticle[2])) { ?>

            <section class="main-news-row">
                <?php if (isset($relatedArticle[2])) {
                    $datetimecreat = explode(" ", $relatedArticle[2]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                    <a href="<?= url("show/article/".htmlentities($relatedArticle[2]['id'])) ?>">
                        <article>
                            <img class="main-news-img" src="<?= url(htmlentities($relatedArticle[2]['image'])) ?>" alt="">
                            <h3 class="article-tittle width-tittle-fix">
                            <a href="<?= url("show/article/".htmlentities($relatedArticle[2]['id'])) ?>">
                                    <?php echo htmlentities($relatedArticle[2]['title']) ?>
                                </a>

                            </h3>
                            <ul class="info-bar ">
                                <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                    <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($relatedArticle[2]['name']) ?></b></li>
                                <li>
                                    <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                        <?php echo htmlentities($relatedArticle[2]['view']) ?> </span>
                                </li>
                                <li>
                                    <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                        <?php echo htmlentities($relatedArticle[2]['comments_count']) ?> </span>
                                </li>
                            </ul>
                        </article>
                    </a>
                        <section class=" clear-fix">
                        </section>
                    </section>
                <?php  } ?>

                <?php if (isset($relatedArticle[3])) {
                    $datetimecreat = explode(" ", $relatedArticle[3]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                    <a href="<?= url("show/article/".htmlentities($relatedArticle[3]['id'])) ?>">
                        <article>
                            <img class="main-news-img" src="<?= url(htmlentities($relatedArticle[3]['image'])) ?>" alt="">
                            <h3 class="article-tittle width-tittle-fix">
                            <a href="<?= url("show/article/".htmlentities($relatedArticle[3]['id'])) ?>">
                                    <?php echo htmlentities($relatedArticle[3]['title']) ?>
                                </a>

                            </h3>
                            <ul class="info-bar ">
                                <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                    <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($relatedArticle[3]['name']) ?></b></li>
                                <li>
                                    <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                        <?php echo htmlentities($relatedArticle[3]['view']) ?> </span>
                                </li>
                                <li>
                                    <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                        <?php echo htmlentities($relatedArticle[3]['comments_count']) ?> </span>
                                </li>
                            </ul>
                        </article>
                    </a>
                        <section class=" clear-fix">
                        </section>
                    </section>
                <?php  } ?>
                <section class=" clear-fix">
                </section>
            </section>
        <?php } ?>
        <section class=" clear-fix">
        </section>
    </section>
    <section class=" clear-fix">
    </section>
</section>

<?php
require_once(BASE_PATH . "/template/app/layouts/sidebar.php");
require_once(BASE_PATH . "/template/app/layouts/comments.php");
?>
</section>
<?php
require_once(BASE_PATH . "/template/app/layouts/footer-tag.php");
?>