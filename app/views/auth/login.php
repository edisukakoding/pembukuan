<?php include('app/views/includes/header.php'); ?>
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left p-5">
                    <div class="brand-logo"  style="text-align: center!important;">
                        <img src="<?= BASE_URL ?>assets/images/logo.png" alt="LOGO" />
                    </div>
                    <?php Helper::flash_message('flash'); ?>
                    <form class="pt-3" action="<?= BASE_URL ?>auth/proses_login" method="POST">
                        <div class="form-group">
                            <label for="username" class="text-gray">Username</label>
                            <input type="text"
                                   class="form-control form-control-lg"
                                   id="username"
                                   name="username"
                                   placeholder="Username"
                            />
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-gray">Password</label>
                            <input type="password"
                                   class="form-control form-control-lg"
                                   id="password"
                                   name="password"
                                   placeholder="Password"
                            />
                        </div>
                        <div class="mt-3">
                            <button type="submit"
                                class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                SIGN IN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->
<?php include('app/views/includes/scripts.php')?>