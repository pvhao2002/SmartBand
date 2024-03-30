<?php
require_once('category.php');
class Product
{
    private $productId;
    private $productName;
    private $price;
    private $description;
    private $stock;
    private $productImage;
    private $categoryId;
    private $category;

    public function __construct($productId, $productName, $productPrice, $productDescription, $stock, $productImage, $categoryId, $category)
    {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->price = $productPrice;
        $this->description = $productDescription;
        $this->stock = $stock;
        $this->productImage = $productImage;
        $this->categoryId = $categoryId;
        $this->category = $category;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getProductPrice()
    {
        return $this->price;
    }

    public function getProductDescription()
    {
        return $this->description;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getProductImage()
    {
        return $this->productImage;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getCategoryName()
    {
        return $this->category->getCategoryName();
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;
    }

    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function toArray()
    {
        return array(
            "productId" => $this->productId,
            "productName" => $this->productName,
            "price" => $this->price,
            "description" => $this->description,
            "productImage" => $this->productImage,
            "categoryId" => $this->categoryId
        );
    }

    public function toInsertSql()
    {
        $sql = "insert into products(product_name, price, description, stock, product_image, category_id) 
        VALUES (
            '{$this->getProductName()}',
            '{$this->getProductPrice()}',
            '{$this->getProductDescription()}',
            '{$this->getStock()}',
            '{$this->getProductImage()}',
            '{$this->getCategoryId()}'
        );";
        return $sql;
    }

    public function toUpdateSql()
    {
        $sql = "update products set 
        product_name = '{$this->getProductName()}',
        price = '{$this->getProductPrice()}',
        description = '{$this->getProductDescription()}',
        stock = '{$this->getStock()}',
        product_image = '{$this->getProductImage()}',
        category_id = '{$this->getCategoryId()}' 
        where product_id = '{$this->getProductId()}';";
        return $sql;
    }

    public static function fromResultSet($arr)
    {
        $category = Category::fromResultSet($arr);
        return new Product(
            $arr['product_id'] ?? '',
            $arr['product_name'] ?? '',
            $arr['price'] ?? 0,
            $arr['description'] ?? '',
            $arr['stock'] ?? 0,
            $arr['product_image'] ?? '',
            $arr['category_id'] ?? 0,
            $category
        );
    }

    public static function fromMethodPost($post, $imgUrl)
    {
        return new Product(
            $post['product_id'] ?? '',
            $post['name'],
            $post['price'],
            $post['des'],
            $post['stock'],
            $imgUrl,
            $post['category'],
            null
        );
    }
}
