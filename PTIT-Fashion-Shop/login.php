<?php
session_start();
$errorMsg = "";


if (isset($_POST['btSubmit'])) {

    $email = $_POST["email"];
    $password = $_POST['password'];
    $captcha    = $_POST['g-recaptcha-response'];
    if (!$email || !$password) {
        $errorMsg = "vui lòng nhập đầy đủ thông tin";
        require_once("loginform.php");
    }
    if ($email == $password) {
        $errorMsg = "vui lòng không nhập trùng email và password";
        require_once("loginform.php");
    } else {
        $secret = '6LdbgN4qAAAAALFtqIb3ZHosGd1C5HugFY6s_FO6';
        $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
        $response_data = json_decode($verify_response);
        if ($response_data->success) {
            require_once("db/conn.php");
            //cau lenh truy van
            // Câu lệnh SQL có dấu ?
            $sql = "SELECT * FROM users WHERE email = ? AND password = ?";

            // Chuẩn bị câu lệnh
            $stmt = mysqli_prepare($conn, $sql);

            // Gán dữ liệu người dùng vào câu lệnh
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);

            // Thực thi
            mysqli_stmt_execute($stmt);

            // Lấy kết quả
            $result = mysqli_stmt_get_result($stmt);

            //kiem tra so luong record trả về: > 0: đăng nhập thành công
            if (mysqli_num_rows($result) > 0) {
                // echo "<h4>Dang nhap thanh cong</h4>";
                //luu tru thong tin dang nhap
                $row = mysqli_fetch_assoc($result);

                //Kiểm tra email đã xác minh chưa
                if ($user['status'] === 'Inactive') { // Kiểm tra cột xác minh email
                    $errorMsg = "Email chưa được xác minh. Vui lòng kiểm tra email để xác nhận.";
                    require_once("loginform.php");
                    exit();
                }

                $_SESSION['user'] = $row;
                // print_r($_SESSION['user']);
                // exit;
                // chuyen qua trang quan trị
                header("Location: index.php");
            } else {
                $errorMsg = "Không tìm thấy thông tin tài khoản trong hệ thống";
                require_once("loginform.php");
            }
        } else {
            $errorMsg = "Bạn chưa xác minh repcatcha thành công";
            require_once("loginform.php");
        }
    }
} else {
    require_once("loginform.php");
}
// huynh ngáo