<?php
session_start();
$errorMsg = "";


if(isset($_POST['btSubmit']))
{
    
    $email = $_POST["email"];
    $password = $_POST['password'];
    $captcha    = $_POST['g-recaptcha-response'];
    if(!$email || !$password)
    {
        $errorMsg = "vui lòng nhập đầy đủ thông tin";
        require_once("includes/loginform.php");
    }
    if($email == $password)
    {
        $errorMsg = "vui lòng không nhập trùng email và password";
        require_once("includes/loginform.php");
    }
    else
    {
        $secret = '6LdbgN4qAAAAALFtqIb3ZHosGd1C5HugFY6s_FO6'; 
        $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
        $response_data = json_decode($verify_response);
        if($response_data->success)
        {
            require_once("../db/conn.php");
            //cau lenh truy van
            $sql = "select * from admins where email='$email' and password='$password'";
            //thuc thi cau lenh
            $result = mysqli_query($conn, $sql);
            //kiem tra so luong record trả về: > 0: đăng nhập thành công
            if (mysqli_num_rows($result) > 0) {
                // echo "<h4>Dang nhap thanh cong</h4>";
                //luu tru thong tin dang nha
                $row = mysqli_fetch_assoc($result);
                $_SESSION['admin'] = $row;

                header("Location: index.php");
            } else {
                $errorMsg = "Không tìm thấy thông tin tài khoản trong hệ thống";
                require_once("includes/loginform.php");
            }
        }
        else
        {
            $errorMsg = "Bạn chưa xác minh repcatcha thành công";
            require_once("includes/loginform.php");
            
        }
        
    }

}

else {
    require_once("includes/loginform.php");
}
?>
