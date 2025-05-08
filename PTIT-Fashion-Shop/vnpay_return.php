<?php
session_start();
require_once('./db/conn.php');
require_once('./config/vnpay_config.php'); // nếu có file cấu hình riêng

// Lấy các tham số trả về từ VNPay
$vnp_SecureHash = $_GET['vnp_SecureHash']; // Chuỗi hash để xác thực
$inputData = array();

foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

unset($inputData['vnp_SecureHash']);
ksort($inputData);
$hashData = "";
foreach ($inputData as $key => $value) {
    $hashData .= $key . "=" . $value . "&";
}
$hashData = rtrim($hashData, "&");
$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret); // Từ file config

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>VNPay Payment Result</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <?php require_once('components/header.php'); ?>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4 style="text-align: center;">Kết quả thanh toán</h4>
                <div style="text-align: center; font-size: 18px;">
                    <?php
                    if ($secureHash === $vnp_SecureHash) {
                        if ($_GET['vnp_ResponseCode'] == '00') {
                            // Giao dịch thành công
                            echo "<p style='color: green;'>✅ Thanh toán thành công!</p>";

                            // Cập nhật trạng thái đơn hàng
                            if (isset($_SESSION['donhang'])) {
                                $order_id = $_SESSION['donhang']['order_id'];
                                $stmt = $conn->prepare("UPDATE orders SET status='Đã thanh toán' WHERE id=?");
                                $stmt->bind_param("i", $order_id);
                                $stmt->execute();
                            }
                        } else {
                            echo "<p style='color: red;'>❌ Giao dịch không thành công. Mã lỗi: " . $_GET['vnp_ResponseCode'] . "</p>";
                        }
                    } else {
                        echo "<p style='color: red;'>❌ Chuỗi hash không hợp lệ. Có thể dữ liệu bị thay đổi.</p>";
                    }
                    ?>
                    <br><br>
                    <a href="index.php" class="btn btn-success">Quay về trang chủ</a>
                </div>
            </div>
        </div>
    </section>
    <?php require_once('components/footer.php'); ?>
</body>
</html>
