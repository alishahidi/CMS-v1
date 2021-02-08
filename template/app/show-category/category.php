<?php
require_once(BASE_PATH . "/template/app/layouts/header-tag.php");
?>
        <main class="main">
            <section class="main-crypto-mining-news">
                <h2 class="tittle">
                    اخبار <?php echo htmlentities($category['name']) ?>
                 </h2>
                 <?php foreach($articles as $articel){
                     $datetimecreat = explode(" ", $articel['created_at']);
                     $datecreat = explode("-", $datetimecreat[0]);
                     $timecreat = $datetimecreat[1];
                     ?>
                    <section class="main-news-w-50">
                        <a href="<?= url("show/article/".htmlentities($articel['id'])) ?>">
                            <article>
                                <img class="main-news-img" src="<?= url(htmlentities($articel['image'])) ?>" alt="">
                                <h3 class="article-tittle width-tittle-fix">
                                    <a href="<?= url("show/article/".htmlentities($articel['id'])) ?>">
                                        <?php echo htmlentities($articel['title']) ?>
                                    </a>

                                </h3>
                                <ul class="info-bar ">
                                    <li> <span class="text-mute">در تاریخ</span> <span class="text-yellow "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-mute"> در ساعت </span> ' . '<span class="text-yellow">' . $timecreat . '</span>'; ?></span>
                                        <span class="text-mute ">توسط</span> <b class="text-yellow"><?php echo htmlentities($articel['name']) ?></b></li>
                                    <li>
                                        <i class="fas fa-bolt text-yellow"></i><span class=" text-mute ">
                                            <?php echo htmlentities($articel['view']) ?> </span>
                                    </li>
                                    <li>
                                        <i class="far fa-comments text-yellow "></i> <span class="text-mute ">
                                            <?php echo htmlentities($articel['comments_count']) ?> </span>
                                    </li>
                                </ul>
                            </article>
                        </a>
                        <section class=" clear-fix">
                        </section>
                    </section>
                 <?php } ?>
                    

                    <section class=" clear-fix">
                        </section>
                <section class="article-w-100">
                    <a href="#" class="article-more">
                        <b>دیدن اخبار بیشتر</b>
                    </a>
                    <section class=" clear-fix">

                    </section>
                    <section class=" clear-fix">
                    </section>
                    <section class=" clear-fix">
                    </section>
                </section>
        </main>
        <?php
require_once(BASE_PATH . "/template/app/layouts/sidebar.php");
require_once(BASE_PATH . "/template/app/layouts/footer-tag.php");
        ?>
