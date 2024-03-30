<?php
session_start();
ob_start();
if (isset($_SESSION['user'])) {
    header('Location: /views/client/index.php');
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PETMART &ndash; Đăng ký tài khoản</title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/client/images/favicon.png" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="../../assets/client/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="../../assets/client/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="../../assets/client/css/style.css">
    <link rel="stylesheet" href="../../assets/client/css/responsive.css">
</head>

<body class="page-template belle">
    <div class="pageWrapper">
        <!--End Search Form Drawer-->
        <!--Top Header-->
        <?php include './common/top-header.php'; ?>
        <!--End Top Header-->
        <!--Header-->
        <?php include './common/header-2.php'; ?>
        <!--End Header-->
        <!--Mobile Menu-->
        <?php include './common/mobile.menu.php'; ?>
        <!--End Mobile Menu-->

        <!--Body Content-->
        <div id="page-content">
            <!--Page Title-->
            <div class="page section-header text-center">
                <div class="page-title">
                    <div class="wrapper">
                        <h1 class="page-width">Đăng ký tài khoản</h1>
                    </div>
                </div>
            </div>
            <!--End Page Title-->

            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                        <div class="mb-4">
                            <form method="post" action="index.php?page=register" id="CustomerLoginForm"
                                accept-charset="UTF-8" class="contact-form">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <span class="text-danger">
                                            <?php
                                            if (isset($_SESSION['error'])) {
                                                echo $_SESSION['error'];
                                                unset($_SESSION['error']);
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="FirstName">Họ và tên</label>
                                            <input type="text" name="full_name" placeholder="" id="FirstName" required
                                                autofocus="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="CustomerEmail">Email</label>
                                            <input type="email" name="email" placeholder="" id="CustomerEmail" class=""
                                                required autocorrect="off" autocapitalize="off" autofocus="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="CustomerPassword">Mật khẩu</label>
                                            <input type="password" value="" name="password" placeholder="" required
                                                id="CustomerPassword" class="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName">Nhập lại mật khẩu</label>
                                            <input type="password" name="confirm-password" placeholder="" id="LastName"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                        <input type="submit" class="btn mb-3" value="Đăng ký" name="register">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Body Content-->

        <!--Footer-->
        <?php include './common/footer.php'; ?>
        <!--End Footer-->
        <!--Scoll Top-->
        <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
        <!--End Scoll Top-->

        <!-- Including Jquery -->
        <script src="../../assets/client/js/vendor/jquery-3.3.1.min.js"></script>
        <script src="../../assets/client/js/vendor/jquery.cookie.js"></script>
        <script src="../../assets/client/js/vendor/modernizr-3.6.0.min.js"></script>
        <script src="../../assets/client/js/vendor/wow.min.js"></script>
        <!-- Including Javascript -->
        <script src="../../assets/client/js/bootstrap.min.js"></script>
        <script src="../../assets/client/js/plugins.js"></script>
        <script src="../../assets/client/js/popper.min.js"></script>
        <script src="../../assets/client/js/lazysizes.js"></script>
        <script src="../../assets/client/js/main.js"></script>
    </div>
</body>


</html>