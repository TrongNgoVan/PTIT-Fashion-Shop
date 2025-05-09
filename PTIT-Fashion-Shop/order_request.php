<?php
session_start();
require('db/conn.php');

$order_id = intval($_POST['order_id']);
$type     = $_POST['type'];            // cancel|return|exchange
$reason   = mysqli_real_escape_string($conn, $_POST['reason']);

// 1. Lấy trạng thái hiện tại của đơn
$res = mysqli_query($conn, 
    "SELECT status 
     FROM orders 
     WHERE id = $order_id
    ");
if (!$res || mysqli_num_rows($res) === 0) {
    echo json_encode([
      'success' => false, 
      'message' => 'Đơn hàng không tồn tại.'
    ]);
    exit;
}
$row = mysqli_fetch_assoc($res);
$current_status = $row['status'];

// 2. Nếu là yêu cầu hủy, và đang ở Processing → hủy ngay
if ($type === 'cancel' && $current_status === 'Processing') {
    $upd = mysqli_query($conn,
        "UPDATE orders
         SET status = 'Cancelled'
         WHERE id = $order_id
        ");
    if ($upd) {
        echo json_encode([
          'success' => true,
          'message' => 'Đơn hàng đã được hủy thành công.'
        ]);
    } else {
        echo json_encode([
          'success' => false,
          'message' => 'Lỗi khi hủy đơn, vui lòng thử lại.'
        ]);
    }
    exit;
}

// 3. Các trường hợp khác (return, exchange, hoặc cancel khi ko phải Processing)
//    → Ghi vào bảng order_requests để chờ xử lý
$sql = "INSERT INTO order_requests
        (order_id, type, reason)
        VALUES
        ($order_id, '$type', '$reason')";
if (mysqli_query($conn, $sql)) {
    // Cập nhật cờ để admin biết có yêu cầu mới
    mysqli_query($conn, "
      UPDATE orders
      SET request_status = 'pending'
      WHERE id = $order_id
    ");
    echo json_encode([
      'success' => true,
      'message' => 'Yêu cầu của bạn đã được gửi, vui lòng chờ xử lý.'
    ]);
} else {
    echo json_encode([
      'success' => false,
      'message' => 'Lỗi hệ thống, vui lòng thử lại sau.'
    ]);
}
