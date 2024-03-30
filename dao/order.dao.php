<?php
require_once ('db.php');
class OrderDAO
{
    private static $instance = NULl;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new OrderDAO();
        }
        return self::$instance;
    }

    public function createOrder($userId, $method, $fullName, $address, $phone)
    {
        $sql = "CALL CreateOrder(?, ?, ?, ?, ?)";
        $db = DB::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array($userId, $method, $fullName, $address, $phone));
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $orderId = $result ? $result['order_id'] : null;
        return $orderId;
    }

    public function updateQrCode($orderId, $fileQrCode)
    {
        $sql = "UPDATE orders SET qr_code = ? WHERE order_id = ?";
        $db = DB::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array($fileQrCode, $orderId));
    }

    public function getOrders($userId)
    {
        $sql = "
                    select o.order_id,
                    u.email,
                    u.full_name,
                    o.full_name as receiver_name,
                    o.phone_number,
                    o.shipping_address,
                    o.total_price,
                    o.total_quantity,
                    o.payment_method,
                    o.status,
                    o.qr_code,
                    o.created_at
            from orders o
            inner join users u on o.user_id = u.user_id
            where o.user_id = :user_id
            order by o.created_at desc;
        ";
        $db = DB::getInstance();
        $req = $db->prepare($sql); // Sử dụng prepare thay vì query
        $req->execute([':user_id' => $userId]);
        $list = [];
        foreach ($req->fetchAll() as $item) {
            $list[] = Order::fromResultSetV2($item);
        }
        return $list;
    }

    public function getOrderById($orderId)
    {
        $sql = "
                select
                    o.order_id,
                    o.user_id,
                    u.email,
                    u.full_name,
                    o.full_name as receiver_name,
                    o.phone_number,
                    o.shipping_address,
                    o.created_at,
                    o.total_price as order_total,
                    o.total_quantity as order_quantity,
                    o.payment_method,
                    o.status,
                    o.qr_code,
                    oi.order_item_id,
                    oi.quantity as item_quantity,
                    oi.total_price as item_total,
                    p.product_id,
                    p.product_name,
                    p.price,
                    p.product_image
                from orders o
                left join order_items oi on oi.order_id = o.order_id
                left join products p on p.product_id = oi.product_id
                left join users u on u.user_id = o.user_id
                where o.order_id = :order_id;
        ";
        $db = DB::getInstance();
        $req = $db->prepare($sql);
        $req->execute([':order_id' => $orderId]);
        $result = $req->fetchAll();
        return $result ? Order::fromResultSet($result) : null;
    }

    public function getAll()
    {
        $sql = "
                select o.order_id,
                        u.email,
                        u.full_name,
                        o.full_name as receiver_name,
                        o.phone_number,
                        o.shipping_address,
                        o.total_price,
                        o.total_quantity,
                        o.payment_method,
                        o.status,
                        o.qr_code,
                        o.created_at
                from orders o
                inner join users u on o.user_id = u.user_id
                order by o.created_at desc;
        ";
        $db = DB::getInstance();
        $req = $db->query($sql);
        $list = [];
        foreach ($req->fetchAll() as $item) {
            $list[] = Order::fromResultSetV2($item);
        }
        return $list;
    }

    public function updateStatusOrder($sql)
    {
        $db = DB::getInstance();
        $req = $db->prepare($sql);
        $req->execute();
    }
}