<?php
$user = $_SESSION['user'];
$list = OrderDAO::getInstance()->getOrders($user['user_id']);
?>
<div class="container-fluid mt-3">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-2 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://www.shutterstock.com/image-vector/default-avatar-profile-icon-social-600nw-1677509740.jpg"
                                alt="Img" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>
                                    <?php echo $user['full_name']; ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-instagram mr-2 icon-inline text-danger">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>Instagram</h6>
                            <span class="text-secondary">
                                <?php echo $user['full_name']; ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-facebook mr-2 icon-inline text-primary">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>Facebook</h6>
                            <span class="text-secondary">
                                <?php echo $user['full_name']; ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row gutters-sm">
                    <div class="col-sm-12 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Lịch
                                        sử đơn hàng</i></h6>
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th scope="col"> Mã đơn hàng </th>
                                            <th> Người nhận</th>
                                            <th> Số điện thoại </th>
                                            <th> Địa chỉ giao hàng </th>
                                            <th> Ngày mua </th>
                                            <th> Tổng tiền </th>
                                            <th> Phương thức thanh toán </th>
                                            <th> Trạng thái </th>
                                            <th> Số lượng sản phẩm </th>
                                            <th> Mã QR-Code </th>
                                            <th> Chi tiết </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($list as $item) {
                                            echo "<tr>";
                                            echo "<td scope='row'> SMB - " . $item->getOrderId() . "</td>";
                                            echo "<td>" . $item->getReceiverName() . "</td>";
                                            echo "<td>" . $item->getPhoneNumber() . "</td>";
                                            echo "<td>" . $item->getShippingAddress() . "</td>";
                                            echo "<td>" . $item->getOrderDate() . "</td>";
                                            echo "<td>" . (number_format($item->getTotalPrice(), 0, '', ',')) . "đ</td>";
                                            echo "<td>" . $item->getPaymentMethod() . "</td>";
                                            echo "<td>" . $item->getStatus() . "</td>";
                                            echo "<td>" . $item->getTotalQuantity() . "</td>";
                                            echo "<td>
                                                    <img src='" . $item->getQrCode() . "' alt='PET_MART' class='mt-2' style='width: 50px; height: 50px;' />
                                                </td>";
                                            echo "<td>
                                                    <a href='index.php?page=order-detail&oid=" . $item->getOrderId() . "' class='btn btn-primary'>Xem chi tiết</a>
                                                </td>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>