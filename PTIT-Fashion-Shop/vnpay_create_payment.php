<?php
require_once("config_vnpay.php"); // chứa thông tin merchant

$vnp_TxnRef = rand(10000,99999); // Mã đơn hàng
$vnp_OrderInfo = "Thanh toán đơn hàng qua VNPay";
$vnp_OrderType = "billpayment";
$vnp_Amount = 100000 * 100; // Số tiền (VND x 100)
$vnp_Locale = "vn";
$vnp_BankCode = "";
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
$vnp_Returnurl = "http://localhost/PTIT_SHOP/PTIT-Fashion-Shop/vnpay_return.php";

// Build URL
$vnp_Url = $vnp_UrlBase . "?";
$vnp_Hashdata = http_build_query([
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef
]);

$vnp_SecureHash = hash_hmac('sha512', urldecode($vnp_Hashdata), $vnp_HashSecret);
$vnp_Url .= $vnp_Hashdata . '&vnp_SecureHash=' . $vnp_SecureHash;

header('Location: ' . $vnp_Url);
exit();
?>
