<?php
require_once ('db.php');
class CartDAO
{
    private static $instance = NULl;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new CartDAO();
        }
        return self::$instance;
    }

    public function getCartByUser($userId)
    {
        $sql = "
                select
                    c.cart_id,
                    c.total_price as cart_total,
                    c.total_quantity as cart_quantity,
                    ci.cart_item_id,
                    ci.quantity as item_quantity,
                    ci.total_price as item_total,
                    p.product_id,
                    p.product_name,
                    p.price as product_price,
                    p.product_image
                from carts c
                left join cart_items ci on ci.cart_id = c.cart_id
                left join products p on p.product_id = ci.product_id
                left join users u on u.user_id = c.user_id
                where u.user_id = :user_id;
            ";
        $db = DB::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array('user_id' => $userId));
        $item = $req->fetchAll();
        $cart = Cart::fromResultSet($item);
        return $cart;
    }

    public function addToCart($userId, $productId, $quantity, $price)
    {
        $sql = "CALL AddOrUpdateCartItem(? , ? , ? , ?)";
        $db = DB::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array($userId, $productId, $quantity, $price));
    }

    public function updateCart($productId, $quantity, $userId)
    {
        $sql = "
        update cart_items c
        set quantity    = :quantity,
            total_price = (select price * c.quantity
                           from products p
                           where p.product_id = :product_id)
        where c.product_id = :product_id
          and c.cart_id = (select cart_id
                           from carts
                           where user_id = :user_id);
        ";
        $db = DB::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array('quantity' => $quantity, 'product_id' => $productId, 'user_id' => $userId));

        // update total price and total quantity in cart
        $sql = "
        update carts c
        set total_price    = (select sum(total_price)
                              from cart_items
                              where cart_id = c.cart_id),
            total_quantity = (select sum(quantity)
                              from cart_items
                              where cart_id = c.cart_id)
        where c.user_id = :user_id;
        ";
        $req = $db->prepare($sql);
        $req->execute(array('user_id' => $userId));
    }

    public function removeFromCart($cartItemId, $cartId)
    {
        $sql = "DELETE FROM cart_items WHERE cart_item_id = :cart_item_id";
        $db = DB::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array('cart_item_id' => $cartItemId));

        // check if cart is empty
        $sql = "SELECT COUNT(1) as count FROM cart_items WHERE cart_id = :cart_id";
        $req = $db->prepare($sql);
        $req->execute(array('cart_id' => $cartId));
        $count = $req->fetch();

        if ($count['count'] == 0) {
            $sql = "DELETE FROM carts WHERE cart_id = :cart_id";
            $req = $db->prepare($sql);
            $req->execute(array('cart_id' => $cartId));
            return;
        }
        // update total price and total quantity in cart
        $sql = "
        update carts c
        set total_price    = (select sum(total_price)
                              from cart_items
                              where cart_id = c.cart_id),
            total_quantity = (select sum(quantity)
                              from cart_items
                              where cart_id = c.cart_id)
        where c.cart_id = :cart_id;
        ";
        $req = $db->prepare($sql);
        $req->execute(array('cart_id' => $cartId));
    }

    public function initCartForUser($user_id)
    {
        $sql = "
            INSERT INTO carts (user_id, total_price, total_quantity)
            VALUES (:user_id, 0, 0);
        ";
        $db = DB::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array('user_id' => $user_id));
    }
}