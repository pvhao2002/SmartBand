<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$vnp_TmnCode = "GLE8YXG4";
$vnp_HashSecret = "ZCVPMHAELZKRPGTFLWJDPLQVPHBWEKXG";
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://smartband.test.com/SmartBand/views/client/index.php?page=thank-you";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));