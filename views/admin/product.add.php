<?php
if (isset($_GET['status']) && $_GET['status'] === 'ok') {
    echo "<script> alert('Thêm sản phẩm thành công'); </script>";
}
$listCate = CategoryDAO::getInstance()->getAll();
?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm mới sản phẩm</h4>
            <p class="card-description"> Nhập thông tin sản phẩm </p>
            <form class="forms-sample" action="index.php?page=product&act=add" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName1">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="name" required
                        placeholder="Tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="exampleInputPrice">Giá sản phẩm</label>
                    <input type="number" class="form-control" id="exampleInputPrice" min="0" name="price" required
                        placeholder="Giá">
                </div>
                <div class="form-group">
                    <label for="exampleInputStock">Số lượng tồn</label>
                    <input type="number" class="form-control" id="exampleInputStock" min="0" name="stock" required
                        placeholder="Số lượng tồn">
                </div>
                <div class="form-group">
                    <label for="exampleSelectGender">Loại sản phẩm</label>
                    <select class="form-control" id="exampleSelectGender" name="category" required>
                        <?php
                        foreach ($listCate as $cate) {
                            echo "<option value='" . $cate->getCategoryId() . "'>" . $cate->getCategoryName() . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type="file" name="img" class="file-upload-default" required>
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Tải ảnh lên">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Tải lên</button>
                        </span>
                    </div>
                    <div class="col-xs-12 img-preview">
                        <img src="/assets/images/dashboard/img_2.jpg" alt="PET_MART" class="mt-2" id="previewImage"
                            style="width: 100px; height: 100px;" />
                        <button class="btn btn-outline-danger" type="button" id="deleteImage">Xóa</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleTextarea1">Mô tả</label>
                    <textarea class="form-control" name="des" id="exampleTextarea1" rows="5" required></textarea>
                </div>
                <input type="submit" class="btn btn-gradient-primary me-2" name="add" value="Thêm">
            </form>
        </div>
    </div>
</div>