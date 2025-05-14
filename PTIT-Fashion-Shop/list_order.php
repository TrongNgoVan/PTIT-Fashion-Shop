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
    <!-- <link rel="stylesheet" href="css/style.css" type="text/css">  -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/my.css" type="text/css">


    <link rel="icon" href="img/ptit.png" type="image/x-icon">
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

    <?php require('components/header.php'); ?>

    <style>
        .container {
            width: 80%;
            /* Điều chỉnh độ rộng của bảng */
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
        }

        th {
            background-color: #d71a0b;
            color: white;
        }

        /* Định dạng trạng thái đơn hàng */
        .Processing,
        .Confirmed,
        .Shipping,
        .Delivered,
        .Cancelled {
            display: block;
            padding: 5px;
            border-radius: 5px;
            font-weight: bold;
        }

        .Processing {
            background-color: orange;
            color: white;
        }

        .Confirmed {
            background-color: yellowgreen;
            color: white;
        }

        .Shipping {
            background-color: lightblue;
            color: black;
        }

        .Delivered {
            background-color: green;
            color: white;
        }

        .Cancelled {
            background-color: red;
            color: white;
        }
    </style>

    <div class="container" style="margin-top: 10px;">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Theo dõi các đơn hàng đã đặt</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Vận chuyển</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Xem</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require('db/conn.php');
                            $user_id = $_SESSION['user']['id']; // Lấy ID người dùng từ session
                            $sql_str = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC";
                            $result = mysqli_query($conn, $sql_str);
                            $stt = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $stt++;
                            ?>
                                <tr>
                                    <td><?= $stt ?></td>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['created_at'] ?></td>
                                    <td><?= number_format($row['total_price'], 0, ',', '.') ?> VNĐ</td>
                                    <td><?= $row['transport'] ?></td>
                                    <td><?= $row['status_pay'] ?></td>
                                    <td><span class='<?= $row['status'] ?>'><?= $row['status'] ?></span></td>
                                    <td>
                                        <a class="btn btn-warning" href="order_detail.php?id=<?= $row['id'] ?>">Xem</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php require('components/footer.php'); ?>

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