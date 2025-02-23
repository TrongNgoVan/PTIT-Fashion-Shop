<?php
session_start();
$idsp = $_GET['id'];
$qty = $_POST['qty'];

$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
for ($i = 0; $i < count($cart); $i++) {
    if ($cart[$i]['id'] == $idsp) {
        $cart[$i]['qty'] = $qty;
        break;
    }
}

//update session
$_SESSION['cart'] = $cart;

header("Location: cart.php");
