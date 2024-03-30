<div class="top-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-10 col-sm-8 col-md-5 col-lg-4">
                <div class="language-dropdown">
                    <span class="language-dd">Tiếng việt</span>
                    <ul id="language">
                        <li class="">Tiếng anh</li>
                    </ul>
                </div>
                <p class="phone-no"><i class="anm anm-phone-s"></i> +440 0(111) 044 833</p>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                <div class="text-center">
                    <p class="top-header_middle-text"> Smartband Shop - Thiên đường thiết bị đeo thông minh</p>
                </div>
            </div>
            <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                <?php
                if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
                    echo '<ul class="customer-links list-inline">
                    <li><a href="index.php?page=profile">Xin chào, ' . ($_SESSION['user']['full_name'] ?? '') . '</a></li>
                    <li><a href="index.php?page=logout">Đăng xuất</a></li>
                </ul>';
                } else {
                    echo '<ul class="customer-links list-inline">
                    <li><a href="login.php">Đăng nhập</a></li>
                    <li><a href="register.php">Đăng ký tài khoản</a></li>
                </ul>';
                }
                ?>
            </div>
        </div>
    </div>
</div>