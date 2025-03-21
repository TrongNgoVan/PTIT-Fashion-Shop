<?php
session_start();
require_once('./db/conn.php');

$user = $_SESSION['user'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission for updating user details
    $name = $_POST['name'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $add = $_POST['add'];
    $email = $user['email'];
    $id = $user['id'];
    // Handle avatar upload
    $avatar = $user['avatar']; // Default to current avatar
    if (!empty($_FILES['avatar']['name'])) {
        $target_dir = "avt/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $avatar = $target_file;
        }
    } else {
        if (empty($avatar)) {
            $avatar = "img/icon-account";
        }
    }

    $update_sql = 'UPDATE users SET name = ?  , email = ?, password = ?  , phone = ? , address = ? ,avatar = ?  WHERE id = ?';
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param('ssssssi', $name, $email,  $password, $phone, $add, $avatar, $id);


    if ($update_stmt->execute()) {
        $_SESSION['user'] = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'address' => $add,
            'avatar' => $avatar
        ];
        echo "Cập nhật thông tin thành công!";
        header('Location: profile.php');
        exit();
    } else {
        echo "Error updating user information: " . $conn->error;
    }
}
?>


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
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">
</head>

<body>
    <?php

    $is_homepage = false;
    require('components/header.php');


    ?>



    <!-- Phần thân để hiển thị filter và chi tiết căn phòng -->
    <div class="container" style="margin-top: 20px; margin-bottom: 20px;">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12" style="padding: 0px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-5">
                    <img src="<?php echo htmlspecialchars($user['avatar']); ?>" class="img-thumbnail" alt="User Avatar">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-7" style="font-size: 23px; margin: 10px 0px; color: #9a9999;">
                    <?php echo htmlspecialchars($user['email']); ?>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                <div class="col-xs-12" style="padding: 0px; font-size: 23px; color: green;">
                    Thông tin cơ bản
                </div>

                <form action="profile.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Họ và Tên:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="add">Điạ chỉ:</label>
                        <input type="text" class="form-control" id="add" name="add" value="<?php echo htmlspecialchars($user['address']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Ảnh đại diện:</label>
                        <input type="file" class="form-control" id="avatar" name="avatar">
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: rgb(175, 0, 0);">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>


    <?php

    require('components/footer.php');

    ?>
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