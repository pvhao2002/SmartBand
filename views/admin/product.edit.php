<?php
if (isset($_GET['status']) && $_GET['status'] === 'ok') {
    echo "<script> alert('Sửa thông tin sản phẩm thành công'); </script>";
}
$currentProduct = ProductDAO::getInstance()->getById($_GET['id']);
?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa thông tin sản phẩm</h4>
            <p class="card-description"> Nhập thông tin sản phẩm </p>
            <form class="forms-sample" action="index.php?page=product&act=edit" method="post"
                enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $currentProduct->getProductId(); ?>">
                <div class="form-group">
                    <label for="exampleInputName1">Tên sản phẩm</label>
                    <input type="text" class="form-control" value="<?php echo $currentProduct->getProductName(); ?>"
                        id="exampleInputName1" name="name" required placeholder="Tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="exampleInputPrice">Giá sản phẩm</label>
                    <input type="number" class="form-control" value="<?php echo $currentProduct->getProductPrice(); ?>"
                        id="exampleInputPrice" min="0" name="price" required placeholder="Giá">
                </div>
                <div class="form-group">
                    <label for="exampleInputStock">Số lượng tồn</label>
                    <input type="number" class="form-control" id="exampleInputStock"
                        value="<?php echo $currentProduct->getStock(); ?>" min="0" name="stock" required
                        placeholder="Số lượng tồn">
                </div>

                <div class="form-group">
                    <label for="exampleSelectGender">Loại sản phẩm</label>
                    <select class="form-control" id="exampleSelectGender" name="category" required>
                        <option value="1" <?php echo $currentProduct->getCategoryId() === 1 ? 'selected' : ''; ?>>Sản phẩm
                            cho chó</option>
                        <option value="2" <?php echo $currentProduct->getCategoryId() === 2 ? 'selected' : ''; ?>>Sản phẩm
                            cho mèo</option>
                        <option value="3" <?php echo $currentProduct->getCategoryId() === 3 ? 'selected' : ''; ?>> Sản
                            phẩm cho chó và mèo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type="file" name="img" value="<?php echo $currentProduct->getProductImage(); ?>"
                        class="file-upload-default" required>
                    <div class="input-group col-xs-12">
                        <input type="text" value="<?php echo $currentProduct->getProductImage(); ?>"
                            class="form-control file-upload-info" disabled placeholder="Tải ảnh lên">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Tải lên</button>
                        </span>
                    </div>
                    <div class="col-xs-12">
                        <img src="<?php echo $currentProduct->getProductImage(); ?>" alt="PET_MART" class="mt-2"
                            id="previewImage" style="width: 100px; height: 100px;" />
                        <button class="btn btn-outline-danger" type="button" id="deleteImage">Xóa</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleTextarea1">Mô tả</label>
                    <textarea class="form-control" name="des" id="exampleTextarea1" rows="5"
                        required><?php echo $currentProduct->getProductDescription(); ?></textarea>
                </div>
                <input type="submit" class="btn btn-gradient-primary me-2" name="edit" value="Sửa">
            </form>
        </div>
    </div>
</div>