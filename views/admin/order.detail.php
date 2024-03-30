<?php
$oid = $_GET['oid'];
if (isset($oid)) {
    $order = OrderDAO::getInstance()->getOrderById($oid);
} else {
    header('Location: index.php?page=order');
    exit();
}
?>
<div class="col-12">
    <h1>Chi tiết đơn hàng -
        <?php echo $order->getOrderId(); ?>
    </h1>
</div>
<div class="col-lg-12 grid-margin stretch-card mb-0">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thông tin đơn hàng</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="col">Mã đơn hàng</th>
                            <td>
                                <?php echo $order->getOrderId(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Email khách hàng</th>
                            <td>
                                <?php echo $order->getUser()->getEmail(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Tên khách hàng</th>
                            <td>
                                <?php echo $order->getUser()->getFullName(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Người nhận</th>
                            <td>
                                <?php echo $order->getReceiverName(); ?>
                            </td>
                        </tr>

                        <tr>
                            <th scope="col">Số điện thoại</th>
                            <td>
                                <?php echo $order->getPhoneNumber(); ?>
                            </td>
                        </tr>

                        <tr>
                            <th scope="col">Địa chỉ giao hàng</th>
                            <td>
                                <?php echo $order->getShippingAddress(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Ngày mua</th>
                            <td>
                                <?php echo $order->getOrderDate(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Tổng tiền</th>
                            <td>
                                <?php echo number_format($order->getTotalPrice(), 0, '', ',') . ' đ'; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Số lượng</th>
                            <td>
                                <?php echo $order->getTotalQuantity(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Thanh toán</th>
                            <td>
                                <?php echo $order->getPaymentMethod(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Trạng thái</th>
                            <td>
                                <?php echo $order->getStatus(); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">QR code</th>
                            <td> <img src="../client/<?php echo $order->getQrCode(); ?>" alt="PET_MART" class="mt-2"
                                    style="width: 100px; height: 100px; border-radius: 0;" /> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mb-5 mt-0" style="margin-top: -0.5rem;">
    <h4 class="card-title mb-3">Chi tiết đơn hàng</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th> Mã SP </th>
                    <th> Tên SP </th>
                    <th> Số lượng </th>
                    <th> Đơn giá </th>
                    <th> Thành tiền </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($order->getListOrderItems() as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getProduct()->getProductId() . "</td>";
                    echo "<td>" . $item->getProduct()->getProductName() . "</td>";
                    echo "<td>" . $item->getQuantity() . "</td>";
                    echo "<td>" . number_format($item->getProduct()->getProductPrice(), 0, '', ',') . " đ</td>";
                    echo "<td>" . number_format($item->getTotalPrice(), 0, '', ',') . " đ</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
if ($order->getStatusValue() === 'pending') {
    echo '<div class="col-12">
            <a href="index.php?page=order&act=confirm&oid=' . $order->getOrderId() . '" class="btn btn-success">Xác nhận đơn hàng</a>
            <a href="index.php?page=order&act=cancel&oid=' . $order->getOrderId() . '" class="btn btn-danger">Hủy đơn hàng</a>
        </div>';
} else if ($order->getStatusValue() === 'processing') {
    echo '<div class="col-12">
            <a href="index.php?page=order&act=completed&oid=' . $order->getOrderId() . '" class="btn btn-success">Chuẩn bị đơn hàng xong</a>
        </div>';
} else if ($order->getStatusValue() === 'completed') {
    echo '<div class="col-12">
            <a href="index.php?page=order&act=done&oid=' . $order->getOrderId() . '" class="btn btn-success">Giao đơn hàng thành công</a>
        </div>';
} else if ($order->getStatusValue() === 'cancelled' && $order->getPaymentMethodValue() === 'VN_PAY') {
    echo '<div class="col-12">
            <a href="index.php?page=order&act=refund&oid=' . $order->getOrderId() . '" class="btn btn-danger">Hoàn tiền</a>
        </div>';
}
?>