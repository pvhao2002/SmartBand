<?php
$list = ProductDAO::getInstance()->getAll();
?>
<style>
    .truncate {
        width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body table-responsive">
            <a href="index.php?page=product&act=add" class="btn btn-primary mb-2">Thêm sản phẩm</a>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col"> Mã sản phẩm </th>
                        <th> Tên sản phẩm </th>
                        <th> Giá sản phẩm </th>
                        <th> Số lượng tồn </th>
                        <th> Hình ảnh </th>
                        <th> Loại sản phẩm </th>
                        <th> Mô tả </th>
                        <th> # </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list as $item) {
                        echo "<tr>";
                        echo "<td scope='row'>" . $item->getProductId() . "</td>";
                        echo "<td class='text-truncate' style='max-width: 250px;' title='" . $item->getProductName() . "'>" . $item->getProductName() . "</td>";
                        echo "<td>" . (number_format($item->getProductPrice(), 0, '', ',')) . " đ</td>";
                        echo "<td>" . $item->getStock() . "</td>";
                        echo "<td><img src='" . $item->getProductImage() . "' alt='PET_MART' class='mt-2' style='width: 100px; height: 100px; border-radius: 0 !important;' /></td>";
                        echo "<td>" . $item->getCategoryName() . "</td>";
                        echo "<td class='text-truncate' style='max-width: 250px;' title='" . $item->getProductDescription() . "'>" . $item->getProductDescription() . "</td>";
                        echo "<td>
                                <a href='index.php?page=product&act=edit&id=" . $item->getProductId() . "' class='btn btn-warning'>Sửa</a>
                                <a href='index.php?page=product&act=delete&id=" . $item->getProductId() . "' class='btn btn-outline-danger'>Xóa</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>