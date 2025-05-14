<?php
require('conn.php');

// 1. Lấy & escape dữ liệu từ form
$name        = mysqli_real_escape_string($conn, trim($_POST['name']));
$slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
$sumary      = trim($_POST['sumary']);
$description = trim($_POST['description']);
$danhmuc     = (int) $_POST['danhmuc'];

// 2. Xử lý upload ảnh
$location = null;
if (!empty($_FILES['anh']['name'])) {
    $ext = strtolower(pathinfo($_FILES['anh']['name'], PATHINFO_EXTENSION));
    $valid_extensions = ["jpg","jpeg","png"];
    if (in_array($ext, $valid_extensions)) {
        $newName  = uniqid('news_') . '.' . $ext;
        $uploadDir = __DIR__ . '/uploads/news/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $fullPath = $uploadDir . $newName;
        if (move_uploaded_file($_FILES['anh']['tmp_name'], $fullPath)) {
            // Lưu đường dẫn tương đối để dùng trong web
            $location = 'uploads/news/' . $newName;
        }
    }
}

// 3. Chuẩn bị & thực thi INSERT
$sql = "
    INSERT INTO `news`
      (`title`, `avatar`, `slug`, `sumary`, `description`, `newscategory_id`, `created_at`, `updated_at`)
    VALUES
      (?, ?, ?, ?, ?, ?, NOW(), NOW())
";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param(
    $stmt,
    'sssssi',
    $name,
    $location,
    $slug,
    $sumary,
    $description,
    $danhmuc
);

if (mysqli_stmt_execute($stmt)) {
    // Chèn thành công → redirect
    header("Location: ./listnews.php");
    exit;
} else {
    // Nếu lỗi, hiển thị để debug
    echo "Lỗi khi thêm tin: " . mysqli_stmt_error($stmt);
    exit;
}

// 4. Đóng kết nối
mysqli_stmt_close($stmt);
mysqli_close($conn);
