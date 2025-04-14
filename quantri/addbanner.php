<?php

require('conn.php'); // Kết nối CSDL

// Kiểm tra xem form đã được submit thông qua phương thức POST chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Kiểm tra các trường bắt buộc
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && 
        isset($_POST['hot_text']) && !empty(trim($_POST['hot_text']))) {

        // Lấy thông tin từ form
        $hot_text = mysqli_real_escape_string($conn, trim($_POST['hot_text']));
        $link_url = isset($_POST['link_url']) ? mysqli_real_escape_string($conn, trim($_POST['link_url'])) : '#';
        $status = isset($_POST['status']) ? (int) $_POST['status'] : 1;

        // Xử lý file upload hình ảnh
        $target_dir = "img/banner/"; // Thư mục lưu file, đảm bảo thư mục này có quyền ghi
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Lấy thông tin file
        $file_name = basename($_FILES['image']['name']);
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Danh sách định dạng cho phép (có thể điều chỉnh theo yêu cầu)
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($file_ext, $allowed_extensions)) {
            die("Chỉ cho phép upload file hình ảnh (JPG, JPEG, PNG, GIF).");
        }

        // Tạo tên file mới để tránh trùng lặp, ví dụ: thời gian hiện tại + tên file gốc
        $new_file_name = time() . "_" . preg_replace('/\s+/', '_', $file_name);
        $target_file = $target_dir . $new_file_name;

        // Di chuyển file từ thư mục tạm thời đến thư mục đích
        if (!move_uploaded_file($file_tmp, $target_file)) {
            die("Có lỗi xảy ra khi upload hình ảnh.");
        }
        $image_path = "http://localhost/PTIT_SHOP/quantri/" . $target_file; // Đường dẫn đầy đủ đến hình ảnh
        // Chuẩn bị truy vấn SQL chèn dữ liệu vào bảng banners
        $sql = "INSERT INTO banner (image_path, hot_text, link_url, status) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $image_path, $hot_text, $link_url, $status);

            // Thực thi truy vấn
            if (mysqli_stmt_execute($stmt)) {
                // Nếu thành công, chuyển hướng về trang liệt kê banner
                header("Location: listbanner.php");
                exit();
            } else {
                echo "Lỗi khi thực thi truy vấn: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Lỗi trong việc chuẩn bị truy vấn: " . mysqli_error($conn);
        }
    } else {
        echo "Yêu cầu nhập đầy đủ hình ảnh và nội dung hot cho banner.";
    }
} else {
    // Nếu truy cập trực tiếp file này mà không qua form
    header("Location: thembanner.php");
    exit();
}
?>
