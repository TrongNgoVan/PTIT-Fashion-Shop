<?php
require_once("db/conn.php");

if (isset($_GET['email']) && isset($_GET['code'])) {
    $email = $_GET['email'];
    $code = $_GET['code'];

    // Kiểm tra xem mã kích hoạt có hợp lệ không
    $sql = "SELECT * FROM users WHERE email='$email' AND activation_code='$code'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Kích hoạt tài khoản
        $update_sql = "UPDATE users SET status='Active', activation_code=NULL WHERE email='$email'";
        mysqli_query($conn, $update_sql);
        echo "Tài khoản của bạn đã được kích hoạt!Bạn có thể <a href='login.php'>đăng nhập</a> ngay bây giờ.";
    } else {
        echo "Liên kết không hợp lệ hoặc tài khoản đã được kích hoạt.";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
