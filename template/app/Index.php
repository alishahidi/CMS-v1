<?php
require_once(BASE_PATH . "/template/app/layouts/header-tag.php");
?>
<!-- a -->
<section class="intro-h-600px">



    <!-- b -->
    <section class="intro-row intro-h-2-3 m mb-10x">

        <!-- b-1 -->
        <?php if (isset($articles[0])) {
            $datetimecreat = explode(" ", $articles[0]['created_at']);
            $datecreat = explode("-", $datetimecreat[0]);
            $timecreat = $datetimecreat[1];
        ?>
            <section class="intro-2-3-col intro-h-100 position-relative h-md-300px">
                <a href="<?= url("show/article/" . htmlentities($articles[0]['id']));
                            ?>">

                    <section class="img-bg bag-fix intro-h-100 w-100" style="background-image: url('<?= url(htmlentities($articles[0]['image'])) ?>')">
                    </section>
                    <section class="intro-item-caption about-bar">

                        <h3 class="caption-tittle">
                            <b>
                                <?php echo htmlentities($articles[0]['title']) ?>
                            </b>
                        </h3>
                        <ul class="caption-info-bar ">
                            <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($articles[0]['name']) ?></b></li>
                            <li>
                                <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                    <?php echo htmlentities($articles[0]['view']) ?> </span>
                            </li>
                            <li>
                                <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                    <?php echo htmlentities($articles[0]['comments_count']) ?> </span>
                            </li>
                        </ul>


                    </section>
                </a>
            </section>
        <?php } ?>
        <!-- b-1 -->


        <!-- b-2 -->

        <section class="intro-1-3-col intro-h-100 ">
            <?php if (isset($articles[1])) {
                $datetimecreat = explode(" ", $articles[1]['created_at']);
                $datecreat = explode("-", $datetimecreat[0]);
                $timecreat = $datetimecreat[1];
            ?>
                <section class="intro-1-3-item intro-h-50 position-relative h-md-300px">
                    <a href="<?= url("show/article/" . htmlentities($articles[1]['id']));
                                ?>">
                        <section class="img-bg bag-fix intro-h-100 " style="background-image: url('<?= url(htmlentities($articles[1]['image'])) ?>')">
                        </section>
                        <section class="intro-item-caption about-bar-2">
                            <h3 class="caption-tittle ">
                                <b>
                                    <?php echo htmlentities($articles[1]['title']) ?>
                                </b>
                            </h3>
                            <ul class="caption-info-bar ">
                                <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/"); ?></span>
                                    <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($articles[1]['name']) ?></b></li>

                            </ul>

                        </section>
                    </a>
                </section>
            <?php } ?>
            <!-- b-2 -->

            <!-- b-3-->
            <?php if (isset($articles[2])) {
                $datetimecreat = explode(" ", $articles[2]['created_at']);
                $datecreat = explode("-", $datetimecreat[0]);
                $timecreat = $datetimecreat[1];
            ?>
                <section class="intro-1-3-item intro-h-50 position-relative h-md-300px">
                    <a href="<?= url("show/article/" . htmlentities($articles[2]['id']));
                                ?>">

                        <section class="img-bg bag-fix bg-3 intro-h-100" style="background-image: url('<?= url(htmlentities($articles[2]['image'])) ?>')">
                        </section>
                        <section class="intro-item-caption about-bar-2">
                            <h3 class="caption-tittle ">
                                <b>
                                    <?php echo htmlentities($articles[2]['title']) ?>
                                </b>
                            </h3>
                            <ul class="caption-info-bar ">
                                <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/"); ?></span>
                                    <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($articles[2]['name']) ?></b></li>

                            </ul>

                        </section>
                    </a>
                </section>
            <?php } ?>
            <!-- b-3 -->

        </section>
        <section class="clear-fix"></section>
    </section>
    <!-- b -->


    <!-- c -->

    <section class="intro-row intro-h-1-3 ">

        <!-- c-1 -->
        <?php if (isset($articles[3])) {
            $datetimecreat = explode(" ", $articles[3]['created_at']);
            $datecreat = explode("-", $datetimecreat[0]);
            $timecreat = $datetimecreat[1];
        ?>
            <section class="intro-1-3-col-item intro-h-100 position-relative h-md-300px">
                <a href="<?= url("show/article/" . htmlentities($articles[3]['id']));
                            ?>">

                    <section class="img-bg bag-fix bg-4 intro-h-100 " style="background-image: url('<?= url(htmlentities($articles[3]['image'])) ?>')">
                    </section>
                    <section class="intro-item-caption about-bar-2">
                        <h3 class="caption-tittle ">
                            <b>
                                <?php echo htmlentities($articles[3]['title']) ?>
                            </b>
                        </h3>
                        <ul class="caption-info-bar ">
                            <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/"); ?></span>
                                <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($articles[3]['name']) ?></b></li>

                        </ul>

                    </section>
                </a>
            </section>
        <?php } ?>
        <!-- c-1 -->

        <!-- c-2 -->
        <?php if (isset($articles[4])) {
            $datetimecreat = explode(" ", $articles[4]['created_at']);
            $datecreat = explode("-", $datetimecreat[0]);
            $timecreat = $datetimecreat[1];
        ?>
            <section class="intro-1-3-col-item intro-h-100 position-relative h-md-300px">
                <a href="<?= url("show/article/" . htmlentities($articles[4]['id']));
                            ?>">

                    <section class="img-bg bag-fix bg-5 intro-h-100 " style="background-image: url('<?= url(htmlentities($articles[4]['image'])) ?>')">
                    </section>
                    <section class="intro-item-caption about-bar-2">
                        <h3 class="caption-tittle ">
                            <b>
                                <?php echo htmlentities($articles[4]['title']) ?>
                            </b>
                        </h3>
                        <ul class="caption-info-bar ">
                            <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/"); ?></span>
                                <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($articles[4]['name']) ?></b></li>

                        </ul>

                    </section>
                </a>
            </section>
        <?php } ?>
        <!-- c-2 -->

        <!-- c-3 -->
        <?php if (isset($articles[5])) {
            $datetimecreat = explode(" ", $articles[5]['created_at']);
            $datecreat = explode("-", $datetimecreat[0]);
            $timecreat = $datetimecreat[1];
        ?>
            <section class="intro-1-3-col-item intro-h-100 position-relative h-md-300px">
                <a href="<?= url("show/article/" . htmlentities($articles[5]['id']));
                            ?>">

                    <section class="img-bg bag-fix bg-6 intro-h-100 " style="background-image: url('<?= url(htmlentities($articles[5]['image'])) ?>')">
                    </section>
                    <section class="intro-item-caption about-bar-2">
                        <h3 class="caption-tittle ">
                            <b>
                                <?php echo htmlentities($articles[5]['title']) ?>
                            </b>
                        </h3>
                        <ul class="caption-info-bar ">
                            <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/"); ?></span>
                                <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($articles[5]['name']) ?></b></li>

                        </ul>

                    </section>
                </a>
            </section>
        <?php } ?>
        <!-- c-3 -->
        <section class=" clear-fix">
        </section>
        <section class=" clear-fix">
        </section>
    </section>
    <!-- c -->
    <section class=" clear-fix">
    </section>
