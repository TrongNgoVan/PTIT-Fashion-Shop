<?php
require('conn.php');

// Lấy id từ URL
$id = $_GET['id'];

// Lấy dữ liệu banner theo id
$sql_str = "SELECT * FROM banner WHERE id = $id";
$res = mysqli_query($conn, $sql_str);
$banner = mysqli_fetch_assoc($res);

// Nếu form được submit
if (isset($_POST['btnUpdate'])) {
    $hot_text = $_POST['hot_text'];
    $link_url = $_POST['link_url'];
    $status = $_POST['status'];

    // Xử lý upload hình ảnh nếu có
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "img/banner/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = basename($_FILES['image']['name']);
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($file_ext, $allowed_extensions)) {
            $new_file_name = time() . "_" . preg_replace('/\s+/', '_', $file_name);
            $target_file = $target_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $target_file)) {
                $image_path = "http://localhost/PTIT_SHOP/quantri/" . $target_file;
                $sql_update = "UPDATE banner SET image_path=?, hot_text=?, link_url=?, status=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $sql_update);
                mysqli_stmt_bind_param($stmt, "ssssi", $image_path, $hot_text, $link_url, $status, $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    } else {
        // Không đổi ảnh
        $sql_update = "UPDATE banner SET hot_text=?, link_url=?, status=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql_update);
        mysqli_stmt_bind_param($stmt, "ssii", $hot_text, $link_url, $status, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

  
    header("Location: listbanner.php");
    exit();
} else {
    // CHỈ hiển thị form nếu chưa nhấn cập nhật
    require('includes/header.php');
?>

<!-- Giao diện form cập nhật -->
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Cập nhật banner</h1>
                        </div>
                        <form class="user" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Hot text:</label>
                                <input type="text" class="form-control" name="hot_text" value="<?php echo $banner['hot_text']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Link URL:</label>
                                <input type="text" class="form-control" name="link_url" value="<?php echo $banner['link_url']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái:</label>
                                <select class="form-control" name="status">
                                    <option value="1" <?php if ($banner['status'] == 1) echo 'selected'; ?>>Hiển thị</option>
                                    <option value="0" <?php if ($banner['status'] == 0) echo 'selected'; ?>>Ẩn</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh (nếu muốn thay đổi):</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('includes/footer.php'); } ?>
