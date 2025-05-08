<?php
session_start();
require_once('./db/conn.php');

// 1. Kiểm tra đăng nhập
if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập!']);
    exit;
}

// 2. Lấy dữ liệu từ POST
$user_id         = (int) $_SESSION['user']['id'];
$order_detail_id = isset($_POST['order_detail_id']) ? (int) $_POST['order_detail_id'] : 0;
$product_id      = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
$rating          = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;
$comment         = isset($_POST['comment']) ? trim($_POST['comment']) : '';

// 3. Chèn review với comment trước rating
$stmt = $conn->prepare(
    "INSERT INTO reviews (user_id, product_id, comment, rating, created_at)
     VALUES (?, ?, ?, ?, NOW())"
);
// bind_param: user_id(int), product_id(int), comment(string), rating(int)
$stmt->bind_param("iisi", $user_id, $product_id, $comment, $rating);
if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
    exit;
}

// 4. Cập nhật status của order_details
$updDetail = $conn->prepare(
    "UPDATE order_details
     SET status = 1
     WHERE id = ?"
);
$updDetail->bind_param("i", $order_detail_id);
$updDetail->execute();

// 5. Trả kết quả (bao gồm order_detail_id)
echo json_encode([
    'success'          => true,
    'order_detail_id'  => $order_detail_id,
    'product_id'       => $product_id
]);
?>