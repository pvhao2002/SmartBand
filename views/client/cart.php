<?php
$isLogin = $_SESSION['user'] ?? null;
if ($isLogin) {
    $user = $_SESSION['user'];
    $userId = $_SESSION['user']['user_id'];
    $cart = CartDAO::getInstance()->getCartByUser($userId);
} else {
    $cart = Cart::initCart();
    $user = new User('', '', '', '', '', '');
}
?>

<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper">
            <h1 class="page-width">Giỏ hàng của bạn</h1>
        </div>
    </div>
</div>
<!--End Page Title-->

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col">
            <form action="#" method="post" class="cart style2">
                <table>
                    <thead class="cart__row cart__header">
                        <tr>
                            <th colspan="2" class="text-center">Sản phẩm</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-right">Thành tiền</th>
                            <th class="action">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!$cart || !$cart->getListCartItems()) {
                            echo '<tr><td colspan="6" class="text-center">Giỏ hàng trống</td></tr>';
                        } else {
                            foreach ($cart->getListCartItems() as $item) {
                                echo '
                                <tr class="cart__row border-bottom line1 cart-flex border-top">
                                <td class="cart__image-wrapper cart-flex-item">
                                    <a href="?page=product&id=' . $item->getProductId() . '">
                                    <img class="cart__image"
                                            src="' . $item->getProduct()->getProductImage() . '"
                                            alt="Smartband">
                                    </a>
                                </td>
                                <td class="cart__meta small--text-left cart-flex-item">
                                    <div class="list-view-item__title text-truncate" style="max-width: 250px;" title="' . $item->getProduct()->getProductName() . '">
                                        <a href="?page=product&id=' . $item->getProductId() . '">' . $item->getProduct()->getProductName() . '</a>
                                    </div>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item">
                                    <span class="money">' . number_format($item->getProduct()->getProductPrice(), 0, '', ',') . ' đ</span>
                                </td>
                                <td class="cart__update-wrapper cart-flex-item text-right">
                                    <div class="cart__qty text-center">
                                        <div class="qtyField" data-pid="' . $item->getProductId() . '">
                                            <a data-pid="' . $item->getProductId() . '" class="qtyBtn minus" href="javascript:void(0);"><i
                                                    class="icon icon-minus"></i></a>
                                            <input class="cart__qty-input qty" type="text" min="1" readonly name="updates[]" id="qty"
                                                value="' . $item->getQuantity() . '" pattern="[0-9]*">
                                            <a data-pid="' . $item->getProductId() . '" class="qtyBtn plus" href="javascript:void(0);"><i
                                                    class="icon icon-plus"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right small--hide cart-price">
                                    <div><span class="money">' . number_format($item->getTotalPrice(), 0, '', ',') . ' đ</span></div>
                                </td>
                                <td class="text-center small--hide"><a href="#" class="btn btn--secondary cart__remove"
                                        title="Remove tem"><i class="icon icon anm anm-times-l"></i></a></td>
                            </tr>
                                ';
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-left"><a href="?page=shop" class="btn--link cart-continue"><i
                                        class="icon icon-arrow-circle-left"></i> Tiếp tục mua sắm</a></td>
                            <td colspan="3" class="text-right"><a href="?page=cart" name="update"
                                    class="btn--link cart-update"><i class="fa fa-refresh"></i> Làm mới</a></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="currencymsg">
                    <br>
                    <strong>Chú ý:</strong> Bạn vui lòng kiểm tra kỹ sản phẩm trước khi thanh toán. Sau khi thanh toán
                    bạn sẽ nhận được mã QR và thông tin chi tiết đơn hàng về email.
                    Vui lòng đảm bảo rằng email của bạn là chính xác để nhận mã QR
                    <br>
                    <strong>Phương thức thanh toán:</strong> Bạn có thể thanh toán bằng tiền mặt hoặc chuyển khoản
                </div>
                <hr>
            </form>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
            <form action="?page=cart&act=checkout" method="post">
                <div class="cart-note">
                    <div class="solid-border">
                        <label for="">Họ và tên:</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" required />
                        <label for="">Số điện thoại:</label>
                        <input type="text" name="phone" id="phone" class="form-control" required />
                        <label for="">Địa chỉ:</label>
                        <input type="text" name="address" id="address" class="form-control" required />

                        <label for="">Phương thức thanh toán:</label>
                        <select name="payment" id="payment" class="form-control" required>
                            <option value="CASH">Thanh toán tại cửa hàng</option>
                            <option value="VN_PAY">VN-PAY</option>
                        </select>
                    </div>
                </div>
                <div class="solid-border">
                    <div class="row">
                        <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Tổng cộng:</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span
                                class="money">
                                <?php echo number_format($cart->getTotalPrice(), 0, '', ','); ?> đ
                            </span></span>
                    </div>
                    <div class="cart__shipping">Vui lòng chọn phương thức thanh toán</div>
                    <input type="submit" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout"
                        value="Checkout" <?php echo (!$cart || !$cart->getListCartItems()) ? 'disabled' : '' ?>>
                    <div class="paymnet-img"><img src="../../assets/client/images/payment-img.jpg" alt="Payment"></div>
                </div>
            </form>
        </div>
    </div>
</div>