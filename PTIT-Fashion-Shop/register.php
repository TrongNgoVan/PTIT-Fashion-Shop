<?php
session_start();
require 'vendor/autoload.php'; // Load thư viện PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$errorMsg = "";

if (isset($_POST['btSubmit'])) {
    $name = $_POST["username"];
    $phone = $_POST["phone"];
    $add = $_POST["add"];
    $email = $_POST["email"];
    $password = $_POST['password'];
    $captcha = $_POST['g-recaptcha-response'];

    if (!$email || !$password || !$name || !$phone || !$add) {
        $errorMsg = "Vui lòng nhập đầy đủ thông tin";
        require_once("register_form.php");
        exit();
    }

    if ($email == $password) {
        $errorMsg = "Vui lòng không nhập trùng email và password";
        require_once("register_form.php");
        exit();
    }

    $secret = '6LdbgN4qAAAAALFtqIb3ZHosGd1C5HugFY6s_FO6';
    $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
    $response_data = json_decode($verify_response);

    if ($response_data->success) {
        require_once("db/conn.php");

        // Kiểm tra email đã tồn tại chưa
        $check_sql = "SELECT * FROM users WHERE email='$email'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $errorMsg = "Email đã tồn tại, vui lòng chọn email khác!";
            require_once("register_form.php");
            exit();
        }

        // Mã hóa mật khẩu trước khi lưu


        // Tạo mã kích hoạt ngẫu nhiên
        $activation_code = md5(uniqid(rand(), true));
        // Thêm user vào database
        $sql = "INSERT INTO users (name, email, password, phone, address, activation_code, status) 
        VALUES ('$name', '$email', '$password', '$phone', '$add', '$activation_code', 'Inactive')";

        if (mysqli_query($conn, $sql)) {
            // Lấy ID của người dùng vừa đăng ký
            $user_id = mysqli_insert_id($conn);

            // Truy vấn để lấy toàn bộ thông tin của user
            // $query = "SELECT * FROM users WHERE id = $user_id";
            // $result = mysqli_query($conn, $query);

            // if ($result && mysqli_num_rows($result) > 0) {
            //     $user = mysqli_fetch_assoc($result); // Lấy thông tin người dùng dưới dạng mảng
            //     $_SESSION['user'] = $user; // Lưu vào session toàn bộ đối tượng user
            // }

            // header("Location: index.php");
            // exit();

            // Gửi email kích hoạt bằng PHPMailer

            $mail = new PHPMailer(true);
            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'yurilovekiba@gmail.com';
                $mail->Password   = 'clqp ztac mckm yvbs';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Thiết lập email
                $mail->setFrom('yurilovekiba@gmail.com', 'PTIT Fashion Shop');
                $mail->addAddress($email, $name);
                $mail->Subject = "Xác nhận tài khoản của bạn";

                $activation_link = "localhost/PTIT-Fashion-Shop/activate.php?email=" . urlencode($email) . "&code=" . urlencode($activation_code);
                $mail->Body = "Chào $name,\n\nCảm ơn bạn đã đăng ký tài khoản. Vui lòng nhấp vào link dưới đây để kích hoạt tài khoản của bạn:\n\n$activation_link\n\nNếu bạn không yêu cầu đăng ký, hãy bỏ qua email này.";

                // Gửi email
                $mail->send();
                echo "Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.";
            } catch (Exception $e) {
                echo "Không thể gửi email kích hoạt. Lỗi: {$mail->ErrorInfo}";
            }
        } else {
            $errorMsg = "Lỗi hệ thống! Không thể đăng ký, vui lòng thử lại sau.";
            require_once("register_form.php");
        }
    } else {
        $errorMsg = "Bạn chưa xác minh Recaptcha thành công";
        require_once("register_form.php");
    }
} else {
    require_once("register_form.php");
}
