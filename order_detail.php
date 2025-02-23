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
        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit(); 
        }
        ?>

        <?php 
        require('components/header.php');

        ?>
        <?php


        //lay id goi edit
        $id = $_GET['id'];

        //ket noi csdl
        require('db/conn.php');

        $sql_str = "select 
        * from orders where id=$id";
        // echo $sql_str; exit;   //debug cau lenh

        $res = mysqli_query($conn, $sql_str);

        $row = mysqli_fetch_assoc($res);

       
           
        ?>

            <div class="container">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Chi tiết đơn đặt của bạn</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form class="user" method="post" action="#">
                                                <div class="row">
                                                    <div class="col-md-3">Khách hàng:</div>
                                                    <div class="col-md-9">
                                                        <?= $row['name'] ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Địa chỉ:</div>
                                                    <div class="col-md-9">
                                                        <?= $row['address'] ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Số điện thoại:</div>
                                                    <div class="col-md-9">
                                                        <?= $row['phone'] ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Email:</div>
                                                    <div class="col-md-9">
                                                        <?= $row['email'] ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">Trạng thái đơn hàng:</div>
                                                   
                                                    <div class="col-md-6">
                                                    <?= $row['status'] ?>
                                                    </div>
                                                </div>
                                                <a href="list_order.php" class="btn btn-primary">Quay lại</a>

                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Chi tiết đơn hàng</h3>
                                            <table class="table">
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Tiền</th>

                                                </tr>
                                                <?php
                                                $sql = "select *, products.name as pname, order_details.price as oprice  from products, order_details where products.id=order_details.product_id and order_id=$id";
                                                $res = mysqli_query($conn, $sql);
                                                $stt = 0;
                                                $tongtien = 0;
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    $tongtien += $row['qty'] * $row['oprice'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?= ++$stt ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['pname'] ?>
                                                        </td>
                                                        <td>
                                                            <?= number_format($row['oprice'], 0, '', '.') . " VNĐ" ?>
                                                        </td>
                                                        <td>
                                                            <?= $row['qty'] ?>
                                                        </td>
                                                        <td>
                                                            <?= number_format($row['total'], 0, '', '.') . " VNĐ" ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </table>
                                            <div class="tongtien">
                                                <h5>
                                                    Tổng tiền:
                                                    <?= number_format($tongtien, 0, '', '.') . " VNĐ" ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <?php

            require('components/footer.php');
                                            
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