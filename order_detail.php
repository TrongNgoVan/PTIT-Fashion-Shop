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

        <div class="container mt-4">
            <div class="card shadow-lg border-0">
                <div class="card-body">

                    <div class="row">
                        <!-- Thông tin khách hàng -->
                        <div class="col-md-4">
                            <div class="card p-4 border-0 shadow-sm">
                                <h5 class="mb-3">Thông tin khách hàng</h5>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold">Họ Tên:</div>
                                    <div class="col-8"><?= $row['name'] ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold">Địa chỉ:</div>
                                    <div class="col-8"><?= $row['address'] ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold">Phone:</div>
                                    <div class="col-8"><?= $row['phone'] ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 fw-bold">Email:</div>
                                    <div class="col-8"><?= $row['email'] ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6 fw-bold">Trạng thái đơn:</div>
                                    <div class="col-6">
                                        <span class="badge bg-<?= ($row['status'] == 'Confirmed' ? 'success' : 'danger') ?>">
                                            <?= $row['status'] ?>
                                        </span>
                                    </div>
                                </div>
                                <a href="list_order.php" class="btn btn-danger px-4">Quay lại</a>
                            </div>
                        </div>

                        <!-- Chi tiết đơn hàng -->
                        <div class="col-md-8">
                            <div class="card p-4 border-0 shadow-sm">
                                <h5 class="mb-3">Chi tiết đơn hàng</h5>
                                <table class="table table-bordered">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>STT</th>
                                            <th></th>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT *, products.name AS pname, order_details.price AS oprice  
                                                FROM products, order_details 
                                                WHERE products.id = order_details.product_id 
                                                AND order_id = $id";
                                        $res = mysqli_query($conn, $sql);
                                        $stt = 0;
                                        $tongtien = 0;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $tongtien += $row['qty'] * $row['oprice'];
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= ++$stt ?></td>
                                                <td>
                                                    <img src="quantri/<?=$row['images'] ?>" style="max-width: 100px;">
                                                    
                                                </td>
                                                <td><?= $row['pname'] ?></td>
                                                <td class="text-end"><?= number_format($row['oprice'], 0, '', '.') ?> VNĐ</td>
                                                <td class="text-center"><?= $row['qty'] ?></td>
                                                <td class="text-end"><?= number_format($row['total'], 0, '', '.') ?> VNĐ</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="text-end mt-3">
                                    <h5 class="fw-bold">Tổng tiền: <?= number_format($tongtien, 0, '', '.') ?> VNĐ</h5>
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