</section>
<!-- a -->
<section class="conteiner">
    <main class="main">
        <section class="main-news">

            <section class="ads-part">
                <section class="ads-row">
                    <h2 class="tittle mbi">
                        تبلیغات
                    </h2>
                    <section class="ads-col">
                        <a href="<?php if (isset($adsTop[0])) {
                                        echo htmlentities($adsTop[0]['url']);
                                    } else {
                                        echo url("#");
                                    } ?>">
                            <section class="ads-main">
                                <img src="<?php if (isset($adsTop[0])) {
                                                echo htmlentities($adsTop[0]['image']);
                                            } else {
                                                echo url("public/images/Ads/ads-top.png");
                                            } ?>" alt="ads System" class="ads-img position-relative">
                                <section class="ads-by position-absolute">
                                    <section class="ads-info-icon">
                                        <span class="ads-font ads-system" id="ads">محتوای تبلیغ نه تایید و نه رد
                                            میشود!</span> <i class="ads-font ads-bullhorn fas fa-bullhorn"></i>
                                    </section>
                                </section>
                                <section class=" clear-fix">
                                </section>
                            </section>
                    </section>
                    </a>

                    <section class="ads-col">
                        <a href="<?php if (isset($adsTop[1])) {
                                        echo url(htmlentities($adsTop[1]['url']));
                                    } else {
                                        echo url("#");
                                    } ?>">
                            <section class="ads-main">
                                <img src="<?php if (isset($adsTop[1])) {
                                                echo url(htmlentities($adsTop[1]['image']));
                                            } else {
                                                echo url("public/images/Ads/ads-top.png");
                                            } ?>" alt="ads System" class="ads-img position-relative">
                                <section class="ads-by position-absolute">
                                    <section class="ads-info-icon">
                                        <span class="ads-font ads-system" id="ads">محتوای تبلیغ نه تایید و نه رد
                                            میشود!</span> <i class="ads-font ads-bullhorn fas fa-bullhorn"></i>
                                    </section>
                                </section>
                                <section class=" clear-fix">
                                </section>
                            </section>
                    </section>
                    </a>

                    <section class=" clear-fix">
                    </section>
                </section>
                <section class=" clear-fix">
                </section>
            </section>

            <article class="article-part">
                <section class=" article-row">
                    <section class=" article-w-50">
                        <h2 class="tittle mbi">
                            اطلاعیه
                        </h2>
                        <img class="main-news-img" src="images/recent-news-1-600x450.jpg" alt="#">
                        <section class="article-info">

                            <i class="fas fa-star important-news "></i>
                            <h3 class="article-tittle width-tittle-fix">
                                <a href="#">
                                    عملکرد بازار 2017:
                                    شگفت آور یا معمولی
                                </a>
                            </h3>
                            <ul class="info-bar ">
                                <li><span class="text-mute ">توسط</span> <b class="text-yellow ">علی شهیدی</b>
                                    <span class="text-mute ">Jan 25, 2018</span> </li>
                                <li>
                                    <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">30,190</span>
                                </li>
                                <li>
                                    <i class="far fa-comments text-yellow "></i> <span class="text-mute ">30</span>
                                </li>
                            </ul>
                            <p class="article-p">
                                اما من باید برای شما توضیح دهم که چگونه این ایده اشتباه در محرومیت از لذت و
                                ستایش درد به وجود آمده است ، یک گزارش کامل از سیستم ، و شرح آموزه های واقعی کاشف
                                بزرگ این کشور است.</p>
                        </section>
                        <section class=" clear-fix">
                        </section>
                    </section>
                    <div class="next-show-article"></div>
                    <section class=" article-w-50">
                        <section class="sidbar-item">
                            <h2 class="tittle mbi">
                                پست های پر گفتگو
                            </h2>

                            <?php foreach ($sidebarPopularArticles as $sidebarPopularArticle) {
                                $datetimecreat = explode(" ", $sidebarPopularArticle['created_at']);
                                $datecreat = explode("-", $datetimecreat[0]);
                                $timecreat = $datetimecreat[1];
                            ?>
                                <section class="recent-side-post">
                                    <a href="<?= url("/show/article/" . htmlentities($sidebarPopularArticle['id']))  ?>">
                                        <img src="<?= url(htmlentities($sidebarPopularArticle['image'])) ?>" alt="" class="recent-side-post-img">
                                    </a>
                                    <section class="recent-side-post-tittle">

                                        <h3>
                                            <a href="<?= url("show/article/". htmlentities($sidebarPopularArticle['id'])) ?> ">
                                                <b><?= htmlentities($sidebarPopularArticle['title']) ?></b>
                                            </a>
                                        </h3>
                                        <ul class="info-bar mb0">
                                            <li> <span class="text-black">در تاریخ</span> <span class="text-mute "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-black"> در ساعت </span> ' . '<span class="text-mute">' . $timecreat . '</span>'; ?></span>
                                                <span class="text-black">توسط</span> <b class="text-yellow "><?php echo htmlentities($sidebarPopularArticle['name']) ?></b>
                                            </li>
                                        </ul>
                                    </section>
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

                    <section class=" clear-fix">
                    </section>

                    <section class=" clear-fix">
                    </section>
                </section>

                <section class=" clear-fix">
                </section>
                <section class=" clear-fix">
                </section>
            </article>
        </section>
        <section class="main-crypto-mining-news">
            <h2 class="tittle">اخبار های پیشنهادی </h2>
            <section class="main-news-row">
                <?php if (isset($suggested[0])) {
                    $datetimecreat = explode(" ", $suggested[0]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                        <a href="<?= url("show/article/".htmlentities($suggested[0]['id'])) ?>">
                            <article>
                                <img class="main-news-img" src="<?= url(htmlentities($suggested[0]['image'])) ?>" alt="">
                                <h3 class="article-tittle width-tittle-fix">
                                    <a href="<?php url("show/article/". htmlentities($suggested[0]['id'])) ?>">
                                        <?php echo htmlentities($suggested[0]['title']) ?>
                                    </a>

                                </h3>
                                <ul class="info-bar ">
                                    <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                        <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($suggested[0]['name']) ?></b></li>
                                    <li>
                                        <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                            <?php echo htmlentities($suggested[0]['view']) ?> </span>
                                    </li>
                                    <li>
                                        <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                            <?php echo htmlentities($suggested[0]['comments_count']) ?> </span>
                                    </li>
                                </ul>
                            </article>
                        </a>
                        <section class=" clear-fix">
                        </section>
                    </section>
                <?php  } ?>
                <?php if (isset($suggested[1])) {
                    $datetimecreat = explode(" ", $suggested[1]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                        <a href="<?=  url("show/article/". htmlentities($suggested[1]['id'])) ?>">
                            <article>
                                <img class="main-news-img" src="<?= url(htmlentities($suggested[1]['image'])) ?>" alt="">
                                <h3 class="article-tittle width-tittle-fix">
                                    <a href="<?= url("show/article/". htmlentities($suggested[1]['id'])) ?>">
                                        <?php echo htmlentities($suggested[1]['title']) ?>
                                    </a>

                                </h3>
                                <ul class="info-bar ">
                                    <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                        <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($suggested[1]['name']) ?></b></li>
                                    <li>
                                        <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                            <?php echo htmlentities($suggested[1]['view']) ?> </span>
                                    </li>
                                    <li>
                                        <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                            <?php echo htmlentities($suggested[1]['comments_count']) ?> </span>
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
            <section class="main-news-row">
                <?php if (isset($suggested[2])) {
                    $datetimecreat = explode(" ", $suggested[2]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                        <a href="<?= url("show/article/".htmlentities($suggested[2]['id'])) ?>">
                            <article>
                                <img class="main-news-img" src="<?= url( htmlentities($suggested[2]['image'])) ?>" alt="">
                                <h3 class="article-tittle width-tittle-fix">
                                    <a href="<?= url("show/article/". htmlentities($suggested[2]['id'])) ?>">
                                        <?php echo htmlentities($suggested[2]['title']) ?>
                                    </a>

                                </h3>
                                <ul class="info-bar ">
                                    <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                        <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($suggested[2]['name']) ?></b></li>
                                    <li>
                                        <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                            <?php echo htmlentities($suggested[2]['view']) ?> </span>
                                    </li>
                                    <li>
                                        <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                            <?php echo htmlentities($suggested[2]['comments_count']) ?> </span>
                                    </li>
                                </ul>
                            </article>
                        </a>
                        <section class=" clear-fix">
                        </section>
                    </section>
                <?php  } ?>

                <?php if (isset($suggested[3])) {
                    $datetimecreat = explode(" ", $suggested[3]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                        <a href="<?= url("show/article/". htmlentities($suggested[3]['id'])) ?>">
                            <article>
                                <img class="main-news-img" src="<?= url(htmlentities($suggested[3]['image'])) ?>" alt="">
                                <h3 class="article-tittle width-tittle-fix">
                                    <a href="<?= url("show/article/".htmlentities($suggested[3]['id'])) ?>">
                                        <?php echo htmlentities($suggested[3]['title']) ?>
                                    </a>

                                </h3>
                                <ul class="info-bar ">
                                    <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                        <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($suggested[3]['name']) ?></b></li>
                                    <li>
                                        <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                            <?php echo htmlentities($suggested[3]['view']) ?> </span>
                                    </li>
                                    <li>
                                        <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                            <?php echo htmlentities($suggested[3]['comments_count']) ?> </span>
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
            <section class="main-news-row">
                <?php if (isset($suggested[4])) {
                    $datetimecreat = explode(" ", $suggested[4]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                        <a href="<?= url("show/article/".htmlentities($suggested[4]['id'])) ?>">
                            <article>
                                <img class="main-news-img" src="<?= url(htmlentities($suggested[4]['image'])) ?>" alt="">
                                <h3 class="article-tittle width-tittle-fix">
                                    <a href="<?php url("show/article/".htmlentities($suggested[4]['id'])) ?>">
                                        <?php echo htmlentities($suggested[4]['title']) ?>
                                    </a>

                                </h3>
                                <ul class="info-bar ">
                                    <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                        <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($suggested[4]['name']) ?></b></li>
                                    <li>
                                        <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                            <?php echo htmlentities($suggested[4]['view']) ?> </span>
                                    </li>
                                    <li>
                                        <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                            <?php echo htmlentities($suggested[4]['comments_count']) ?> </span>
                                    </li>
                                </ul>
                            </article>
                        </a>
                        <section class=" clear-fix">
                        </section>
                    </section>
                <?php  } ?>

                <?php if (isset($suggested[5])) {
                    $datetimecreat = explode(" ", $suggested[5]['created_at']);
                    $datecreat = explode("-", $datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                ?>
                    <section class="main-news-w-50">
                        <a href="<?php url("show/article/".htmlentities($suggested[5]['id'])) ?>">
                            <article>
                                <img class="main-news-img" src="<?= url(htmlentities($suggested[5]['image'])) ?>" alt="">
                                <h3 class="article-tittle width-tittle-fix">
                                    <a href="<?= url("show/article/".htmlentities($suggested[5]['id'])) ?>">
                                        <?php echo htmlentities($suggested[5]['title']) ?>
                                    </a>

                                </h3>
                                <ul class="info-bar ">
                                    <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                        <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($suggested[5]['name']) ?></b></li>
                                    <li>
                                        <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                            <?php echo htmlentities($suggested[5]['view']) ?> </span>
                                    </li>
                                    <li>
                                        <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                            <?php echo htmlentities($suggested[5]['comments_count']) ?> </span>
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
            <section class="article-w-100">
                <section class=" clear-fix">

                </section>
                <section class=" clear-fix">
                </section>
                <section class=" clear-fix">
                </section>
            </section>
        </section>
    </main>
    <?php
    require_once(BASE_PATH . "/template/app/layouts/sidebar.php");
    ?>
    <section class=" clear-fix">
    </section>
</section>
<section class=" clear-fix">
</section>
<?php
require_once(BASE_PATH . "/template/app/layouts/footer-tag.php");
?>