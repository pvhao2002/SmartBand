<?php
require_once('db.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
class OtpDAO
{
    private static $instance = NULl;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new OtpDAO();
        }
        return self::$instance;
    }

    public function generateOTP($email)
    {
        $otp = rand(100000, 999999);
        $sql = "INSERT INTO otp (otp, email) VALUES ('$otp', '$email') ON DUPLICATE KEY UPDATE otp = '$otp'";
        $db = DB::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $otp;
    }

    public function checkOtp($email, $otp)
    {
        $sql = "SELECT * FROM otp WHERE email = '$email' AND otp = '$otp'";
        $db = DB::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return "Mã OTP không đúng";
        }

        $createdAt = new DateTime($result['created_at']);
        $now = new DateTime();

        $interval = $now->diff($createdAt);

        // Quá 5 phút thì không còn hiệu lực
        $sql = "DELETE FROM otp WHERE email = '$email'";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        if ($interval->i > 5) {
            return "Mã OTP đã hết hạn. Vui lòng gửi lại mã OTP mới.";
        }
        return "OK";
    }
}