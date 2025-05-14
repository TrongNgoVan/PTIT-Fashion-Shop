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

// 3. Xử lý upload hình ảnh (nếu có)
$imagePath = null;
if (isset($_FILES['review_image']) && $_FILES['review_image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/uploads/reviews/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $ext = pathinfo($_FILES['review_image']['name'], PATHINFO_EXTENSION);
    $newName = uniqid('rev_') . '.' . $ext;
    $target = $uploadDir . $newName;
    if (move_uploaded_file($_FILES['review_image']['tmp_name'], $target)) {
        $imagePath = 'uploads/reviews/' . $newName;
    }
}

// 4. Kiểm tra xem đã có review cho order_detail_id này chưa
$checkStmt = $conn->prepare(
    "SELECT id, image FROM reviews WHERE order_detail_id = ? LIMIT 1"
);
$checkStmt->bind_param("i", $order_detail_id);
$checkStmt->execute();
$checkStmt->store_result();
$checkStmt->bind_result($reviewId, $oldImage);
$hasReview = $checkStmt->num_rows > 0;
$checkStmt->fetch();

if ($hasReview) {
    // 4a. UPDATE review
    // Nếu upload mới, xóa file cũ
    if ($imagePath && $oldImage) {
        $oldFile = __DIR__ . '/' . $oldImage;
        if (file_exists($oldFile)) unlink($oldFile);
    }

    $updateQuery = 
        "UPDATE reviews
         SET rating = ?, comment = ?, updated_at = NOW()";
    if ($imagePath) {
        $updateQuery .= ", image = ?";
    }
    $updateQuery .= " WHERE order_detail_id = ?";

    $updateStmt = $conn->prepare($updateQuery);
    if ($imagePath) {
        $updateStmt->bind_param("issi", $rating, $comment, $imagePath, $order_detail_id);
    } else {
        $updateStmt->bind_param("isi", $rating, $comment, $order_detail_id);
    }
    $ok = $updateStmt->execute();
    $updateStmt->close();
} else {
    // 4b. INSERT review mới
    $insertStmt = $conn->prepare(
        "INSERT INTO reviews
         (order_detail_id, user_id, product_id, rating, comment, image, created_at, updated_at)
         VALUES
         (?, ?, ?, ?, ?, ?, NOW(), NOW())"
    );
    $insertStmt->bind_param(
        "iiiiss", 
        $order_detail_id, 
        $user_id, 
        $product_id, 
        $rating, 
        $comment,
        $imagePath
    );
    $ok = $insertStmt->execute();
    $insertStmt->close();

    // 5. Cập nhật status của order_details nếu insert thành công
    if ($ok) {
        $updDetail = $conn->prepare(
            "UPDATE order_details SET status = 1 WHERE id = ?"
        );
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
?>
