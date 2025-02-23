<!-- <?php
session_start();

// Kiểm tra nếu dữ liệu được gửi đi
if (!isset($_POST['id']) ) {
    header("Location: cart.php");
    exit();
}

$idsp = $_POST['id'];
$qty = 1;

// Lấy giỏ hàng từ session (nếu có)
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];


for ($i = 0; $i < count($cart); $i++) {
    if ($cart[$i]['id'] == $idsp) {
        $cart[$i]['qty'] += $qty; // Cộng dồn số lượng
        $found = true;
        break;
    }
}

// Nếu chưa có sản phẩm trong giỏ thì thêm mới
if (!$found) {
    $cart[] = ['id' => $idsp, 'qty' => $qty];
}


// Lưu lại vào session
$_SESSION['cart'] = $cart;

// Chuyển hướng về trang chủ
header("Location: cart.php");
exit();
?> -->
