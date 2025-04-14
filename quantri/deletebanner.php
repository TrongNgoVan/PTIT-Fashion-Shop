<?php
// deletebanner.php
require('conn.php');

// Kiểm tra tham số id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Không có ID banner được chỉ định.");
}

$id = (int)$_GET['id'];

// Lấy thông tin banner trước khi xóa (để có thể xóa file ảnh nếu cần)
$sql = "SELECT image_path FROM banner WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$banner = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$banner) {
    die("Không tìm thấy banner với ID được cung cấp.");
}

// Xóa bản ghi trong bảng
$sql_delete = "DELETE FROM banner WHERE id = ?";
$stmt_delete = mysqli_prepare($conn, $sql_delete);
mysqli_stmt_bind_param($stmt_delete, "i", $id);
if (mysqli_stmt_execute($stmt_delete)) {
    // Tùy chọn: Xóa file hình ảnh từ server nếu file tồn tại
    if (file_exists($banner['image_path'])) {
        unlink($banner['image_path']);
    }
    // Chuyển hướng về trang liệt kê banner sau khi xóa
    header("Location: listbanner.php");
    exit();
} else {
    echo "Lỗi khi xóa banner: " . mysqli_error($conn);
}
mysqli_stmt_close($stmt_delete);
?>
