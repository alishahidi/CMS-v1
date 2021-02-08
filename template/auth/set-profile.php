
<?php
require_once(BASE_PATH . "/template/auth/layouts/header-tag.php");
?>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-150 p-b-30">
                <form method="post" action="<?= url("register/profile/store")?>"
                class="login100-form validate-form" enctype="multipart/form-data">
					<span class="login100-form-title p-t-20 p-b-45">
تکمیل پروفایل کاربری				    </span>
            <section class="d-flex justify-content-center w-100">
                <img id="image" src="<?= url("public/images/Web-Setting/profile-avatar.jpg")?> "alt="" class="login-img rounded-circle d-block " height="200px" width="200px">
            </section>
            <div class="form-group w-100">
                <br>
                <section class="inputfile-box">
                    <input type="file" id="file" name="image" class="inputfile form-control-file" onchange='uploadFile(this)'  accept="image/png, image/jpeg" required>
                    <label for="file" class="uploade-input w-100">
                        <span id="file-name" class="file-box"> png و jpg فرمت های قابل قبول</span>
                        <span class="file-button btn btn-info">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                         انتخاب فایل
                        </span>
                    </label>
                    <section class=" clear-fix"></section>
                </section>
            </div>
            <div class="wrap-input100 validate-input m-b-10">
              <textarea name="bio" class="form-control set-textarea" placeholder="توضیحاتی در مورد خودتان وارد کنید"></textarea>
                </div>
					<div class="container-login100-form-btn p-t-10 ">
						<button class="login100-form-btn">
							ثبت
						</button>
					</div>

				</form>
                <div class=" w-full p-t-10 mr-2 w-100 text-center">
                    <a href="<?= url("login")?> class="txt1">
بعدا در پنل کاربری تکمیل میکنم                    </a>
                </div>
			</div>
		</div>
	</div>

<?php
require_once(BASE_PATH . "/template/auth/layouts/footer-tag.php");
?>






