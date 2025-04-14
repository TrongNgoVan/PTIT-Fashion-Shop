<?php
require('conn.php');

// Lấy id mã giảm giá từ URL
$id = $_GET['id'];

// Lấy dữ liệu mã giảm giá theo id
$sql_str = "SELECT * FROM magiamgia WHERE id = $id";
$res = mysqli_query($conn, $sql_str);
$magiamgia = mysqli_fetch_assoc($res);

// Nếu form được submit
if (isset($_POST['btnUpdate'])) {
    $code = $_POST['code'];
    $loai_giam_gia = $_POST['loai_giam_gia'];
    $gia_tri_giam = $_POST['gia_tri_giam'];
    $dieu_kien_giam = $_POST['dieu_kien_giam'];
    $mo_ta = $_POST['mo_ta'];
    $image = $_POST['image'];
    $ngay_het_han = $_POST['ngay_het_han'];
    $so_luot_su_dung = $_POST['so_luot_su_dung'];
    $so_luot_gioi_han = $_POST['so_luot_gioi_han'];

    // Cập nhật dữ liệu mã giảm giá
    $sql_update = "UPDATE magiamgia 
                   SET code=?, loai_giam_gia=?, gia_tri_giam=?, dieu_kien_giam=?, mo_ta=?, image=?, ngay_het_han=?, so_luot_su_dung=?, so_luot_gioi_han=? 
                   WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql_update);
    
    // Binding tham số với kiểu: "ssddsssiii"
    mysqli_stmt_bind_param($stmt, "ssddsssiii", $code, $loai_giam_gia, $gia_tri_giam, $dieu_kien_giam, $mo_ta, $image, $ngay_het_han, $so_luot_su_dung, $so_luot_gioi_han, $id);
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Quay lại danh sách mã giảm giá
    header("Location: listvoucher.php");
    exit();
} else {
    // Hiển thị form nếu chưa submit
    require('includes/header.php');
?>
<!-- Giao diện form cập nhật mã giảm giá -->
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Cập nhật Mã Giảm Giá</h1>
                        </div>
                        <form class="user" method="post">
                            <div class="form-group">
                                <label>Mã Giảm Giá:</label>
                                <input type="text" class="form-control" name="code" value="<?= htmlspecialchars($magiamgia['code']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Loại Giảm Giá:</label>
                                <select class="form-control" name="loai_giam_gia">
                                    <option value="tien" <?= $magiamgia['loai_giam_gia'] == 'tien' ? 'selected' : '' ?>>Theo tiền</option>
                                    <option value="phan_tram" <?= $magiamgia['loai_giam_gia'] == 'phan_tram' ? 'selected' : '' ?>>Theo phần trăm</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Giá Trị Giảm:</label>
                                <input type="number" step="0.01" class="form-control" name="gia_tri_giam" value="<?= htmlspecialchars($magiamgia['gia_tri_giam']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Điều Kiện Giảm (đơn hàng tối thiểu):</label>
                                <input type="number" step="0.01" class="form-control" name="dieu_kien_giam" value="<?= htmlspecialchars($magiamgia['dieu_kien_giam']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Mô Tả:</label>
                                <textarea class="form-control" name="mo_ta"><?= htmlspecialchars($magiamgia['mo_ta']) ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Ảnh (đường dẫn):</label>
                                <input type="text" class="form-control" name="image" value="<?= htmlspecialchars($magiamgia['image']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Ngày Hết Hạn:</label>
                                <input type="date" class="form-control" name="ngay_het_han" value="<?= htmlspecialchars($magiamgia['ngay_het_han']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Số Lượt Sử Dụng:</label>
                                <input type="number" class="form-control" name="so_luot_su_dung" value="<?= htmlspecialchars($magiamgia['so_luot_su_dung']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Số Lượt Giới Hạn:</label>
                                <input type="number" class="form-control" name="so_luot_gioi_han" value="<?= htmlspecialchars($magiamgia['so_luot_gioi_han']) ?>">
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
<?php 
    require('includes/footer.php'); 
} 
?>
