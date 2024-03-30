<?php
class Cart
{
    private $cartId;
    private $userId;
    private $user;
    private $totalPrice;
    private $totalQuantity;
    private $listCartItems;

    public function __construct($cartId, $totalPrice, $totalQuantity, $userId, $user, $listCart = [])
    {
        $this->cartId = $cartId;
        $this->userId = $userId;
        $this->user = $user;
        $this->totalPrice = $totalPrice;
        $this->totalQuantity = $totalQuantity;
        $this->listCartItems = $listCart;
    }

    public static function initCart() {
        return new Cart(null, 0, 0, null, null);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getListCartItems()
    {
        return $this->listCartItems;
    }

    public function setListCartItems($listCartItems)
    {
        $this->listCartItems = $listCartItems;
    }

    public function getCartId()
    {
        return $this->cartId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getTotalQuantity()
    {
        return $this->totalQuantity;
    }

    public function setCartId($cartId)
    {
        $this->cartId = $cartId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function setTotalQuantity($totalQuantity)
    {
        $this->totalQuantity = $totalQuantity;
    }

    public static function fromResultSet($resultSet)
    {
        if (!$resultSet) {
            return new Cart(null, 0, 0, null, null);
        }
        $cart = new Cart(
            $resultSet[0]['cart_id'],
            $resultSet[0]['cart_total'],
            $resultSet[0]['cart_quantity'],
            null,
            null
        );
        if ($cart->getTotalQuantity() == 0) {
            return $cart;
        }
        // loop through the result set and create the list of cart items
        $listTempCartItem = [];
        foreach ($resultSet as $item) {
            $product = new Product(
                $item['product_id'],
                $item['product_name'],
                $item['product_price'],
                null,
                null,
                $item['product_image'],
                null,
                null
            );
            $cartItem = new CartItem(
                $item['cart_item_id'],
                $item['cart_id'],
                $item['product_id'],
                $item['item_quantity'],
                $item['item_total'],
                $product
            );
            $listTempCartItem[] = $cartItem;
        }
        $cart->setListCartItems($listTempCartItem);
        return $cart;
    }

}
