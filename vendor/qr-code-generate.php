<?php
class QRCodeGenerate
{
    private static $instance = NULl;

    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new QRCodeGenerate();
        }
        return self::$instance;
    }

    public function generate($orderId)
    {
        require_once 'phpqrcode/qrlib.php';
        $path = 'qr-image/';
        if (!is_dir($path)) {
            mkdir($path);
        }
        $file = $path . date("Y-m-d-h-i-s") . '.png';
        $text = "http://smartband.test.com/SmartBand/views/client/index.php?page=order-detail&oid=$orderId";
        QRcode::png($text, $file, 'H', 2, 2);
        return $file;
    }
}