<?php
$pageSize = $_GET['pageSize'] ?? 9;
$page = $_GET['pageNumber'] ?? 1;
$category = $_GET['cate'] ?? 0;
$sort = $_GET['sort'] ?? '';
$list = ProductDAO::getInstance()->getProducPaginate($page, $pageSize, $category, $sort);
$numberPage = ceil($list['total'] / $pageSize);
$cateList = CategoryDAO::getInstance()->getAll();
?>
<?php require_once ('hero.php') ?>
<div class="container mt-3">
    <div class="row">
        <!--Sidebar-->
        <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
            <div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
            <div class="sidebar_tags">
                <!--Categories-->
                <div class="sidebar_widget categories filter-widget">
                    <div class="widget-title">
                        <h2>Loại sản phẩm</h2>
                    </div>
                    <div class="widget-content">
                        <ul class="sidebar_categories">
                            <li class="lvl-1"><a href="?page=shop" class="site-nav">Tất
                                    cả</a></li>
                            <?php
                            foreach ($cateList as $item) {
                                ?>
                                <li class="lvl-1"><a href="?page=shop&cate=<?php echo $item->getCategoryId(); ?>"
                                        class="site-nav">
                                        <?php echo $item->getCategoryName(); ?>
                                    </a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!--Categories-->
                <div class="sidebar_widget">
                    <div class="widget-title">
                        <h2>Khuyến mãi</h2>
                    </div>
                </div>
                <div class="sidebar_widget static-banner">
                    <img src="../../assets/client/images/slideshow-banners/banner4.jpg" alt="Smartband" width="250"
                        height="400" />
                </div>
                <div class="sidebar_widget">
                    <div class="widget-title">
                        <h2>Tags</h2>
                    </div>
                    <div class="widget-content">
                        <ul class="product-tags">
                            <li><a href="javascript:;" title="Giá tiền từ 100k đến 1tr">100k - 1tr</a>
                            </li>
                            <li><a href="javascript:;" title="Giá tiền từ 1tr đến 3tr">1tr - 3tr</a>
                            </li>
                            <li><a href="javascript:;" title="Giá tiền từ 3tr đến 5tr">3tr - 5tr</a>
                            </li>
                            <li><a href="javascript:;" title="Giá tiền trên 5tr">trên 5tr</a></li>
                            <li><a href="javascript:;" title="Các thương hiệu đồng hồ thông minh">Các thương hiệu đồng
                                    hồ thông minh</a>
                            </li>
                            <li><a href="javascript:;" title="Đồng hồ theo dõi sức khỏe">Đồng hồ theo dõi sức
                                    khỏe</a></li>
                            <li><a href="javascript:;" title="Tương thích với Android">Tương thích với Android</a></li>
                            <li><a href="javascript:;" title="Tương thích với iOS">Tương thích với
                                    iOS</a></li>
                            <li><a href="javascript:;" title="Sản phẩm phổ biến">Sản phẩm phổ biến</a>
                            </li>
                            <li><a href="javascript:;" title="Top sản phẩm">Top sản phẩm</a></li>
                            <li><a href="javascript:;" title="Chống nước">Chống nước</a></li>
                            <li><a href="javascript:;" title="Sản phẩm bán chạy">Sản phẩm bán chạy</a></li>
                            <li><a href="javascript:;" title="Đồng hồ cao cấp">Đồng hồ cao cấp</a></li>
                            <li><a href="javascript:;" title="Đồng hồ giá rẻ">Đồng hồ giá rẻ</a>
                            </li>
                            <li><a href="javascript:;" title="Phụ kiện đồng hồ thông minh">Phụ kiện đồng hồ thông
                                    minh</a></li>
                            <li><a href="javascript:;" title="Dây và dây đeo">Dây và dây đeo</a></li>
                            <li><a href="javascript:;" title="Miếng dán màn hình">Miếng dán màn hình</a></li>
                            <li><a href="javascript:;" title="Đế sạc">Đế sạc</a>
                            </li>
                            <li><a href="javascript:;" title="Phiên bản thể thao">Phiên bản thể thao</a></li>
                            <li><a href="javascript:;" title="Phiên bản cổ điển">Phiên bản cổ điển</a>
                            </li>
                            <li><a href="javascript:;" title="Đồng hồ cho trẻ em">Đồng hồ cho trẻ em</a></li>
                            <li><a href="javascript:;" title="Theo dõi sức khỏe">Theo dõi sức khỏe</a></li>
                            <li><a href="javascript:;" title="Show products matching tag new">Tông đơ cạo lông</a></li>
                            <li><a href="javascript:;" title="Theo dõi giấc ngủ">Theo dõi giấc ngủ</a></li>
                        </ul>
                        <span class="btn btn--small btnview">Xem tất cả</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End Sidebar-->
        <!--Main Content-->
        <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
            <div class="category-description">
                <h3>Danh sách sản phẩm</h3>
            </div>
            <hr>
            <div class="productList">
                <!--Toolbar-->
                <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Product Filters</button>
                <div class="toolbar">
                    <div class="filters-toolbar-wrapper">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 text-right">
                                <div class="filters-toolbar__item">
                                    <?php
                                    if (isset($list['data']) && count($list['data']) != 0) {
                                        ?>
                                        <label for="SortBy" class="hidden">Sắp xếp</label>
                                        <select name="SortBy" id="SortBy" onchange="changeSort(this)"
                                            class="filters-toolbar__input filters-toolbar__input--sort">
                                            <option value="" selected="selected">Chọn sắp xếp</option>
                                            <option value="A-Z">Theo thứ tự, A-Z</option>
                                            <option value="Z-A">Theo thứ tự, Z-A</option>
                                            <option value="price-asc">Giá, thấp tới cao</option>
                                            <option value="price-desc">Giá, cao tới thấp</option>
                                        </select>
                                        <input class="collection-header__default-sort" type="hidden" value="manual">
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--End Toolbar-->
                <div class="grid-products grid--view-items">
                    <div class="row">
                        <?php
                        if (isset($list['data']) && count($list['data']) == 0) {
                            echo '<div class="col-12 col-sm-12 col-md-12 col-lg-12">';
                            echo '<div class="section-header text-center">';
                            echo '<h2 class="h2">Sản phẩm đã hết hàng</h2>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            foreach ($list['data'] as $item) {
                                ?>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-4 item">
                                    <!-- start product image -->
                                    <div class="product-image" style="width: 200px; height: 150px; object-fit: cover;">
                                        <!-- start product image -->
                                        <a href="?page=product&id=<?php echo $item->getProductId(); ?>">
                                            <!-- image -->
                                            <img class="primary blur-up lazyload"
                                                data-src="<?php echo $item->getProductImage() ?>"
                                                src="<?php echo $item->getProductImage() ?>" alt="image" title="product">
                                            <!-- End image -->
                                            <!-- Hover image -->
                                            <img class="hover blur-up lazyload"
                                                data-src="<?php echo $item->getProductImage() ?>"
                                                src="<?php echo $item->getProductImage() ?>" alt="image" title="product">
                                            <!-- End hover image -->
                                        </a>
                                        <!-- end product image -->

                                        <!-- Start product button -->
                                        <form class="variants add" action="index.php?page=cart&act=add" method="post">
                                            <input type="hidden" name="pid" value="<?php echo $item->getProductId(); ?>">
                                            <input type="hidden" name="price" value="<?php echo $item->getProductPrice(); ?>">
                                            <button class="btn btn-addto-cart" type="submit">Thêm vào giỏ hàng</button>
                                        </form>
                                        <!-- end product button -->
                                    </div>
                                    <!-- end product image -->

                                    <!--start product details -->
                                    <div class="product-details text-center">
                                        <!-- product name -->
                                        <div class="product-name">
                                            <a href="?page=product&id=<?php echo $item->getProductId(); ?>">
                                                <?php echo $item->getProductName(); ?>
                                            </a>
                                        </div>
                                        <!-- End product name -->
                                        <!-- product price -->
                                        <div class="product-price">
                                            <span class="price">
                                                <?php echo (number_format($item->getProductPrice(), 0, '', ',') . ' đ'); ?>
                                            </span>
                                        </div>
                                        <!-- End product price -->
                                    </div>
                                    <!-- End product details -->
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <hr class="clear">
            <div class="pagination">
                <ul>
                    <?php
                    for ($i = 1; $i <= $numberPage; $i++) {
                        ?>
                        <li class="<?php echo $page == $i ? 'active' : ''; ?>">
                            <a
                                href="?pageNumber=<?php echo $i; ?>&page=shop&cate=<?php echo $category; ?>&sort=<?php echo $sort; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!--End Main Content-->
    </div>
</div>

<script>
    function changeSort(e) {
        let url = `?page=shop&sort=${e.value}&pageNumber=<?php echo $page;
        if (isset($category) && $category)
            echo '&cate=' . $category; ?>`;
        window.location.href = url;
    }
</script>