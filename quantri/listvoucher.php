<?php 
require('includes/header.php');
?>

<div>

<style>
    .btn-danger { 
        color: white !important;  
        background-color: rgb(178, 5, 5) !important;  
        border-color: rgb(178, 5, 5) !important;
    }

    .btn-warning {  
        color: white !important;  
        background-color: rgb(31, 91, 222) !important;  
        border-color: rgb(37, 57, 242) !important;
    }
    .btn-warning:hover {
        color: black !important;  
        background-color: rgb(41, 105, 243) !important;  
        border-color: rgb(59, 78, 250) !important;
    }
    .btn-danger:hover { 
        color: black !important;  
        background-color: rgb(209, 4, 4) !important;  
        border-color: rgb(178, 5, 5) !important;
    }
</style>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách Mã Giảm Giá</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Loại</th>
                        <th>Giá trị</th>
                        <th>Điều kiện</th>
                        <th>Mô tả</th>
                        <th>Ảnh</th>
                        <th>Hết hạn</th>
                        <th>Đã dùng / Giới hạn</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    require('conn.php'); // Kết nối CSDL
                    $sql_str = "SELECT * FROM magiamgia ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql_str);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['code']) ?></td>
                        <td><?= $row['loai_giam_gia'] == 'tien' ? 'Tiền' : 'Phần trăm' ?></td>
                        <td><?= number_format($row['gia_tri_giam'], 0, ',', '.') ?></td>
                        <td><?= number_format($row['dieu_kien_giam'], 0, ',', '.') ?></td>
                        <td><?= $row['mo_ta'] ?></td>
                        <td>
                            <?php if ($row['image']) { ?>
                                <img src="<?= $row['image'] ?>" alt="Ảnh" style="max-width: 100px; height: auto;">
                            <?php } else { echo 'Không có'; } ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($row['ngay_het_han'])) ?></td>
                        <td><?= $row['so_luot_su_dung'] ?> / <?= $row['so_luot_gioi_han'] ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="editvoucher.php?id=<?= $row['id'] ?>">Sửa</a>  
                            <a class="btn btn-danger btn-sm" 
                               href="deletevoucher.php?id=<?= $row['id'] ?>" 
                               onclick="return confirm('Bạn chắc chắn xóa voucher này?');">Xóa</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<?php
require('includes/footer.php');
?>
