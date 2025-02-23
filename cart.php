
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
<style>
#header {
   padding-top: 10px;
   padding-bottom: 10px;
}
</style>

<body>
<?php
session_start();
$is_homepage = false;

require_once('./db/conn.php');



require_once('components/header.php');
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giỏ hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Giỏ hàng</h4>
            <!-- <form action="#"> -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="checkout__order">
                        <h4>Your Order</h4>
                        <div class="checkout__order__products">
                            Products <span>Total</span>
                        </div>
                        <table class="table">
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </tr>
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
                                <form action="updatecart.php?id=<?= $item['id'] ?>" method="post">

                                    <tr>
                                        <td>
                                            <?= ++$count ?>
                                        </td>
                                        <td>
                                            <?= $item['name'] ?>
                                        </td>
                                        <td>
                                            <?= number_format($item['disscounted_price'], 0, '', '.') . " VNĐ" ?>
                                        </td>
                                        <td><input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" /></td>
                                        <td>
                                            <?= number_format($item['disscounted_price'] * $item['qty'], 0, '', '.') . " VNĐ" ?>
                                        </td>
                                        <td><button class="btn btn-warning">Cập nhật</button></td>
                                        <td><a href='./deletecart.php?id=<?= $item['id'] ?>' class="btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                </form>

                                <?php
                            }
                            ?>


                        </table>
                        <!-- <div class="checkout__order__subtotal">
                  Subtotal <span>$750.99</span>
                </div> -->
                        <div class="checkout__order__total">
                            Tổng tiền: <span>
                                <?= number_format($total, 0, '', '.') . " VNĐ" ?>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="shop.php" class="btn btn-primary">Tiếp tục mua sắm</a>
                            <a href="thanhtoan.php" class="btn btn-success">
                                Thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
</section>
<!-- Checkout Section End -->

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