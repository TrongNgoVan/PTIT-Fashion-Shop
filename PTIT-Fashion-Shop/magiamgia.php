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
    <link rel="stylesheet" href="css/my.css" type="text/css">
    <link rel="stylesheet" href="css/magiamgia.css" type="text/css">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">
</head>
<body>
<?php
session_start();
$is_homepage = false;
require_once('components/header.php');
require_once('db/conn.php'); // File này chứa kết nối PDO hoặc mysqli với database
?>

<div class="container">
    <h1>Danh Sách Mã Giảm Giá</h1>

    <div class="coupon-list">
        <?php
        $sql = "SELECT * FROM magiamgia ORDER BY ngay_het_han ASC";
        $result = $conn->query($sql); // Nếu bạn dùng PDO, hãy thay $conn thành $pdo

        if ($result && $result->num_rows > 0): // Nếu bạn dùng mysqli
            while ($row = $result->fetch_assoc()):
                $gia_tri = $row['loai_giam_gia'] === 'phan_tram' ? $row['gia_tri_giam'] . '%' : number_format($row['gia_tri_giam'], 0, ',', '.') . 'đ';
                $dieu_kien = $row['dieu_kien_giam'] > 0 ? 'Từ đơn hàng ' . number_format($row['dieu_kien_giam'], 0, ',', '.') . 'đ' : 'Không có điều kiện';
        ?>
        <div class="coupon-card-custom">
            <div class="coupon-image">
                <img src="<?= htmlspecialchars($row['image']) ?>" alt="Mã giảm giá" />
            </div>
            <div class="coupon-content">
                <p><strong>Mô tả:</strong> <?= htmlspecialchars($row['mo_ta']) ?></p>
                <p><strong>Giá trị giảm:</strong> <?= $gia_tri ?></p>
                <p><strong>Điều kiện giảm:</strong> <?= $dieu_kien ?></p>
                <p><strong>Số lượt đã dùng:</strong> <?= $row['so_luot_su_dung'] ?></p>
                <p><strong>Số lượt giới hạn:</strong> <?= $row['so_luot_gioi_han'] ?></p>
                <p><strong>Ngày hết hạn:</strong> <?= date("d/m/Y", strtotime($row['ngay_het_han'])) ?></p>
                <p><strong>Mã code:</strong> <strong><?= htmlspecialchars($row['code']) ?></strong></p>
                <a href="shop.php" class="buy-btn">Mua ngay</a>
            </div>
        </div>
        <?php endwhile; else: ?>
            <p>Hiện không có mã giảm giá nào.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once('components/footer.php'); ?>


</body>
<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</html>
