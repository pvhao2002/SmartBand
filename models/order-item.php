<?php
class OrderItem
{
    private $orderItemId;
    private $orderId;
    private $productId;
    private $quantity;
    private $totalPrice;
    private $product;

    public function __construct($orderItemId, $orderId, $productId, $quantity, $totalPrice, $product)
    {
        $this->orderItemId = $orderItemId;
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->totalPrice = $totalPrice;
        $this->product = $product;
    }

    public function getOrderItemId()
    {
        return $this->orderItemId;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setOrderItemId($orderItemId)
    {
        $this->orderItemId = $orderItemId;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public static function fromResultSet($resultSet)
    {
        $product = Product::fromResultSet($resultSet);
        $orderItem = new OrderItem(
            $resultSet['order_item_id'],
            $resultSet['order_id'],
            $resultSet['product_id'],
            $resultSet['item_quantity'],
            $resultSet['item_total'],
            $product
        );
        return $orderItem;
    }

}
