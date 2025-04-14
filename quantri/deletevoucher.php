<?php

// Lấy id voucher từ URL
$delid = $_GET['id'];

// Kết nối cơ sở dữ liệu
require('conn.php');

// Lấy thông tin voucher bao gồm đường dẫn ảnh
$sql_str = "SELECT image FROM magiamgia WHERE id = $delid";
$result = mysqli_query($conn, $sql_str);

// Kiểm tra xem voucher có tồn tại không
if ($row = mysqli_fetch_assoc($result)) {
    // Lấy đường dẫn ảnh của voucher
    $image_path = $row['image'];

    // Kiểm tra nếu có ảnh và xóa ảnh khỏi thư mục
    if (!empty($image_path) && file_exists($image_path)) {
        unlink($image_path); // Xóa ảnh
    }
    
    // Xóa voucher trong cơ sở dữ liệu
    $delete_sql = "DELETE FROM magiamgia WHERE id = $delid";
    if (mysqli_query($conn, $delete_sql)) {
        // Nếu xóa thành công, chuyển hướng về trang danh sách voucher
        header("Location: listvoucher.php");
        exit();
    } else {
        // Nếu có lỗi khi xóa, thông báo lỗi
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // Nếu không tìm thấy voucher
    echo "Voucher not found!";
}

?>
