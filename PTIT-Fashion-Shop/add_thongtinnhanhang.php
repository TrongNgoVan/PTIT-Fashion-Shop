<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thông tin nhận hàng</title>

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
    <link rel="stylesheet" href="css/shop.css" type="text/css">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">

</head>

<body>
    <style>
        /* Trong file add_thongtinnhanhang.css */
        .address-form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .address-form-container h2 {
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
    </style>
    <?php
    session_start();
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
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
        $tinh = $_POST['tinh'];  // Lúc này là ID tỉnh
        $huyen = $_POST['huyen']; // ID huyện
        $xa = $_POST['xa'];       // Tên xã (đã set từ option.value = xa.name)


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
            <!-- THAY TOÀN BỘ CÁC INPUT text ở xã/huyện/tỉnh bằng các SELECT -->
            <div class="form-group">
                <label for="tinh">Tỉnh/Thành Phố:</label>
                <select name="tinh" id="tinh" class="form-control" required>
                    <option value="">-- Chọn Tỉnh/Thành Phố --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="huyen">Quận/Huyện:</label>
                <select name="huyen" id="huyen" class="form-control" required>
                    <option value="">-- Chọn Quận/Huyện --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="xa">Xã/Phường:</label>
                <select name="xa" id="xa" class="form-control" required>
                    <option value="">-- Chọn Xã/Phường --</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Lưu Thông Tin</button>
        </form>
    </div>


    <?php
    // Sau khi xử lý submit thành công
    if ($success) { ?>
        <script>
            // Thông báo cho trang chính refresh
            window.onload = function() {
                setTimeout(function() {
                    refreshParent();
                }, 500);
            }

            function refreshParent() {
                if (window.opener && !window.opener.closed) {
                    window.opener.location.reload();
                }
                window.close();
            }
        </script>
    <?php } ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tinhSelect = document.getElementById('tinh');
            const huyenSelect = document.getElementById('huyen');
            const xaSelect = document.getElementById('xa');

            // Load danh sách tỉnh/thành
            fetch('https://provinces.open-api.vn/api/p/')
                .then(res => res.json())
                .then(data => {
                    data.forEach(tinh => {
                        const option = document.createElement('option');
                        option.value = tinh.name;
                        option.text = tinh.name;
                        option.dataset.code = tinh.code;
                        tinhSelect.appendChild(option);
                    });
                });

            // Khi chọn tỉnh -> load huyện
            tinhSelect.addEventListener('change', function() {
                const selectedTinhCode = tinhSelect.options[tinhSelect.selectedIndex].dataset.code;
                huyenSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
                xaSelect.innerHTML = '<option value="">-- Chọn Xã/Phường --</option>';

                if (!selectedTinhCode) return;

                fetch(`https://provinces.open-api.vn/api/p/${selectedTinhCode}?depth=2`)
                    .then(res => res.json())
                    .then(data => {
                        data.districts.forEach(huyen => {
                            const option = document.createElement('option');
                            option.value = huyen.name;
                            option.text = huyen.name;
                            option.dataset.code = huyen.code;
                            huyenSelect.appendChild(option);
                        });
                    });
            });

            // Khi chọn huyện -> load xã
            huyenSelect.addEventListener('change', function() {
                const selectedHuyenCode = huyenSelect.options[huyenSelect.selectedIndex].dataset.code;
                xaSelect.innerHTML = '<option value="">-- Chọn Xã/Phường --</option>';

                if (!selectedHuyenCode) return;

                fetch(`https://provinces.open-api.vn/api/d/${selectedHuyenCode}?depth=2`)
                    .then(res => res.json())
                    .then(data => {
                        data.wards.forEach(xa => {
                            const option = document.createElement('option');
                            option.value = xa.name;
                            option.text = xa.name;
                            xaSelect.appendChild(option);
                        });
                    });
            });
        });
    </script>


</body>

</html>