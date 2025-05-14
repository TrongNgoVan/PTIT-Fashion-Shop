<?php
require('conn.php');

// Xử lý cập nhật trạng thái cho các yêu cầu
if (isset($_POST['btnReqUpdate']) && !empty($_POST['status'])) {
    foreach ($_POST['status'] as $rqId => $newStatus) {
        $rqId      = intval($rqId);
        $newStatus = mysqli_real_escape_string($conn, $newStatus);
        $sql = "UPDATE order_requests
                SET status = '$newStatus',
                    updated_at = NOW()
                WHERE id = $rqId";
        mysqli_query($conn, $sql);
    }
}

// Quay lại trang xem đơn hàng
$orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
header('Location: vieworders.php?id=' . $orderId);
exit;

