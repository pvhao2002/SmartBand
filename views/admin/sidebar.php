<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <span class="menu-title">Trang chủ</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=user">
                <span class="menu-title">Quản lý người dùng</span>
                <i class="mdi mdi-account menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="?page=product#ui-basic1" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Quản lý sản phẩm</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="index.php?page=product">Danh sách</a></li>
                    <li class="nav-item"> <a class="nav-link" href="index.php?page=product&act=add">Thêm mới</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=order">
                <span class="menu-title">Quản lý hóa đơn</span>
                <i class="mdi mdi-barcode-scan menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>