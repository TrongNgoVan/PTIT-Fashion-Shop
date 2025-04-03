<?php
session_start();
require_once('./db/conn.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Kiểm tra order_id có hợp lệ không
    if (!is_numeric($order_id)) {
        die("ID đơn hàng không hợp lệ.");
    }

    // Xóa chi tiết đơn hàng trước
    $stmt1 = $conn->prepare("DELETE FROM order_details WHERE order_id = ?");
    $stmt1->bind_param("i", $order_id);
    $stmt1->execute();
    $stmt1->close();

    // Xóa đơn hàng chính
    $stmt2 = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt2->bind_param("i", $order_id);
    $stmt2->execute();
    $stmt2->close();

    // Xóa session đơn hàng
    unset($_SESSION['donhang']);

    echo "<script>alert('Đơn hàng đã bị hủy!'); window.location.href = 'index.php';</script>";
}


?>
