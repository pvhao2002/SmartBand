<?php
$list = UserDAO::getInstance()->getAll();
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
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col"> Mã khách hàng </th>
                        <th> Email </th>
                        <th> Họ tên </th>
                        <th> Trạng thái tài khoản </th>
                        <th> # </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list as $item) {
                        echo "<tr>";
                        echo "<td scope='row'>" . $item->getUserId() . "</td>";
                        echo "<td class='text-truncate' style='max-width: 250px;' title='" . $item->getEmail() . "'>" . $item->getEmail() . "</td>";
                        echo "<td>" . $item->getFullName() . "</td>";
                        echo "<td>" . $item->getStatus() . "</td>";
                        if ($item->getStatusValue() == 'active') {
                            echo "<td>
                                <a href='index.php?page=user&act=block&id=" . $item->getUserId() . "' class='btn btn-warning btn-sm'>Khóa</a>
                            </td>";
                        } else if ($item->getStatusValue() == 'block') {
                            echo "<td>
                                <a href='index.php?page=user&act=unblock&id=" . $item->getUserId() . "' class='btn btn-success btn-sm'>Mở khóa</a>
                            </td>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>