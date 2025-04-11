



<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin nhận hàng</title>

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
    <link rel="stylesheet" href="css/my.css" type="text/css">
    <link rel="stylesheet" href="css/shop.css" type="text/css">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">
    
</head>
<body>

<?php
session_start();
// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$is_homepage = false;
require_once('components/header.php');



require_once('db/conn.php');

// Lấy id người dùng từ session
$id_user = $_SESSION['user']['id'];

// Truy vấn lấy danh sách thông tin nhận hàng của người dùng
$sql = "SELECT * FROM thongtinnhanhang WHERE id_user = $id_user";
$result = mysqli_query($conn, $sql);
?>


    <div class="container mt-4">
        <h2>Thông Tin Nhận Hàng Của Tôi</h2>
        
        <!-- Nút thêm thông tin nhận hàng -->
        <div class="mb-3">
        <a href="add_thongtinnhanhang.php"
                            class="btn btn-success"
                            target="_blank"
                            onclick="openAddressForm(event)">
                            <i class="fa fa-plus"></i> Thêm thông tin mới
                        </a>
        </div>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Người Nhận</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th>Xã/Phường</th>
                        <th>Huyện/Quận</th>
                        <th>Tỉnh/Thành Phố</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $stt = 1;
                    while ($row = mysqli_fetch_assoc($result)): 
                    ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo htmlspecialchars($row['tennguoinhan']); ?></td>
                        <td><?php echo htmlspecialchars($row['sodienthoai']); ?></td>
                        <td><?php echo htmlspecialchars($row['diachi']); ?></td>
                        <td><?php echo htmlspecialchars($row['xa']); ?></td>
                        <td><?php echo htmlspecialchars($row['huyen']); ?></td>
                        <td><?php echo htmlspecialchars($row['tinh']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Chưa có thông tin nhận hàng. Vui lòng thêm thông tin nhận hàng của bạn.</p>
        <?php endif; ?>
    </div>
    <?php

require_once('components/footer.php');
?>
    <script>
          // Trong file thanhtoan.php
          function openAddressForm(e) {
            e.preventDefault();
            const url = e.currentTarget.href;
            window.open(url, 'addressWindow', 'width=800,height=600');
        }

        // Hàm này cần được gọi từ trang add_thongtinnhanhang.php sau khi submit thành công
        function refreshParent() {
            if (window.opener && !window.opener.closed) {
                window.opener.location.reload();
            }
            window.close();
        }
       </script>


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
