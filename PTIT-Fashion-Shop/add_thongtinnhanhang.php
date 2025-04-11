<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
    // Chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
require_once('db/conn.php');

// Khởi tạo biến thông báo lỗi và thành công
$error = "";
$success = "";

// Xử lý khi form được gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy và làm sạch dữ liệu từ form
    $id_user      = $_SESSION['user']['id'];
    $tennguoinhan = mysqli_real_escape_string($conn, trim($_POST['tennguoinhan']));
    $sodienthoai  = mysqli_real_escape_string($conn, trim($_POST['sodienthoai']));
    $diachi       = mysqli_real_escape_string($conn, trim($_POST['diachi']));
    $xa           = mysqli_real_escape_string($conn, trim($_POST['xa']));
    $huyen        = mysqli_real_escape_string($conn, trim($_POST['huyen']));
    $tinh         = mysqli_real_escape_string($conn, trim($_POST['tinh']));

    // Kiểm tra các trường bắt buộc
    if (empty($tennguoinhan) || empty($sodienthoai) || empty($diachi) || empty($xa) || empty($huyen) || empty($tinh)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Tạo truy vấn INSERT
        $sql = "INSERT INTO thongtinnhanhang (id_user, tennguoinhan, sodienthoai, diachi, xa, huyen, tinh)
                VALUES ($id_user, '$tennguoinhan', '$sodienthoai', '$diachi', '$xa', '$huyen', '$tinh')";

        if (mysqli_query($conn, $sql)) {
            $success = "Thông tin nhận hàng đã được lưu thành công.";
        } else {
            $error = "Có lỗi xảy ra: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Thông Tin Nhận Hàng</title>
    <!-- Bạn có thể thêm các file CSS nếu cần -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Thêm Thông Tin Nhận Hàng</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form action="" method="post">
            <div class="form-group">
                <label for="tennguoinhan">Tên Người Nhận:</label>
                <input type="text" name="tennguoinhan" id="tennguoinhan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sodienthoai">Số Điện Thoại:</label>
                <input type="text" name="sodienthoai" id="sodienthoai" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="diachi">Địa Chỉ (Số nhà, tên đường):</label>
                <input type="text" name="diachi" id="diachi" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="xa">Xã/Phường:</label>
                <input type="text" name="xa" id="xa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="huyen">Quận/Huyện:</label>
                <input type="text" name="huyen" id="huyen" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tinh">Tỉnh/Thành Phố:</label>
                <input type="text" name="tinh" id="tinh" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu Thông Tin</button>
        </form>
    </div>

    <!-- Thêm JS nếu cần, ví dụ jQuery hoặc Bootstrap JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>