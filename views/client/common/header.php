<?php
$isLogin = $_SESSION['user'] ?? null;
if ($isLogin) {
    $user = $_SESSION['user'];
    $userId = $_SESSION['user']['user_id'];
    $cart = CartDAO::getInstance()->getCartByUser($userId);
} else {
    $cart = null;
}
?>

<div class="header-wrap classicHeader animated d-flex">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!--Desktop Logo-->
            <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                <a href="index.php">
                    <img src="../../assets/client/images/logo.png" alt="Smartband" width="80" height="80"
                        title="Smartband" />
                </a>
            </div>
            <!--End Desktop Logo-->
            <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                <div class="d-block d-lg-none">
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <i class="icon anm anm-times-l"></i>
                        <i class="anm anm-bars-r"></i>
                    </button>
                </div>
                <!--Desktop Menu-->
                <nav class="grid__item" id="AccessibleNav"><!-- for mobile -->
                    <ul id="siteNav" class="site-nav medium center hidearrow">
                        <li class="lvl1 parent megamenu"><a style="color: #ffffff !important;" href="index.php">Trang
                                chủ <i class="anm anm-angle-down-l "></i></a>
                        </li>
                        <li class="lvl1 parent megamenu"><a style="color: #ffffff !important;"
                                href="index.php?page=shop">Sản phẩm <i class="anm anm-angle-down-l"></i></a>
                        </li>
                        <li class="lvl1 parent megamenu"><a style="color: #ffffff !important;" href="?page=about-us">Về
                                chúng tôi <i class="anm anm-angle-down-l"></i></a>
                        </li>
                        <li class="lvl1"><a style="color: #ffffff !important;" href="#"><b>Mua ngay!</b> <i
                                    class="anm anm-angle-down-l"></i></a>
                        </li>
                    </ul>
                </nav>
                <!--End Desktop Menu-->
            </div>
            <!--Mobile Logo-->
            <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                <div class="logo">
                    <a href="index.php">
                        <img src="../../assets/client/images/logo.png" alt="Pet shop"
                            style="width: 40px; height: 40px; object-fit: contain;" title="Pet shop" />
                    </a>
                </div>
            </div>
            <!--Mobile Logo-->
            <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                <div class="site-cart">
                    <a href="#;" class="site-header__cart" title="Cart">
                        <i class="icon anm anm-bag-l"></i>
                        <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">
                            <?php echo $cart ? count($cart->getListCartItems()) : 0; ?>
                        </span>
                    </a>
                    <!--Minicart Popup-->
                    <div id="header-cart" class="block block-cart">
                        <?php
                        if (!$cart || empty($cart->getListCartItems())) {
                            echo '
                                <ul class="mini-products-list">
                                    <li class="item">No items in the cart.</li>
                                </ul>
                                ';
                        } else {
                            echo '<ul class="mini-products-list overflow-auto h-50">';
                            foreach ($cart->getListCartItems() as $item) {
                                echo '<li class="item cart-item">';
                                echo '<a class="product-image" href="?page=product&id=' . $item->getProductId() . '">';
                                echo '<img src="' . $item->getProduct()->getProductImage() . '" alt="' . $item->getProduct()->getProductName() . '" title="" />';
                                echo '</a>';
                                echo '<div class="product-details">';
                                echo '<a href="?page=cart&act=remove&cid=' . $item->getCartItemId() . '&ci=' . $item->getCartId() . '" class="remove"><i class="anm anm-times-l" aria-hidden="true"></i></a>';
                                echo '<a class="pName" href="?page=product&id=' . $item->getProductId() . '">' . $item->getProduct()->getProductName() . '</a>';
                                echo '<div class="wrapQtyBtn">';
                                echo '<div class="qtyField">';
                                echo '<span class="label">Số lượng:</span>';
                                // echo '<a class="qtyBtn minus" href="javascript:void(0);"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>';
                                echo '<input type="text" id="Quantity" readonly  name="quantity" value="' . $item->getQuantity() . '" class="product-form__input qty">';
                                // echo '<a class="qtyBtn plus" href="javascript:void(0);"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="priceRow">';
                                echo '<div class="product-price">';
                                echo '<span class="money">Đơn giá: ' . number_format($item->getProduct()->getProductPrice(), 0, '', ',') . ' đ</span>';
                                echo '</div>';
                                echo '<div class="product-price">';
                                echo '<span class="money">Thành tiền: ' . number_format($item->getTotalPrice(), 0, '', ',') . ' đ</span>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                        <div class="total">
                            <div class="total-in">
                                <span class="label">Tổng tiền:</span><span class="product-price"><span class="money">
                                        <?php echo (number_format($cart ? $cart->getTotalPrice() : 0, 0, '', ',') . ' đ'); ?>
                                    </span></span>
                            </div>
                            <div class="buttonSet text-center">
                                <a href="?page=cart" class="btn btn-secondary btn--small">Xem</a>
                            </div>
                        </div>
                    </div>
                    <!--EndMinicart Popup-->
                </div>
                <div class="site-header__search">
                    <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>