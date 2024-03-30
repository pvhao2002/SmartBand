<?php
class SendEmail
{
    private static $instance = NULl;

    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new SendEmail();
        }
        return self::$instance;
    }

    public function send($email, $name, $subject, $body, $attachment = null)
    {
        require 'Mail/src/Exception.php';
        require 'Mail/src/PHPMailer.php';
        require 'Mail/src/SMTP.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'hideonbush8405@gmail.com';                     //SMTP username
            $mail->Password = 'nyty qhek wqvo ehkf';                               //SMTP password
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('hideonbush8405@gmail.com', 'Smartband Shop');
            $mail->addAddress($email, $name);     //Add a recipient

            //Attachments
            if ($attachment)
                $mail->addAttachment($attachment);         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Encoding = 'base64';  // Set the encoding type
            $mail->CharSet = 'UTF-8';
            $mail->Body = $body;
            $mail->AltBody = $body;
            $mail->send();
            return true;
        } catch (PHPMailer\PHPMailer\Exception $e) {
            return false;
        }
    }

    public function getHtmlOrder($order)
    {
        $html = '<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="UTF-8">
                            <style>
                                .order-table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }
                                .order-table, .order-table th, .order-table td {
                                    border: 1px solid #ddd;
                                    padding: 8px;
                                }
                                .order-table th {
                                    padding-top: 12px;
                                    padding-bottom: 12px;
                                    text-align: left;
                                    background-color: #f2f2f2;
                                }
                            </style>
                        </head>
                    <body>
                        <h2>Chi tiết đơn hàng</h2>
                        <p>Mã đơn hàng: SMB - ' . htmlspecialchars($order->getOrderId()) . '</p>
                        <p>Người nhận: ' . htmlspecialchars($order->getReceiverName()) . '</p>
                        <p>Số điện thoại: ' . htmlspecialchars($order->getPhoneNumber()) . '</p>
                        <p>Địa chỉ giao hàng: ' . htmlspecialchars($order->getShippingAddress()) . '</p>
                        <p>Ngày mua: ' . htmlspecialchars($order->getOrderDate()) . '</p>
                        <p>Tổng tiền: ' . htmlspecialchars(number_format($order->getTotalPrice(), 0, '', ',') . ' đ') . '</p>
                        <p>Phương thức thanh toán: ' . htmlspecialchars($order->getPaymentMethod()) . '</p>
                        <p>Trạng thái đơn hàng: ' . htmlspecialchars($order->getStatus()) . '</p>

                        <h3>Danh sách sản phẩm:</h3>
                        <table class="order-table">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>';

        foreach ($order->getListOrderItems() as $item) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($item->getProduct()->getProductName()) . '</td>
                        <td>' . htmlspecialchars(number_format($item->getProduct()->getProductPrice(), 0, '', ',') . ' đ') . '</td>
                        <td>' . htmlspecialchars($item->getQuantity()) . '</td>
                        <td>' . htmlspecialchars(number_format($item->getTotalPrice(), 0, '', ',') . ' đ') . '</td>
                    </tr>';
        }
        $html .= '</table>
                    </body>
                    </html>';

        return $html;
    }


}