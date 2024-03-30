<?php
class CartItem
{
    private $cartItemId;
    private $cartId;
    private $productId;
    private $quantity;
    private $totalPrice;
    private $product;

    public function __construct($cartItemId, $cartId, $productId, $quantity, $totalPrice, $product = null)
    {
        $this->cartItemId = $cartItemId;
        $this->cartId = $cartId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->totalPrice = $totalPrice;
        $this->product = $product;
    }
    public function getProduct()
    {
        return $this->product;
    }
    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getCartItemId()
    {
        return $this->cartItemId;
    }

    public function getCartId()
    {
        return $this->cartId;
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

    public function setCartItemId($cartItemId)
    {
        $this->cartItemId = $cartItemId;
    }

    public function setCartId($cartId)
    {
        $this->cartId = $cartId;
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

    public static function fromResultSet($resultSet)
    {
        $cartItem = new CartItem(
            $resultSet['cart_item_id'],
            $resultSet['cart_id'],
            $resultSet['product_id'],
            $resultSet['quantity'],
            $resultSet['total_price']
        );
        return $cartItem;
    }


}
