<?php
$id = intval($_GET['id']);
require('conn.php');

// Lấy thông tin đơn hàng
typically:
$sql_order = "SELECT * FROM orders WHERE id = $id";
$res_order = mysqli_query($conn, $sql_order);
$order = mysqli_fetch_assoc($res_order);

// Lấy danh sách tất cả yêu cầu với đơn này
$rqAllRes = mysqli_query($conn, 
  "SELECT id, type, status, reason, created_at, updated_at
   FROM order_requests
   WHERE order_id = $id
   ORDER BY created_at DESC"
);
$hasRequests = ($rqAllRes && mysqli_num_rows($rqAllRes) > 0);

// Xử lý form cập nhật trạng thái đơn hàng
if (isset($_POST['btnUpdate'])) {
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE id = $id");
    header('Location: ./listorders.php'); exit;
}

require('includes/header.php');
?>

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-5">
            <h1 class="h4 text-center mb-4">Xem và cập nhật trạng thái đơn hàng</h1>
            <div class="row">
                <div class="col-md-6">
                    <form method="post">
                        <?php
                        $fields = [
                            'name' => 'Khách hàng',
                            'address' => 'Địa chỉ',
                            'phone' => 'SĐT',
                            'email' => 'Email',
                            'transport' => 'Giao hàng',
                            'pay' => 'Thanh toán',
                            'status_pay' => 'Trạng thái thanh toán',
                        ];
                        foreach ($fields as $field => $label): ?>
                        <div class="mb-2 row">
                            <div class="col-4 fw-bold"><?= $label ?>:</div>
                            <div class="col-8"><?= htmlspecialchars($order[$field]) ?></div>
                        </div>
                        <?php endforeach; ?>
                        <div class="mb-3 row">
                            <label class="col-4 col-form-label fw-bold">Trạng thái đơn:</label>
                            <div class="col-8">
                                <select name="status" class="form-select">
                                    <?php
                                    $statuses = ['Processing', 'Confirmed', 'Shipping', 'Delivered', 'Cancelled'];
                                    foreach ($statuses as $st) {
                                        $sel = ($order['status'] === $st) ? 'selected' : '';
                                        echo "<option value='$st' $sel>$st</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button name="btnUpdate" class="btn btn-primary">Cập nhật</button>
                        <button type="button" class="btn btn-secondary ms-2" <?= $hasRequests ? '' : 'disabled' ?> data-bs-toggle="modal" data-bs-target="#allRequestsModal">
                            Xem yêu cầu (<?= $hasRequests ? mysqli_num_rows($rqAllRes) : 0 ?>)
                        </button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h3>Chi tiết đơn hàng</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql_details = "SELECT p.name AS pname, od.qty, od.price
                                        FROM order_details od
                                        JOIN products p ON p.id = od.product_id
                                        WHERE od.order_id = $id";
                        $res_details = mysqli_query($conn, $sql_details);
                        $no = 1;
                        while ($d = mysqli_fetch_assoc($res_details)) {
                            $total = $d['qty'] * $d['price'];
                            echo '<tr>';
                            echo '<td>' . $no . '</td>';
                            echo '<td>' . htmlspecialchars($d['pname']) . '</td>';
                            echo '<td>' . number_format($d['price'], 0, ',', '.') . ' VNĐ</td>';
                            echo '<td>' . $d['qty'] . '</td>';
                            echo '<td>' . number_format($total, 0, ',', '.') . ' VNĐ</td>';
                            echo '</tr>';
                            $no++;
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <?php
                        $summary = [
                            'tiensanpham' => 'Tiền SP',
                            'phivanchuyen' => 'Phí VC',
                            'giamgia' => 'Giảm giá',
                            'tiendachuyen' => 'Đã chuyển',
                            'total_price' => 'Tổng hóa đơn',
                        ];
                        foreach ($summary as $field => $lbl) {
                            echo "<div><strong>$lbl:</strong> " . number_format($order[$field], 0, ',', '.') . " VNĐ</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Tất cả yêu cầu -->
<div class="modal fade" id="allRequestsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tất cả yêu cầu đơn #<?= $id ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
           <form method="post" action="request_update.php?id=<?= $id ?>">
                <div class="modal-body">
                    <?php if ($hasRequests): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Thời gian gửi</th>
                                    <th>Loại</th>
                                    <th>Trạng thái xử lý</th>
                                    <th>Lý do</th>
                                    <th>Thời gian cập nhật </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $typeLabels = ['cancel' => 'Hủy đơn', 'return' => 'Trả hàng', 'exchange' => 'Đổi hàng'];
                                $stLabels = ['pending' => 'Chờ xử lý', 'approved' => 'Đã duyệt', 'rejected' => 'Từ chối'];
                                while ($rq = mysqli_fetch_assoc($rqAllRes)) {
                                    echo '<tr>';
                                    echo '<td>' . date('d-m-Y H:i', strtotime($rq['created_at'])) . '</td>';
                                    echo '<td>' . htmlspecialchars($typeLabels[$rq['type']] ?? $rq['type']) . '</td>';
                                    echo '<td>';
                                    echo '<select name="status[' . $rq['id'] . ']" class="form-select">';
                                    foreach ($stLabels as $val => $txt) {
                                        $s = ($rq['status'] === $val) ? 'selected' : '';
                                        echo '<option value="' . $val . '" ' . $s . '>' . $txt . '</option>';
                                    }
                                    echo '</select>';
                                    echo '</td>';
                                    echo '<td>' . htmlspecialchars($rq['reason']) . '</td>';
                                     echo '<td>' . date('d-m-Y H:i', strtotime($rq['updated_at'])) . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center">Chưa có yêu cầu.</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="btnReqUpdate" class="btn btn-primary">Cập nhật yêu cầu</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require('includes/footer.php'); ?>





