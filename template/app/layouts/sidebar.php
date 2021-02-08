<aside class="sidebar">
    <section class="sidebar-item">
        <h2 class="tittle">
            دسته بندی ها
        </h2>
        <ul class="sidebar-list">
            <?php foreach ($categories as $category) { ?>
                <li><a href="<?= url("show/category/" . htmlentities($category['id'])) ?>" class="hover-black"><?php echo htmlentities($category['name']) ?></a></li>
            <?php } ?>
        </ul>
    </section>
    <section class="sidbar-item">
        <h2 class="tittle mbi">
            تبلیغات
        </h2>
        <a href="<?php if (isset($adsSidebar[0])) {
                        echo htmlentities($adsSidebar[0]['url']);
                    } else {
                        echo "#";
                    } ?>">
            <section class="ads-sidebar">

                <img src="<?php if (isset($adsSidebar[0])) {
                              echo  url(htmlentities($adsSidebar[0]['image']));
                            } else {
                                echo url("public/images/Ads/ads-sidebar.png");
                            } ?>" alt="ads System" class="ads-img position-relative">
                <section class="ads-by position-absolute">
                    <section class="ads-info-icon">
                        <span class="ads-font ads-system" id="ads">محتوای تبلیغ نه تایید و نه رد میشود!</span> <i class="ads-font ads-bullhorn fas fa-bullhorn"></i>
                    </section>
                </section>
                <section class=" clear-fix">
                </section>
            </section>
        </a>

        <a href="<?php if (isset($adsSidebar[1])) {
                        echo htmlentities($adsSidebar[1]['url']);
                    } else {
                        echo "#";
                    } ?>">
            <section class="ads-sidebar">

                <img src="<?php if (isset($adsSidebar[1])) {
                               echo url(htmlentities($adsSidebar[1]['image']));
                            } else {
                                echo url("public/images/Ads/ads-sidebar.png");
                            } ?>" alt="ads System" class="ads-img position-relative">
                <section class="ads-by position-absolute">
                    <section class="ads-info-icon">
                        <span class="ads-font ads-system" id="ads">محتوای تبلیغ نه تایید و نه رد میشود!</span> <i class="ads-font ads-bullhorn fas fa-bullhorn"></i>
                    </section>
                </section>
                <section class=" clear-fix">
                </section>
            </section>
        </a>

        <a href="<?php if (isset($adsSidebar[2])) {
                      echo url(htmlentities($adsSidebar[2]['url']));
                    } else {
                        echo url("#") ;
                    } ?>">
            <section class="ads-sidebar">

                <img src="<?php if (isset($adsSidebar[2])) {
                                                                       echo url(htmlentities($adsSidebar[2]['image']));
                                                                    } else {
                                                                        echo url("public/images/Ads/ads-sidebar.png");
                                                                    } ?>" alt="ads System" class="ads-img position-relative">
                <section class="ads-by position-absolute">
                    <section class="ads-info-icon">
                        <span class="ads-font ads-system" id="ads">محتوای تبلیغ نه تایید و نه رد میشود!</span> <i class="ads-font ads-bullhorn fas fa-bullhorn"></i>
                    </section>
                </section>
                <section class=" clear-fix">
                </section>
            </section>
        </a>

    </section>
    <section class="sidebar-item">
        <h2 class="tittle">
            قیمت آنلاین
        </h2>
        <div id="tgju-data"></div>
        <script>
            var tgju_params = {
                type: "simple",
                items: ["mesghal", "sekeb", "bourse", "price_dollar_rl", "price_eur"],
                columns: ["diff", "time"],
                placeholder: "tgju-data",
                token: "webservice"
            };
        </script>
        <script src="https://api.tgju.online/v1/widget"></script>
    </section>


    <section class="sidbar-item">
        <h2 class="tittle mbi">
            پست های محبوب
        </h2>

        <?php foreach ($sidebarPopularArticles as $sidebarPopularArticle) {
            $datetimecreat = explode(" ", $sidebarPopularArticle['created_at']);
            $datecreat = explode("-", $datetimecreat[0]);
            $timecreat = $datetimecreat[1];
        ?>
            <section class="popular-post">
                <section class="popular-post-tittle">
                    <h3>
                        <a href="<?= url("show/article/".htmlentities($sidebarPopularArticle['id'])) ?>">
                            <b><?php echo htmlentities($sidebarPopularArticle['title']) ?></b>
                        </a>
                    </h3>
                    <ul class="info-bar mb0">
                        <li> <span class="text-black">در تاریخ</span> <span class="text-mute "><?php echo gregorian_to_jalali($datecreat[0], $datecreat[1], $datecreat[2], "/") . ' <span class="text-black"> در ساعت </span> ' . '<span class="text-mute">' . $timecreat . '</span>'; ?></span> <span class="text-black">توسط</span> <b class="text-yellow "><?php echo htmlentities($sidebarPopularArticle['name']) ?></b></li>
                    </ul>
                </section>
                <a href="<?= url("show/article/".htmlentities($sidebarPopularArticle['id'])) ?>">
                    <img src="<?= url(htmlentities($sidebarPopularArticle['image'])) ?>" alt="" class="popular-post-img">
                </a>
                <section class=" clear-fix">
                </section>
            </section>
        <?php } ?>

    </section>
    <section class="sidebar-item">
        <section class="subscribe-part">
            <h2 class="tittle mbi">
                خبرنامه
            </h2>
            <P class="subscribe-p">
                برای دریافت اطلاعیه در مورد به روزرسانی های جدید ، اطلاعات ، تخفیف و غیره در خبرنامه ما مشترک شوید.
            </P>
            <form class="subscribe-form">
                <input type="text" class="subscribe-form-text" placeholder="ایمیل شما">
                <button type="button"><i class="far fa-send"></i></button>
            </form>
            <section class=" clear-fix">
            </section>
        </section>
        <section class=" clear-fix">
        </section>
    </section>

</aside>
<section class=" clear-fix">
</section>