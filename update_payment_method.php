<?php
session_start();
require_once('./db/conn.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $query = "UPDATE orders SET pay='Thanh toán khi nhận hàng' WHERE order_id='$order_id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Phương thức thanh toán được cập nhật thành công!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Lỗi cập nhật phương thức thanh toán!'); window.location.href = 'index.php';</script>";
    }
}
?>
