<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Smartband</title>
    <link rel="stylesheet" href="../../assets/admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/admin/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/admin/css/style.css">
    <link rel="shortcut icon" href="../../assets/admin/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include 'nav.php'; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include 'sidebar.php'; ?>
            <!-- partial -->
            <div class="main-panel">
                <?php
                $page = $page ?? '';
                switch ($page) {
                    case 'user':
                        include 'user.list.php';
                        break;
                    case 'product':
                        include 'product.php';
                        break;
                    case 'order':
                        include 'order.list.php';
                        break;
                    case 'order-detail':
                        include 'order.detail.php';
                        break;
                    default:
                        include 'dashboard.php';
                        break;
                }
                ?>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include 'footer.php'; ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <script src="../../assets/admin/vendors/js/vendor.bundle.base.js"></script>
    <script src="../../assets/admin/vendors/chart.js/Chart.min.js"></script>
    <script src="../../assets/admin/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="../../assets/admin/js/off-canvas.js"></script>
    <script src="../../assets/admin/js/hoverable-collapse.js"></script>
    <script src="../../assets/admin/js/misc.js"></script>
    <script src="../../assets/admin/js/dashboard.js"></script>
    <script src="../../assets/admin/js/file-upload.js"></script>
</body>

</html>