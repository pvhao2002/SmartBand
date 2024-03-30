<?php
$cateList = CategoryDAO::getInstance()->getAll();
$list = [];
foreach ($cateList as $item) {
    $list[$item->getCategoryId()] = ProductDAO::getInstance()->getTop10ProductByCategory($item->getCategoryId());
}
?>
<!-- Top 10 sản phẩm mới nhất -->
<div class="tab-slider-product section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="section-header text-center">
                    <h2 class="h2">Sản phẩm phổ biến</h2>
                </div>
                <div class="tabs-listing">
                    <ul class="tabs clearfix">
                        <?php
                        foreach ($cateList as $item) {
                            echo '<li rel="tab' . $item->getCategoryId() . '">' . $item->getCategoryName() . '</li>';
                        }
                        ?>
                    </ul>
                    <div class="tab_container">
                        <?php
                        $index = 1;
                        foreach ($list as $item) {
                            if (isset($item) && count($item) > 0) {
                                echo '<div id="tab' . $item[0]->getCategoryId() . '" class="tab_content grid-products">';
                                echo '<div class="productSlider">';
                                foreach ($item as $product) {
                                    echo '<div class="col-12 item">';
                                    echo '<div class="product-image" style="width: 200px; height: 150px; object-fit: cover;">';
                                    echo '<a href="?page=product&id=' . $product->getProductId() . '">';
                                    echo '<img class="primary blur-up lazyload" data-src="' . $product->getProductImage() . '" src="' . $product->getProductImage() . '" alt="image" title="' . $product->getCategoryName() . '">';
                                    echo '<img class="hover blur-up lazyload" data-src="' . $product->getProductImage() . '" src="' . $product->getProductImage() . '" alt="image" title="' . $product->getCategoryName() . '">';
                                    echo '<div class="product-labels rectangular"><span class="lbl pr-label1">new</span></div>';
                                    echo '</a>';
                                    echo '<div class="saleTime desktop" data-countdown="2024/05/20"></div>';
                                    echo '<form class="variants add" action="index.php?page=cart&act=add" method="post">';
                                    echo '<input type="hidden" name="pid" value="' . $product->getProductId() . '">';
                                    echo '<input type="hidden" name="price" value="' . $product->getProductPrice() . '">';
                                    echo '<button class="btn btn-addto-cart" type="submit">Thêm vào giỏ hàng</button>';
                                    echo '</form>';
                                    echo '<div class="button-set">';
                                    echo '<a href="javascript:void(0)" title="Quick View" class="quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview">';
                                    echo '<i class="icon anm anm-search-plus-r"></i>';
                                    echo '</a>';
                                    echo '<div class="wishlist-btn">';
                                    echo '<a class="wishlist add-to-wishlist" href="javascript:void(0)">';
                                    echo '<i class="icon anm anm-heart-l"></i>';
                                    echo '</a>';
                                    echo '</div>';
                                    echo '<div class="compare-btn">';
                                    echo '<a class="compare add-to-compare" href="javascript:void(0)" title="Add to Compare">';
                                    echo '<i class="icon anm anm-random-r"></i>';
                                    echo '</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="product-details text-center">';
                                    echo '<div class="product-name">';
                                    echo '<a href="?page=product&id=' . $product->getProductId() . '">' . $product->getProductName() . '</a>';
                                    echo '</div>';
                                    echo '<div class="product-price">';
                                    echo '<span class="price">' . number_format($product->getProductPrice(), 0, '', ',') . ' đ</span>';
                                    echo '</div>';
                                    echo '<div class="product-review">';
                                    echo '<i class="font-13 fa fa-star"></i>';
                                    echo '<i class="font-13 fa fa-star"></i>';
                                    echo '<i class="font-13 fa fa-star"></i>';
                                    echo '<i class="font-13 fa fa-star"></i>';
                                    echo '<i class="font-13 fa fa-star"></i>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                echo '</div>';
                                echo '</div>';
                            } else {
                                echo '<div id="tab' . $index . '" class="tab_content grid-products">';
                                echo '<div class="productSlider">';
                                echo '<div class="col-12 item">';
                                echo '<div class="product-details text-center">';
                                echo '<div class="product-name">';
                                echo '<a href="#">Không có sản phẩm nào</a>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            $index++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>