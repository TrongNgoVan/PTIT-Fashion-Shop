<?php
require('conn.php'); // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra các trường bắt buộc
    if (isset($_POST['name'], $_POST['sumary'], $_POST['description'], $_POST['stock'], $_POST['giagoc'], $_POST['giaban'], $_POST['danhmuc'], $_POST['thuonghieu']) &&
        !empty(trim($_POST['name'])) &&
        is_numeric($_POST['stock']) &&
        is_numeric($_POST['giagoc']) &&
        is_numeric($_POST['giaban'])) {
        
        // Lấy dữ liệu
        $name = trim($_POST['name']);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        $summary = trim($_POST['sumary']);
        $description = trim($_POST['description']);
        $stock = (int) $_POST['stock'];
        $price = (float) $_POST['giagoc'];
        $discounted_price = (float) $_POST['giaban'];
        $category_id = (int) $_POST['danhmuc'];
        $brand_id = (int) $_POST['thuonghieu'];
        $status = 'Active';

        // Xử lý ảnh
        $images = '';
        if (isset($_FILES['anhs']) && count($_FILES['anhs']['name']) > 0) {
            $upload_dir = "uploads/";
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

            for ($i = 0; $i < count($_FILES['anhs']['name']); $i++) {
                $filename = basename($_FILES['anhs']['name'][$i]);
                $tmp_path = $_FILES['anhs']['tmp_name'][$i];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $valid_extensions = ['jpg', 'jpeg', 'png'];

                if (in_array($ext, $valid_extensions)) {
                    $new_name = uniqid() . "_" . preg_replace('/\s+/', '_', $filename);
                    $full_path = $upload_dir . $new_name;

                    if (move_uploaded_file($tmp_path, $full_path)) {
                        $images .= $full_path . ";";
                    }
                }
            }
        }
        $images = rtrim($images, ";");

        // Chèn vào bảng products
        $sql = "INSERT INTO products (name, slug, description, summary, stock, price, disscounted_price, images, category_id, brand_id, status, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssiddsiis",
                $name, $slug, $description, $summary, $stock, $price, $discounted_price,
                $images, $category_id, $brand_id, $status
            );

            if (mysqli_stmt_execute($stmt)) {
                header("Location: listsanpham.php");
                exit();
            } else {
                echo "Lỗi khi thực thi truy vấn: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Lỗi chuẩn bị truy vấn: " . mysqli_error($conn);
        }
    } else {
        echo "Vui lòng nhập đầy đủ các trường bắt buộc và kiểm tra kiểu dữ liệu.";
    }
} else {
    header("Location: addproduct.php");
    exit();
}
?>
