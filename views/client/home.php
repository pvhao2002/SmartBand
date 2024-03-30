<?php
$page = $_GET['page'] ?? 'OK';
if ($page === 'cart') {
    $classBody = 'page-template';
} else {
    $classBody = $page !== 'product' ? 'template-index template-index-belle' : 'template-product';
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Smart band</title>
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

<body class="<?php echo $classBody; ?> belle">
    <div class="pageWrapper">
        <?php include './common/top-header.php'; ?>
        <?php
        switch ($page) {
            case 'OK':
            case 'home':
            case 'shop':
            case 'about-us':
                include './common/header.php';
                break;
            case 'product':
            case 'profile':
            case 'thank-you':
            case 'cart':
            case 'order-detail':
                include './common/header-2.php';
                break;
        }
        ?>
        <?php include './common/mobile.menu.php' ?>
        <div id="page-content">
            <?php
            if ($page === 'OK' || $page === 'home') {
                require_once('./home/home.slider.php');
                require_once('./home/collection-product.php');
                require_once('./home/lastest-blog.php');
                require_once('./home/feature.php');
            } else if ($page === 'shop') {
                require_once('shop.php');
            } else if ($page === 'about-us') {
                require_once('about-us.php');
            } else if ($page === 'product') {
                require_once('product-detail.php');
            } else if ($page === 'cart') {
                require_once('cart.php');
            } else if ($page === 'profile') {
                require_once('profile.php');
            } else if ($page === 'thank-you') {
                require_once('thankyou.php');
            } else if($page === 'order-detail') {
                require_once('order-detail.php');
            }
            ?>
        </div>

    </div>

    <?php include './common/footer.php'; ?>

    <script src="../../assets/client/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="../../assets/client/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="../../assets/client/js/vendor/jquery.cookie.js"></script>
    <script src="../../assets/client/js/vendor/wow.min.js"></script>
    <!-- Including Javascript -->
    <script src="../../assets/client/js/bootstrap.min.js"></script>
    <script src="../../assets/client/js/plugins.js"></script>
    <script src="../../assets/client/js/popper.min.js"></script>
    <script src="../../assets/client/js/lazysizes.js"></script>
    <script src="../../assets/client/js/main.js"></script>
    <script src="../../assets/client/js/vendor/photoswipe.min.js"></script>
    <script src="../../assets/client/js/vendor/photoswipe-ui-default.min.js"></script>
</body>

</html>