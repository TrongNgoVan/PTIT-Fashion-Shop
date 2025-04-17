<?php
session_start();
if (!empty($_POST['ids']) && isset($_SESSION['cart'])) {
    $ids = $_POST['ids']; // mảng ID
    // Xóa khỏi session
    foreach ($ids as $idToDelete) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $idToDelete) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
    // Sắp xếp lại mảng
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    $cart = $_SESSION['cart'] ;

    $cartCount = 0;
    foreach ($cart as $p) {
        $cartCount += 1;
    }

    // Trả về JSON
    echo json_encode(['status' => 'success'
        , 'cartCount' => $cartCount

    ]);
    exit;
}

// Nếu không có 'ids' hoặc giỏ rỗng => báo lỗi
echo json_encode(['status' => 'error', 'message' => 'No ids or no cart']);
exit;
