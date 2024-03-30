<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Quản lý sản phẩm </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <?php
        $act = $_GET['act'] ?? '';
        switch ($act) {
            case 'add':
                include 'product.add.php';
                break;
            case 'edit':
                include 'product.edit.php';
                break;
            default:
                include 'product.list.php';
                break;
        }
        ?>
    </div>
</div>