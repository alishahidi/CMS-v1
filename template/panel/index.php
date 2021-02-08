<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>


<div class="row mt-3">



    <div class="col-md-6 col-lg-3">

        <a class="card-link text-white" href="<?= url("category")?> ">
            <div class="card text-white bg-gradiant-green-blue mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-clipboard-list"></i> دسته بندی ها</span> <span class="badge badge-pill right"><?php echo htmlentities($categoryCount['COUNT(*)']) ?></span></div>
                <div class="card-body">
                    لطفا برای ورود به بخش دسته بندی ها کلیک کنید
                </div>
            </div>
        </a>

    </div>

    <div class="col-md-6 col-lg-3">
        <a class="card-link text-white" href="<?= url("user")?> ">
            <div class="card text-white bg-juicy-orange mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-users"></i> کاربران</span> <span class="badge badge-pill right"><?php echo htmlentities($userAllCount['COUNT(*)']) ?></span></div>
                <div class="card-body">
                    <section class=" font-12 row p-2">
                        <section class="col-md-6">
                            <span class=""><i class="fas fa-user"></i> کاربر <span class="badge badge-pill mx-1"><?php echo $userCount['COUNT(*)']; ?></span></span>
                        </section>
                        <section class="col-md-6">
                            <span class=""><svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-gem" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785l-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004l.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495l5.062-.005L8 13.366 5.47 5.495zm-1.371-.999l-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l2.92-.003 2.193 6.82L1.5 5.5zm7.889 6.817l2.194-6.828 2.929-.003-5.123 6.831z" />
                                </svg> مالک <span class="badge badge-pill mx-1"><?php echo $userOwnerCount['COUNT(*)']; ?></span></span>
                        </section>


                    </section>
                    <section class=" font-12 row p-2">
                        <section class="col-md-6">
                            <span class=""><i class="fas fa-users-cog"></i> ادمین <span class="badge badge-pill mx-1"><?php echo $userAdminCount['COUNT(*)']; ?></span></span>
                        </section>
                        <section class="col-md-6">
                            <span class=""><i class="fa fa-user-plus" aria-hidden="true"></i> ساب ادمین <span class="badge badge-pill mx-1"><?php echo $userSubAdminCount['COUNT(*)']; ?></span></span>
                        </section>


                    </section>
                    <section class=" font-12 row p-2">
                        <section class="col-md-6">
                            <span class=""><i class="fa fa-user-times" aria-hidden="true"></i> مسدود <span class="badge badge-pill mx-1"><?php echo $userBanCount['COUNT(*)']; ?></span></span>
                        </section>

                    </section>
                </div>
            </div>
        </a>

    </div>

    <div class="col-md-6 col-lg-3">
        <a class="card-link text-white" href="<?= url("article")?> ">
            <div class="card text-white bg-dracula mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-newspaper"></i> پست ها</span> <span class="badge badge-pill right"><?php echo htmlentities($articleCount['COUNT(*)']) ?></span></div>
                <div class="card-body">

                    <span class=""><i class="fa fa-eye" aria-hidden="true"></i> بازدید کل <span class="badge badge-pill mx-1"><?php echo $articlesViews['SUM(view)']; ?></span></span>
                </div>
            </div>
        </a>
    </div>


    <div class="col-md-6 col-lg-3">
        <a class="card-link text-white" href="<?= url("comment")?>">
            <div class="card text-white bg-neon-life mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-comments"></i>نظرات</span> <span class="badge badge-pill right"><?php echo htmlentities($commentCount['COUNT(*)']) ?></span></div>
                <div class="card-body">
                    <section class="d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class="far fa-eye-slash"></i> دیده نشده <span class="badge badge-pill mx-1"><?php echo htmlentities($commentUnseenCount['COUNT(*)']) ?></span></span>
                        <span class=""><i class="far fa-eye"></i> دیده شده <span class="badge badge-pill mx-1"><?php echo htmlentities($commentSeenCount['COUNT(*)']) ?></span></span>
                    </section>
                    <section class="d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class="far fa-check-circle"></i> تایید شده <span class="badge badge-pill mx-1"><?php echo htmlentities($commentApprovedCount['COUNT(*)']) ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>




</div>
<div class="row mt-2">
    <div class="col-md-4">
        <h2 class="h6 pb-0 mb-0">
            پست های پر بازدید
        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>شناسه دیتابیس</th>
                        <th>متن پست</th>
                        <th>تعداد بازدید</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articleWitchView as $article) { ?>
                        <tr>
                            <td><a class="text-primary" href="<?= url("show/article/".htmlentities($article['id'])) ?>"><?php echo htmlentities($article['id']) ?> </a></td>
                            <td><a class="text-dark " href="<?= url("show/article/".htmlentities($article['id'])) ?>"><?php echo htmlentities($article['title']) ?> </a></td>
                            <td><span class="badge badge-secondary"><?php echo htmlentities($article['view']) ?></span></td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <h2 class="h6 pb-0 mb-0">
            پست های پر گفتگو
        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>شناسه دیتابیس</th>
                        <th>متن پست</th>
                        <th>تعداد نظر</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articlesComments as $article) { ?>
                        <tr>
                            <td><a class="text-primary" href="<?= url("show/article/".htmlentities($article['id'])) ?>"><?php echo htmlentities($article['id']) ?> </a></td>
                            <td><a class="text-dark" href="<?= url("show/article/".htmlentities($article['id'])) ?>"><?php echo htmlentities($article['title']) ?> </a></td>
                            <td><span class="badge badge-success"><?php echo htmlentities($article['comment_count']) ?></span></td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <h2 class="h6 pb-0 mb-0">
            جدید ترین نظرات
        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>شناسه دیتابیس</th>
                        <th>نام کاربری</th>
                        <th>متن نظر</th>
                        <th>وضعیت نظر</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($lastComments as $comment) { ?>
                        <tr>
                            <td><?php echo htmlentities($comment['id']) ?></td>
                            <td><a class="text-primary" href="<?= url("show/user/".htmlentities($comment['id'])) ?>"><?php echo htmlentities($comment['username']) ?> </a></td>
                            <td><?php echo htmlentities($comment['comment']) ?></td>

                            <td><span class="badge badge-<?php if ($comment['status'] == "unseen") {
                                                                echo "danger";
                                                            } elseif ($comment['status'] == "seen") {
                                                                echo "info";
                                                            } elseif ($comment['status'] == "approved") {
                                                                echo "success";
                                                            } ?>"><?php echo htmlentities($comment['status']) ?></span></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</main>

</div>

</div>

<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>