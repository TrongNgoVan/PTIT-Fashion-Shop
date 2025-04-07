<?php
session_start();
header('Content-Type: application/json');

// Kết nối đến cơ sở dữ liệu (đảm bảo file conn.php có chứa kết nối đúng)
require_once('./db/conn.php');

// Kiểm tra xem order_id có được gửi qua POST không
if (!isset($_POST['order_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Thiếu thông tin order_id'
    ]);
    exit();
}

$order_id = intval($_POST['order_id']);
$amount = floatval($_POST['amount']);

$sql = "UPDATE orders SET status_pay = 'Đã thanh toán', tiendachuyen = $amount WHERE id = $order_id";

if (mysqli_query($conn, $sql)) {
    echo json_encode([
        'success' => true,
        'message' => 'Trạng thái thanh toán đã được cập nhật'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Lỗi cập nhật: ' . mysqli_error($conn)
    ]);
}