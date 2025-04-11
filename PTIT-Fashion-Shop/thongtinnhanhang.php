



<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once('db/conn.php');

// Lấy id người dùng từ session
$id_user = $_SESSION['user']['id'];

// Truy vấn lấy danh sách thông tin nhận hàng của người dùng
$sql = "SELECT * FROM thongtinnhanhang WHERE id_user = $id_user";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông Tin Nhận Hàng</title>
    <!-- Thêm Bootstrap CSS (hoặc CSS khác bạn dùng) -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Thông Tin Nhận Hàng Của Tôi</h2>
        
        <!-- Nút thêm thông tin nhận hàng -->
        <div class="mb-3">
            <a href="add_thongtinnhanhang.php" class="btn btn-primary">Thêm Thông Tin Nhận Hàng</a>
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

    <!-- Thêm Bootstrap JS và jQuery nếu cần -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
