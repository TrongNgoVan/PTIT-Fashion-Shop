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

// 3. Xác định xem đã có review cho order_detail_id này chưa
$checkStmt = $conn->prepare("
    SELECT id 
    FROM reviews 
    WHERE order_detail_id = ?
    LIMIT 1
");
$checkStmt->bind_param("i", $order_detail_id);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    // 4a. Nếu đã có: UPDATE
    $updateStmt = $conn->prepare("
        UPDATE reviews 
        SET rating      = ?,
            comment     = ?,
            updated_at  = NOW()
        WHERE order_detail_id = ?
    ");
    $updateStmt->bind_param("isi", $rating, $comment, $order_detail_id);
    $ok = $updateStmt->execute();
    $updateStmt->close();
} else {
    // 4b. Nếu chưa có: INSERT mới
    $insertStmt = $conn->prepare("
        INSERT INTO reviews
            (order_detail_id, user_id, product_id, rating, comment, created_at, updated_at)
        VALUES
            (?, ?, ?, ?, ?, NOW(), NOW())
    ");
    $insertStmt->bind_param("iiiis", 
        $order_detail_id, 
        $user_id, 
        $product_id, 
        $rating, 
        $comment
    );
    $ok = $insertStmt->execute();
    $insertStmt->close();

    // 5. Cập nhật status của order_details (chỉ khi insert mới)
    if ($ok) {
        $updDetail = $conn->prepare("
            UPDATE order_details
            SET status = 1
            WHERE id = ?
        ");
        $updDetail->bind_param("i", $order_detail_id);
        $updDetail->execute();
        $updDetail->close();
    }
}
$checkStmt->close();

// 6. Trả kết quả
if ($ok) {
    echo json_encode([
        'success'          => true,
        'order_detail_id'  => $order_detail_id,
        'product_id'       => $product_id
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => $conn->error
    ]);
}
