<?php
session_start();
require __DIR__ . '/../PTIT-Fashion-Shop/vendor/autoload.php';
require('conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Kiểm tra quyền admin
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: khachhangtiemnang.php");
    exit();
}

// Validate dữ liệu đầu vào
$user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
$to_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$subject = trim($_POST['subject'] ?? '');
$message = nl2br(htmlspecialchars(trim($_POST['message'] ?? '')));

// Kiểm tra dữ liệu hợp lệ
if (!$user_id || !$to_email || !$subject || !$message) {
    $_SESSION['email_status'] = [
        'type' => 'danger',
        'message' => 'Vui lòng điền đầy đủ thông tin gửi email.'
    ];
    header("Location: khachhangtiemnang.php");
    exit();
}

if (!filter_var($to_email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_status'] = [
        'type' => 'danger',
        'message' => 'Địa chỉ email không hợp lệ.'
    ];
    header("Location: khachhangtiemnang.php");
    exit();
}

// Gửi email bằng PHPMailer
$mail = new PHPMailer(true);
try {
    // Cho phép gửi HTML
    $mail->isHTML(true);

    // Đặt charset gửi đi là UTF-8 để tiếng Việt không loạn
    $mail->CharSet = 'UTF-8';

    // (Tuỳ chọn) Mã hoá nội dung base64 để chắc chắn an toàn với mọi ký tự
    $mail->Encoding = 'base64';

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'yurilovekiba@gmail.com';
    $mail->Password   = 'clqp ztac mckm yvbs';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Thiết lập email
    $mail->setFrom('yurilovekiba@gmail.com', 'PTIT Fashion Shop');
    $mail->addAddress($to_email);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();

    $_SESSION['email_status'] = [
        'type' => 'success',
        'message' => 'Đã gửi email thành công đến ' . $to_email
    ];
} catch (Exception $e) {
    error_log("[Email Error] " . $e->getMessage());
    $_SESSION['email_status'] = [
        'type' => 'danger',
        'message' => 'Lỗi gửi email: ' . $e->getMessage()
    ];
}

header("Location: khachhangtiemnang.php");
exit();
