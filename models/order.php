<?php
class Order
{
    private $orderId;
    private $userId;
    private $user;
    private $fullName;
    private $phone;
    private $address;
    private $orderDate;
    private $totalPrice;
    private $totalQuantity;
    private $paymentMethod;
    private $status;
    private $qrCode;
    private $listOrderItems;

    public function __construct($orderId, $userId, $user, $orderDate, $totalPrice, $totalQuantity, $paymentMethod, $status, $fullname, $phone, $address, $qrCode = null)
    {
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->user = $user;
        $this->orderDate = $orderDate;
        $this->totalPrice = $totalPrice;
        $this->totalQuantity = $totalQuantity;
        $this->paymentMethod = $paymentMethod;
        $this->status = $status;
        $this->qrCode = $qrCode;
        $this->listOrderItems = [];
        $this->fullName = $fullname;
        $this->phone = $phone;
        $this->address = $address;
    }

    public function getListOrderItems()
    {
        return $this->listOrderItems;
    }

    public function setListOrderItems($listOrderItems)
    {
        $this->listOrderItems = $listOrderItems;
    }

    public function getQrCode()
    {
        return $this->qrCode;
    }

    public function setQrCode($qrCode)
    {
        $this->qrCode = $qrCode;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getOrderDate()
    {
        return $this->orderDate;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function getTotalQuantity()
    {
        return $this->totalQuantity;
    }

    public function getPaymentMethod()
    {
        switch ($this->paymentMethod) {
            case 'VN_PAY':
                return 'VNPay';
            case 'COD':
                return 'Thanh toán khi nhận hàng';
            default:
                return 'Chưa xác định';
        }
    }

    public function getPaymentMethodValue()
    {
        return $this->paymentMethod;
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 'processing':
                return 'Đang chuẩn bị hàng';
            case 'completed':
                return 'Đơn hàng đang được giao đến bạn. Vui lòng kiểm tra điện thoại để nhận cuộc gọi từ nhân viên giao hàng. Xin cảm ơn!';
            case 'cancelled':
                return 'Đã hủy';
            case 'refunded':
                return 'Đã hoàn tiền';
            case 'done':
                return 'Đã nhận hàng';
            default:
                return 'Đang chờ xác nhận';
        }
    }

    public function getStatusValue()
    {
        return $this->status;
    }

    public function getReceiverName()
    {
        return $this->fullName;
    }

    public function getPhoneNumber()
    {
        return $this->phone;
    }

    public function getShippingAddress()
    {
        return $this->address;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function setTotalQuantity($totalQuantity)
    {
        $this->totalQuantity = $totalQuantity;
    }

    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    // lấy thông tin của order và order item
    public static function fromResultSet($resultSet)
    {
        $order = new Order(
            $resultSet[0]['order_id'],
            $resultSet[0]['user_id'],
            new User(null, $resultSet[0]['email'], null, $resultSet[0]['full_name'], null, null),
            $resultSet[0]['created_at'],
            $resultSet[0]['order_total'],
            $resultSet[0]['order_quantity'],
            $resultSet[0]['payment_method'],
            $resultSet[0]['status'],
            $resultSet[0]['receiver_name'],
            $resultSet[0]['phone_number'],
            $resultSet[0]['shipping_address'],
            $resultSet[0]['qr_code']
        );

        // loop through the result set and create the list of cart items
        $listOrderItemTemp = [];
        foreach ($resultSet as $item) {
            $orderItemTemp = OrderItem::fromResultSet($item);
            $listOrderItemTemp[] = $orderItemTemp;
        }
        $order->setListOrderItems($listOrderItemTemp);
        return $order;
    }

    // chỉ lấy thông tin của order, không lấy thông tin của order item
    public static function fromResultSetV2($resultSet)
    {
        $order = new Order(
            $resultSet['order_id'],
            null,
            new User(null, $resultSet['email'], null, $resultSet['full_name'], null, null),
            $resultSet['created_at'],
            $resultSet['total_price'],
            $resultSet['total_quantity'],
            $resultSet['payment_method'],
            $resultSet['status'],
            $resultSet['receiver_name'],
            $resultSet['phone_number'],
            $resultSet['shipping_address'],
            $resultSet['qr_code']
        );
        return $order;
    }
}
