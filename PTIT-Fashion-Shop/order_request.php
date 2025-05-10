<?php 
session_start();
require('db/conn.php');

$order_id = intval($_POST['order_id']);
$type     = $_POST['type']; // cancel|return|exchange
$reason   = mysqli_real_escape_string($conn, $_POST['reason']);
$imagePath = null;

// 0. Xử lý upload hình ảnh (nếu có)
if (isset($_FILES['request_image']) && $_FILES['request_image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/uploads/requests/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ext = pathinfo($_FILES['request_image']['name'], PATHINFO_EXTENSION);
    $newName = uniqid('req_') . '.' . $ext;
    $fullPath = $uploadDir . $newName;

    if (move_uploaded_file($_FILES['request_image']['tmp_name'], $fullPath)) {
        $imagePath = 'uploads/requests/' . $newName; // Lưu đường dẫn tương đối để dùng trong web
    }
}

// 1. Lấy trạng thái hiện tại và ngày tạo
$res = mysqli_query($conn, 
    "SELECT status, created_at 
     FROM orders 
     WHERE id = $order_id"
);
if (!$res || mysqli_num_rows($res) === 0) {
    echo json_encode([
        'success' => false, 
        'message' => 'Đơn hàng không tồn tại.'
    ]);
    exit;
}
$row = mysqli_fetch_assoc($res);
$current_status = $row['status'];
$created_at     = $row['created_at'];

// 2. Nếu là yêu cầu hủy, và đang ở Processing → hủy ngay
if ($type === 'cancel' && $current_status === 'Processing') {
    $upd = mysqli_query($conn,
        "UPDATE orders
         SET status = 'Cancelled'
         WHERE id = $order_id"
    );
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

// 3. Nếu là yêu cầu return/exchange → kiểm tra số ngày
if (in_array($type, ['return', 'exchange'])) {
    $now = new DateTime();
    $created = new DateTime($created_at);
    $interval = $created->diff($now)->days;

    if ($interval > 15) {
        echo json_encode([
            'success' => false,
            'message' => 'Đơn hàng đã quá 15 ngày kể từ khi nhận hàng, không thể đổi hàng.'
        ]);
        exit;
    } elseif ($interval > 10 && $type === 'return') {
        echo json_encode([
            'success' => false,
            'message' => 'Đơn hàng đã quá 10 ngày kể từ khi nhận hàng, không thể yêu cầu trả hàng.'
        ]);
        exit;
    }
}

// 4. Ghi vào bảng order_requests
$image_sql = $imagePath ? "'" . mysqli_real_escape_string($conn, $imagePath) . "'" : "NULL";
$sql = "
    INSERT INTO order_requests
    (order_id, type, reason, image)
    VALUES
    ($order_id, '$type', '$reason', $image_sql)
";

if (mysqli_query($conn, $sql)) {
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

mysqli_close($conn);
?>
