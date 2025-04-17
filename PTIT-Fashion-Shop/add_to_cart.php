<?php
session_start();
require_once('db/conn.php');

// Kiểm tra tham số pid và qty
if (isset($_POST['pid']) && isset($_POST['qty'])) {
    $id = $_POST['pid'];
    $qty = (int)$_POST['qty']; // ép kiểu sang int
    if ($qty < 1) $qty = 1;

    // Lấy giỏ hàng hiện tại
    $cart = $_SESSION['cart'] ?? [];

    $isFound = false;
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            // Nếu tìm thấy sp này => cộng dồn số lượng
            $cart[$i]['qty'] += $qty;
            $isFound = true;
            break;
        }
    }

    // Nếu chưa có sp này => lấy từ DB
    if (!$isFound) {
        $sql_str = "SELECT * FROM products WHERE id = $id";
        $result = mysqli_query($conn, $sql_str);
        $product = mysqli_fetch_assoc($result);

        // Gán thêm trường qty
        $product['qty'] = $qty; 
        $cart[] = $product;
    }

    // Cập nhật session
    $_SESSION['cart'] = $cart;

    // Tính lại tổng số lượng sản phẩm
    $cartCount = 0;
    foreach ($cart as $p) {
        $cartCount += 1;
    }

    // Trả về JSON
    echo json_encode([
        'status'    => 'success',
        'cartCount' => $cartCount
    ]);
    exit;
}

// Nếu thiếu param => báo lỗi
echo json_encode([
    'status'  => 'error',
    'message' => 'Missing pid or qty'
]);
exit;
