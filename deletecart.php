<?php
session_start();
$idsp = $_GET['id'];

$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
for ($i = 0; $i < count($cart); $i++) {
    if ($cart[$i]['id'] == $idsp) {
        array_splice($cart, $i, 1);
        break;
    }
}

//update session
$_SESSION['cart'] = $cart;

header("Location: cart.php");
