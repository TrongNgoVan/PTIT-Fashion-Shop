<?php 
require('conn.php'); // Kết nối CSDL

// Kiểm tra xem form đã được submit thông qua phương thức POST chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Kiểm tra các trường bắt buộc
    if (isset($_POST['code']) && !empty(trim($_POST['code'])) &&
        isset($_POST['loai_giam_gia']) && !empty(trim($_POST['loai_giam_gia'])) &&
        isset($_POST['gia_tri_giam']) && is_numeric($_POST['gia_tri_giam']) &&
        isset($_POST['dieu_kien_giam']) && is_numeric($_POST['dieu_kien_giam'])) {

        // Lấy dữ liệu từ form
        $code = mysqli_real_escape_string($conn, trim($_POST['code']));
        $loai_giam_gia = mysqli_real_escape_string($conn, trim($_POST['loai_giam_gia']));
        $gia_tri_giam = (float) $_POST['gia_tri_giam'];
        $dieu_kien_giam = (float) $_POST['dieu_kien_giam'];
        $mo_ta = isset($_POST['mo_ta']) ? mysqli_real_escape_string($conn, trim($_POST['mo_ta'])) : "";
        $ngay_het_han = isset($_POST['ngay_het_han']) ? mysqli_real_escape_string($conn, trim($_POST['ngay_het_han'])) : null;
        $so_luot_gioi_han = isset($_POST['so_luot_gioi_han']) ? (int) $_POST['so_luot_gioi_han'] : 10;
        // Số lượt sử dụng mặc định là 0

        // Xử lý file upload hình ảnh (cột image)
        $image_path = "";
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "img/magiamgia/"; // Thư mục lưu file, đảm bảo có quyền ghi
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $file_name = basename($_FILES['image']['name']);
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Danh sách định dạng cho phép
            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
            if (!in_array($file_ext, $allowed_extensions)) {
                die("Chỉ cho phép upload file hình ảnh (JPG, JPEG, PNG, GIF).");
            }

            // Tạo tên file mới để tránh trùng lặp
            $new_file_name = time() . "_" . preg_replace('/\s+/', '_', $file_name);
            $target_file = $target_dir . $new_file_name;

            // Di chuyển file từ thư mục tạm thời đến thư mục đích
            if (!move_uploaded_file($file_tmp, $target_file)) {
                die("Có lỗi xảy ra khi upload hình ảnh.");
            }
            // Lưu đường dẫn hình ảnh, có thể là đường dẫn tuyệt đối hoặc tương đối
            $image_path = "http://localhost/PTIT_SHOP/quantri/" . $target_file;
        }

        // Chuẩn bị truy vấn SQL chèn dữ liệu vào bảng magiamgia
        $sql = "INSERT INTO magiamgia (code, loai_giam_gia, gia_tri_giam, dieu_kien_giam, mo_ta, image, ngay_het_han, so_luot_su_dung, so_luot_gioi_han)
                VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Sửa chuỗi định nghĩa kiểu thành "ssddsssi" cho 8 biến bind:
            // - code: string (s)
            // - loai_giam_gia: string (s)
            // - gia_tri_giam: double (d)
            // - dieu_kien_giam: double (d)
            // - mo_ta: string (s)
            // - image: string (s)
            // - ngay_het_han: string (s)
            // - so_luot_gioi_han: integer (i)
            mysqli_stmt_bind_param($stmt, "ssddsssi", $code, $loai_giam_gia, $gia_tri_giam, $dieu_kien_giam, $mo_ta, $image_path, $ngay_het_han, $so_luot_gioi_han);

            // Thực thi truy vấn
            if (mysqli_stmt_execute($stmt)) {
                // Nếu thành công, chuyển hướng về trang liệt kê voucher
                header("Location: listvoucher.php");
                exit();
            } else {
                echo "Lỗi khi thực thi truy vấn: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Lỗi trong việc chuẩn bị truy vấn: " . mysqli_error($conn);
        }
    } else {
        echo "Vui lòng nhập đầy đủ các trường bắt buộc: Code, Loại Giảm Giá, Giá Trị Giảm, và Điều Kiện Giảm.";
    }
} else {
    // Nếu truy cập trực tiếp file này mà không qua form
    header("Location: addvoucher.php");
    exit();
}
?>
