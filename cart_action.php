<?php
session_start();

// Nếu người dùng bấm nút “Thanh toán”
if (isset($_POST['thanhtoan'])) {
    // Lấy mảng ID sản phẩm được check
    $selected_items = $_POST['selected_items'] ?? [];
    // Lấy mảng qty
    $qty = $_POST['qty'] ?? [];

    // Giỏ gốc
    $cart = $_SESSION['cart'] ?? [];

    // Tạo mảng lưu sản phẩm thanh toán
    $thanhtoan = [];    

    // Lọc các sản phẩm được chọn
    foreach ($cart as $item) {
        if (in_array($item['id'], $selected_items)) {
            // Cập nhật số lượng mới nhất
            $newQty = isset($qty[$item['id']]) ? (int)$qty[$item['id']] : $item['qty'];
            $item['qty'] = $newQty;

            // Thêm vào mảng thanhtoan
            $thanhtoan[] = $item;
        }
    }

    // Tạo session thanhtoan
    $_SESSION['thanhtoan'] = $thanhtoan;

    // Chuyển hướng sang trang thanh toán
    header('Location: thanhtoan.php');
    exit;
}

// ... Các trường hợp khác, ví dụ xóa sản phẩm ...
// Mặc định
header('Location: cart.php');
exit;
