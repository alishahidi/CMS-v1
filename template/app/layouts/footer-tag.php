
</section>
<footer class="footer">
    <section class="app">
        <section class=" bg-map">
        <section class="footer-row">
            <section class="footer-col">
                <img src="images/logo-white.png" alt="" class="footer-logo">
                <section class=" clear-fix">
                </section>
                <p class="footer-p">
                   <?php echo htmlentities($setting['description'])?>
                </p>
                <smal></smal>

                <section class=" clear-fix">
                </section>
            </section>
            <section class="footer-col">
                <h3 class="footer-section-tittle">
                    پرپازدید هایی از <?php echo htmlentities($categoryId['name'])?>
                     </h3>
                <?php if (isset($articleFromCategoryIdOrderViewRand[0])){
                    $datetimecreat = explode(" ",$articleFromCategoryIdOrderViewRand[0]['created_at']);
                    $datecreat = explode("-",$datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                    ?>
                <section class="footer-section-link-item">
                    <a href="<?= url("show/article/".htmlentities($articleFromCategoryIdOrderViewRand[0]['id']))?>">
                        <?php echo htmlentities($articleFromCategoryIdOrderViewRand[0]['title'])?>
                    </a>
                    <h6><?php echo gregorian_to_jalali($datecreat[0],$datecreat[1],$datecreat[2],"/");?></h6>
                </section>
                <?php } ?>
                <section class="footer-line"></section>

                <?php if (isset($articleFromCategoryIdOrderViewRand[1])){
                    $datetimecreat = explode(" ",$articleFromCategoryIdOrderViewRand[1]['created_at']);
                    $datecreat = explode("-",$datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                    ?>
                    <section class="footer-section-link-item">
                        <a href="<?= url("show/article/".htmlentities($articleFromCategoryIdOrderViewRand[1]['id']))?>">
                            <?php echo htmlentities($articleFromCategoryIdOrderViewRand[1]['title'])?>
                        </a>
                        <h6><?php echo gregorian_to_jalali($datecreat[0],$datecreat[1],$datecreat[1],"/");?></h6>
                    </section>
                <?php } ?>
            </section>


            <section class="footer-col">
                <h3 class="footer-section-tittle">
                    پر گفتگوی هایی از <?php echo htmlentities($categoryId2['name'])?>
                </h3>
                <?php if (isset($articleFromCategoryIdOrderCommentRand[0])){
                    $datetimecreat = explode(" ",$articleFromCategoryIdOrderCommentRand[0]['created_at']);
                    $datecreat = explode("-",$datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                    ?>
                    <section class="footer-section-link-item">
                        <a href="<?= url("show/article/".htmlentities($articleFromCategoryIdOrderCommentRand[0]['id']))?>">
                            <?php echo htmlentities($articleFromCategoryIdOrderCommentRand[0]['title'])?>
                        </a>
                        <h6><?php echo gregorian_to_jalali($datecreat[0],$datecreat[1],$datecreat[2],"/");?></h6>
                    </section>
                <?php } ?>
                <section class="footer-line"></section>

                <?php if (isset($articleFromCategoryIdOrderCommentRand[1])){
                    $datetimecreat = explode(" ",$articleFromCategoryIdOrderCommentRand[1]['created_at']);
                    $datecreat = explode("-",$datetimecreat[0]);
                    $timecreat = $datetimecreat[1];
                    ?>
                    <section class="footer-section-link-item">
                        <a href="<?= url("show/article/".htmlentities($articleFromCategoryIdOrderCommentRand[1]['id']))?>">
                            <?php echo htmlentities($articleFromCategoryIdOrderCommentRand[1]['title'])?>
                        </a>
                        <h6><?php echo gregorian_to_jalali($datecreat[0],$datecreat[1],$datecreat[1],"/");?></h6>
                    </section>
                <?php } ?>
            </section>
            </section>
            <section class=" clear-fix">
            </section>
        </section>
        </section>
        <section class="footer-bac">
            <section class="footer-line"></section>
        </section>
        <section ></section>
        <section class="footer-row">
            <ul class="footer-menu">
                <li><a href="#">شرایط و ضوابط</a></li>
                <li><a href="#">حفظ حریم خصوصی</a></li>
                <li><a href="#">تبلیغات شغلی</a></li>
                <li><a href="#">تماس با ما</a></li>
            </ul>

            <ul class="footer-social-network">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                <li><a href="#"><i class="fab fa-bitcoin"></i></a></li>
            </ul>
            <section class=" clear-fix">
            </section>
            <section class=" clear-fix">
            </section>
        </section>
        <section class=" clear-fix">
        </section>
    </section>
    <section class=" clear-fix">
    </section>
</footer>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?= asset("public/ckeditor-app/ckeditor.js") ?> "></script>
<script src="<?= asset("public/ckeditor-app/adapters/jquery.js")?> "></script>
<script src="<?= asset("public/ckeditor-app/translations/fa.js")?> "></script>
<script src="<?= asset("public/js/app/main.js")?> "></script>
<script src="<?= asset("public/js/util/swal.min.js")?> "></script>
</html>