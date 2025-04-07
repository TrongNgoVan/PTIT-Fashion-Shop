<?php
session_start();
header('Content-Type: application/json');

// Kết nối đến cơ sở dữ liệu (đảm bảo file conn.php có chứa kết nối đúng)
require_once('./db/conn.php');

// Kiểm tra các thông tin cần thiết được gửi qua POST
if (!isset($_POST['order_id']) || !isset($_POST['type']) || !isset($_POST['amount'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Thiếu thông tin cần thiết'
    ]);
    exit();
}

$order_id = intval($_POST['order_id']);
$type = $_POST['type'];
$amount = floatval($_POST['amount']);

// Xác định trạng thái thanh toán dựa trên loại giao dịch: thừa hoặc thiếu
if ($type === 'extra') {
    $status_pay = 'Thanh toán thừa';
} elseif ($type === 'missing') {
    $status_pay = 'Thanh toán thiếu';
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Loại thanh toán không hợp lệ'
    ]);
    exit();
}

// Giả sử bảng orders có cột extra_missing_amount để lưu số tiền chênh lệch
$sql = "UPDATE orders SET status_pay = '$status_pay', tiendachuyen = $amount WHERE id = $order_id";

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
?>
