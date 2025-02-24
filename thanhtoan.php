<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PTIT Fashion Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel ="icon" href ="img/ptit.png" type="image/x-icon">
</head>
<body>

<?php
session_start();
$is_homepage = false;
$name = $phone = $email = $address = "";
$uid = 0;
$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $uid = $user['id'];
    $name = $user['name'];
    $phone = $user['phone'];
    $email = $user['email'];
    $address = $user['address'];
}
require_once('./db/conn.php');

if (isset($_POST['btDathang'])) {
    //lay thong tin khach hang tu form
    

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    //tao du lieu cho order
    
    $total_end = 0.0;
    foreach ($cart as $item) {
       
        $total_end +=  $item['qty'] * $item['disscounted_price'];
    }
    $sqli = "insert into orders values (0, $uid, '$name', '$address', '$phone', '$email', 'Processing', now(), now(),$total_end, 'Vận Chuyển Thường' , 'Thanh toán khi nhận hàng', 'Chưa thanh toán')";

    // echo $sqli;
    //exit; // mysqli_query($conn, $sqli);
    //lay id vua duoc them vao 
    if (mysqli_query($conn, $sqli)) {
        $last_order_id = mysqli_insert_id($conn);
        //sau do them vao orer detail
        foreach ($cart as $item) {
            $masp = $item['id'];
            $disscounted_price = $item['disscounted_price'];
            $qty = $item['qty'];
            $total = $item['qty'] * $item['disscounted_price'];
            $sqli2 = "insert into order_details values 
            (0, $last_order_id, $masp,  $disscounted_price, $qty, $total, now(), now())";
            // echo $sqli2, exit;
            mysqli_query($conn, $sqli2);
        }
    }

    //xoa cart
    unset($_SESSION["cart"]);
    header("Location: thankyou.php");

}


require_once('components/header.php');
?>

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <div class="checkout__form">
            <h4>Thông tin Khách hàng</h4>
            <form action="#" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                       
                            
                        <div class="checkout__input">
                                    <p>Họ & tên <span>*</span></p>
                                    <input type="text" name="name" value="<?php echo $name; ?>">
                        </div>
                            

                        <div class="checkout__input">
                            <p>Địa chỉ nhận hàng:<span>*</span></p>
                            <input type="text" placeholder="Địa chỉ" class="checkout__input__add" name="address" value="<?php echo $address; ?>">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại:<span>*</span></p>
                                    <input type="text" name="phone" value="<?php echo $phone; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email:<span>*</span></p>
                                    <input type="text" name="email" value="<?php echo $email; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                            <ul>
                                <?php
                                $cart = [];
                                if (isset($_SESSION['cart'])) {
                                    $cart = $_SESSION['cart'];
                                }
                                // var_dump($cart);die();
                                $count = 0; //số thứ tự
                                $total = 0;
                                foreach ($cart as $item) {
                                    $total += $item['qty'] * $item['disscounted_price'];
                                    ?>
                                    <li>
                                        <?= $item['name'] ?> <span>
                                            <?= number_format($item['disscounted_price'] * $item['qty'], 0, '', '.') . " VNĐ" ?>
                                        </span>
                                    </li>
                                <?php } ?>

                            </ul>
                            <div class="checkout__order__total">Tổng tiền: <span>
                                    <?= number_format($total, 0, '', '.') . " VNĐ" ?>
                                </span></div>


                            <button type="submit" class="site-btn" name="btDathang">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<!-- Footer Section Begin -->
<?php

require_once('components/footer.php');
?>

<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>