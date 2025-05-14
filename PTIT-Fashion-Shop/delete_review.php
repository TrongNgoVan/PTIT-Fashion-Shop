<?php
session_start();
require_once('./db/conn.php');

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập!']);
    exit;
}

$user_id         = (int) $_SESSION['user']['id'];
$order_detail_id = isset($_POST['order_detail_id']) ? (int) $_POST['order_detail_id'] : 0;

// Tìm review để xác nhận quyền sở hữu và lấy product_id
$stmt = $conn->prepare("SELECT id, product_id FROM reviews WHERE order_detail_id = ? AND user_id = ?");
$stmt->bind_param("ii", $order_detail_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Không tìm thấy đánh giá hoặc bạn không có quyền']);
    exit;
}

$row = $result->fetch_assoc();
$review_id = $row['id'];
$product_id = $row['product_id'];

// Xóa đánh giá
$del = $conn->prepare("DELETE FROM reviews WHERE id = ?");
$del->bind_param("i", $review_id);
$del->execute();

$upd = $conn->prepare("UPDATE order_details SET status = 0 WHERE id = ?");
if (!$upd) {
    echo json_encode(['success' => false, 'message' => 'Lỗi prepare update']);
    exit;
}
$upd->bind_param("i", $order_detail_id);
$upd->execute();

$stmt->close();
$del->close();
$upd->close();
$conn->close();

echo json_encode(['success' => true, 'product_id' => $product_id]);
?>
