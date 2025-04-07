<?php
session_start();
require_once('./db/conn.php');

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập!']);
    exit;
}

$user_id = $_SESSION['user']['id'];
$product_id = $_POST['product_id'];
$rating = $_POST['rating'];
$comment = mysqli_real_escape_string($conn, $_POST['comment']);

$sql = "INSERT INTO reviews (user_id, product_id, rating, comment, created_at)
        VALUES ('$user_id', '$product_id', '$rating', '$comment', NOW())";

if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
}
?>
