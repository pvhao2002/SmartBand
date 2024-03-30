<?php
$list = OrderDAO::getInstance()->getAll();
?>
<style>
    .truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th style="width: 7%;" scope="col"> Mã </th>
                        <th style="width: 10%;"> Email KH </th>
                        <th style="width: 13%;"> Tên KH </th>
                        <th style="width: 10%;"> Ngày mua </th>
                        <th style="width: 10%;"> Tổng tiền </th>
                        <th style="width: 10%;"> Số lượng </th>
                        <th style="width: 10%;"> Thanh toán </th>
                        <th style="width: 15%;"> Trạng thái </th>
                        <th style="width: 15%;"> QR code </th>
                        <th style="width: 10%;"> # </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list as $item) {
                        echo "<tr>";
                        echo "<td scope='row'>" . $item->getOrderId() . "</td>";
                        echo "<td class='text-truncate' style='max-width: 250px;' title='" . $item->getUser()->getEmail() . "'>" . $item->getUser()->getEmail() . "</td>";
                        echo "<td>" . $item->getUser()->getFullName() . "</td>";
                        echo "<td>" . $item->getOrderDate() . "</td>";
                        echo "<td>" . (number_format($item->getTotalPrice(), 0, '', ',')) . " đ</td>";
                        echo "<td>" . $item->getTotalQuantity() . "</td>";
                        echo "<td>" . $item->getPaymentMethod() . "</td>";
                        echo "<td>" . $item->getStatus() . "</td>";
                        echo "<td><img src='../client/" . $item->getQrCode() . "' alt='PET_MART' class='mt-2' style='width: 100px; height: 100px; border-radius: 0;' /></td>";
                        echo "<td>
                                <a href='index.php?page=order-detail&oid=" . $item->getOrderId() . "' class='btn btn-info btn-sm'>Chi tiết</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>