<?php
$orderId = $_GET['oid'];
if (!isset($orderId)) {
    header('Location: /');
}
$order = OrderDAO::getInstance()->getOrderById($orderId);
?>
<style>
    .container {
        margin-top: 50px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table,
    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: right;
        background-color: #f2f2f2;
    }

    .table-1 {
        width: 50%;
    }

    .table-2 th,
    .table-2 td {
        text-align: center;
    }
</style>
<div class="container">
    <h1 class="text-center">Chi tiết đơn hàng</h1>
    <div class="d-flex align-items-center justify-content-center">
        <table class="table table-1">
            <tbody>
                <tr>
                    <th scope="row">Mã đơn hàng</th>
                    <td>SMB -
                        <?php echo $order->getOrderId(); ?>
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
                    <th scope="row">Ngày mua</th>
                    <td>
                        <?php echo $order->getOrderDate(); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Tổng tiền</th>
                    <td>
                        <?php echo number_format($order->getTotalPrice(), 0, '', ',') . ' đ'; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Phương thức thanh toán</th>
                    <td>
                        <?php echo $order->getPaymentMethod(); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Trạng thái đơn hàng</th>
                    <td>
                        <?php echo $order->getStatus(); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Mã QR</th>
                    <td>
                        <img src="<?php echo $order->getQrCode(); ?>" alt="QR code" width="100px" height="100px">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h3>Danh sách sản phẩm:</h3>
    <table class="table table-2">
        <thead>
            <tr>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($order->getListOrderItems() as $item) {
                ?>
                <tr>
                    <td>
                        <?php echo $item->getProduct()->getProductName(); ?>
                    </td>
                    <td>
                        <?php echo number_format($item->getProduct()->getProductPrice(), 0, '', ',') . ' đ'; ?>
                    </td>
                    <td>
                        <?php echo $item->getQuantity(); ?>
                    </td>
                    <td>
                        <?php echo number_format($item->getTotalPrice(), 0, '', ',') . ' đ'; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <a href="index.php?page=profile" class="btn btn-primary">Quay lại</a>
    </div>
</div>