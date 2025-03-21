<?php
session_start();

if (isset($_POST['id']) && isset($_POST['qty'])) {
    $id = $_POST['id'];
    $qty = (int)$_POST['qty'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Tìm sp trong cart
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id) {
            $item['qty'] = $qty; // set qty mới
            break;
        }
    }

    echo json_encode(['status'=>'success']);
    exit;
}

echo json_encode(['status'=>'error','message'=>'Missing id or qty']);
exit;

