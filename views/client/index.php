<?php
session_start();
ob_start();
require_once '../../autoload.php';

$page = $_GET['page'] ?? '';
switch ($page) {
    case 'order-detail':
        if (isset($_GET['oid'])) {
            $orderId = $_GET['oid'];
            $order = OrderDAO::getInstance()->getOrderById($orderId);
        }
        break;
    case 'thank-you':
        if (!isset($_SESSION['user']) || !$_SESSION['user']) {
            header('Location: login.php');
            die();
        }
        if ($_SESSION['payment'] === 'VN_PAY') {
            $_SESSION['payment'] = null;
            if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] === '00') {
                $userId = $_SESSION['user']['user_id'];
                $info = $_SESSION['info'];
                $orderId = OrderDAO::getInstance()->createOrder($userId, 'VN_PAY', $info['fullname'], $info['address'], $info['phone']);
                $fileQrCode = QRCodeGenerate::getInstance()->generate($orderId);
                OrderDAO::getInstance()->updateQrCode($orderId, $fileQrCode);
                $orderResult = OrderDAO::getInstance()->getOrderById($orderId);
                $htmlOrder = SendEmail::getInstance()->getHtmlOrder($orderResult);
                $email = $_SESSION['user']['email'];
                $subject = 'SmartBand - Đơn hàng mới';
                SendEmail::getInstance()->send($email, $_SESSION['user']['full_name'], $subject, $htmlOrder, $fileQrCode);
                echo '<script>
                    alert("Đặt hàng thành công");
                    window.location.href = "index.php?page=thank-you";
                </script>';
            } else {
                echo '<script>
                    alert("Đặt hàng thất bại");
                    window.location.href = "index.php?page=cart";
                </script>';
            }
        }
        break;
    case 'profile':
        if (!isset($_SESSION['user']) || !$_SESSION['user']) {
            header('Location: login.php');
            die();
        }
        break;
    case 'otp-resend':
        $email = $_SESSION['email'];
        $otp = OtpDAO::getInstance()->generateOTP($email);
        SendEmail::getInstance()->send($email, $fullName, 'Xác nhận đăng ký', "Mã OTP của bạn là: $otp. Mã OTP sẽ hết hạn sau 5 phút.");
        header('Location: otp.php');
        break;
    case 'otp':
        if (isset($_POST['otp-confirm']) && $_POST['otp-confirm']) {
            $otp = $_POST['otp'];
            $email = $_SESSION['email'];
            $result = OtpDAO::getInstance()->checkOtp($email, $otp);
            if ($result === 'OK') {
                $sql = "UPDATE users SET status = 'active' WHERE email = '$email'";
                UserDAO::getInstance()->register($sql);
                $_SESSION['email'] = null;
                header('Location: login.php');
                die();
            }
            $_SESSION['error'] = $result;
            header('Location: otp.php');
            die();
        }
        break;

    case 'logout':
        $_SESSION['user'] = null;
        header('Location: login.php');
        break;
    case 'register':
        if (isset($_POST['register']) && $_POST['register']) {
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm-password'];
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = 'Mật khẩu không khớp';
                header('Location: register.php');
                die();
            }
            $user = UserDAO::getInstance()->checkEmailExist($email);
            if ($user) {
                $_SESSION['error'] = 'Email đã tồn tại';
                header('Location: register.php');
                die();
            }
            $sql = "INSERT INTO users (full_name, email, password) VALUES ('$fullName', '$email', '$password')";
            $uid = UserDAO::getInstance()->register($sql);
            CartDAO::getInstance()->initCartForUser($uid);
            $_SESSION['email'] = $email;
            $otp = OtpDAO::getInstance()->generateOTP($email);
            SendEmail::getInstance()->send($email, $fullName, 'Xác nhận đăng ký', "Mã OTP của bạn là: $otp. Mã OTP sẽ hết hạn sau 5 phút.");
            header('Location: otp.php');
            die();
        }
        header('Location: register.php');
        break;
    case 'login':
        if (isset($_POST['login']) && $_POST['login']) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = UserDAO::getInstance()->checkEmailExist($email);
            if (!$user) {
                $_SESSION['error'] = 'Email không tồn tại';
                header('Location: login.php');
                die();
            }
            if ($user['password'] !== $password) {
                $_SESSION['error'] = 'Mật khẩu không đúng';
                header('Location: login.php');
                die();
            } else if ($user['status'] === 'block') {
                $_SESSION['error'] = 'Tài khoản của bạn đã bị khóa';
                header('Location: login.php');
                die();
            }
            if ($user['status'] === 'inactive') {
                $_SESSION['email'] = $email;
                $otp = OtpDAO::getInstance()->generateOTP($email);
                SendEmail::getInstance()->send($email, $fullName, 'Xác nhận đăng ký', "Mã OTP của bạn là: $otp. Mã OTP sẽ hết hạn sau 5 phút.");
                header('Location: otp.php');
                die();
            }
            $_SESSION['user'] = $user;
            header('Location: /SmartBand/views/' . ($user['role'] === 'admin' ? 'admin' : 'client') . '/index.php');
            die();
        }
        header('Location: login.php');
        break;
    case 'cart':
        if (!isset($_SESSION['user']) || !$_SESSION['user']) {
            header('Location: login.php');
            die();
        }
        if (isset($_GET['act'])) {
            if ($_GET['act'] === 'add') {
                $productId = $_POST['pid'];
                $userId = $_SESSION['user']['user_id'];
                $quantity = $_POST['quantity'] ?? 1;
                $price = $_POST['price'];
                CartDAO::getInstance()->addToCart($userId, $productId, $quantity, $price);
                header('Location: index.php?page=cart');
            } else if ($_GET['act'] === 'remove') {
                $cartItemId = $_GET['cid'];
                $cartId = $_GET['ci'];
                if ($cartItemId && $cartId) {
                    CartDAO::getInstance()->removeFromCart($cartItemId, $cartId);
                }
                header('Location: index.php?page=cart');
            } else if ($_GET['act'] === 'update') {
                $productId = $_POST['pid'];
                $userId = $_SESSION['user']['user_id'];
                $quantity = $_POST['quantity'] ?? 1;
                CartDAO::getInstance()->updateCart($productId, $quantity, $userId);
                $response = [
                    'quantity' => $quantity,
                    'productId' => $productId,
                    'userId' => $userId
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            } else if ($_GET['act'] === 'checkout') {
                $paymentMethod = $_POST['payment'];
                $userId = $_SESSION['user']['user_id'];
                $_SESSION['payment'] = $paymentMethod;
                $fullName = $_POST['fullname'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $_SESSION['info'] = [
                    'fullname' => $fullName,
                    'phone' => $phone,
                    'address' => $address
                ];
                if ($paymentMethod === 'VN_PAY') {
                    $cart = CartDAO::getInstance()->getCartByUser($userId);
                    $vnp_TxnRef = rand(1, 10000); //Mã giao dịch thanh toán tham chiếu của merchant
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán
                    $inputData = array(
                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $cart->getTotalPrice() * 100,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => "vn",
                        "vnp_OrderInfo" => "Thanh toan GD: $vnp_TxnRef",
                        "vnp_OrderType" => "other",
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef,
                        "vnp_ExpireDate" => $expire,
                        "vnp_BankCode" => "NCB"
                    );
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        } else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }

                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    }
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    $orderId = OrderDAO::getInstance()->createOrder($userId, 'CASH', $fullName, $address, $phone);
                    $fileQrCode = QRCodeGenerate::getInstance()->generate($orderId);
                    OrderDAO::getInstance()->updateQrCode($orderId, $fileQrCode);
                    $orderResult = OrderDAO::getInstance()->getOrderById($orderId);
                    $htmlOrder = SendEmail::getInstance()->getHtmlOrder($orderResult);
                    $email = $_SESSION['user']['email'];
                    $subject = 'SmartBand - Đơn hàng mới';
                    SendEmail::getInstance()->send($email, $_SESSION['user']['full_name'], $subject, $htmlOrder, $fileQrCode);
                    echo '<script>
                        alert("Đặt hàng thành công");
                        window.location.href = "index.php?page=thank-you";
                    </script>';
                }
            }
        }
        break;
    default:

        break;
}
include 'home.php';