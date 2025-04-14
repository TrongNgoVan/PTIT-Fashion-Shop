<?php
$id = $_GET['id'];
require('conn.php');

// Lấy thông tin đơn hàng
$sql_order = "SELECT * FROM orders WHERE id = $id";
$res_order = mysqli_query($conn, $sql_order);
$order = mysqli_fetch_assoc($res_order);

// Cập nhật trạng thái đơn hàng nếu gửi form
if (isset($_POST['btnUpdate'])) {
    $status = $_POST['status'];
    $sql_update = "UPDATE orders SET status = '$status' WHERE id = $id";
    mysqli_query($conn, $sql_update);
    header("Location: ./listorders.php");
    exit;
} else {
    require('includes/header.php');
?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Xem và cập nhật trạng thái đơn hàng</h1>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <form method="post">
                                    <div class="row"><div class="col-md-4">Khách hàng:</div><div class="col-md-8"><?= $order['name'] ?></div></div>
                                    <div class="row"><div class="col-md-4">Địa chỉ:</div><div class="col-md-8"><?= $order['address'] ?></div></div>
                                    <div class="row"><div class="col-md-4">SĐT:</div><div class="col-md-8"><?= $order['phone'] ?></div></div>
                                    <div class="row"><div class="col-md-4">Email:</div><div class="col-md-8"><?= $order['email'] ?></div></div>
                                    <div class="row"><div class="col-md-4">Hình thức giao hàng:</div><div class="col-md-8"><?= $order['transport'] ?></div></div>
                                    <div class="row"><div class="col-md-4">Thanh toán:</div><div class="col-md-8"><?= $order['pay'] ?></div></div>
                                    <div class="row"><div class="col-md-4">Trạng thái thanh toán:</div><div class="col-md-8"><?= $order['status_pay'] ?></div></div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">Trạng thái đơn hàng:</div>
                                        <div class="col-md-8">
                                            <select name="status" class="form-control">
                                                <?php
                                                $statuses = ['Processing','Confirmed','Shipping','Delivered','Cancelled'];
                                                foreach ($statuses as $st) {
                                                    $selected = $order['status'] == $st ? 'selected' : '';
                                                    echo "<option value=\"$st\" $selected>$st</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary mt-3" name="btnUpdate">Cập nhật</button>
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
                                        $sql_details = "SELECT products.name AS pname, order_details.qty, order_details.price 
                                                        FROM order_details 
                                                        JOIN products ON products.id = order_details.product_id 
                                                        WHERE order_details.order_id = $id";
                                        $res_details = mysqli_query($conn, $sql_details);
                                        $stt = 1;
                                        $tong = 0;
                                        while ($detail = mysqli_fetch_assoc($res_details)) {
                                            $thanhtien = $detail['qty'] * $detail['price'];
                                            $tong += $thanhtien;
                                            echo "<tr>
                                                    <td>{$stt}</td>
                                                    <td>{$detail['pname']}</td>
                                                    <td>" . number_format($detail['price'], 0, ',', '.') . " VNĐ</td>
                                                    <td>{$detail['qty']}</td>
                                                    <td>" . number_format($thanhtien, 0, ',', '.') . " VNĐ</td>
                                                  </tr>";
                                            $stt++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    <strong>Tiền sản phẩm:</strong> <?= number_format($order['tiensanpham'], 0, ',', '.') ?> VNĐ<br>
                                    <strong>Phí vận chuyển:</strong> <?= number_format($order['phivanchuyen'], 0, ',', '.') ?> VNĐ<br>
                                    <strong>Giảm giá:</strong> <?= number_format($order['giamgia'], 0, ',', '.') ?> VNĐ<br>
                                    <strong>Thành tiền đã chuyển:</strong> <?= number_format($order['tiendachuyen'], 0, ',', '.') ?> VNĐ<br>
                                    <strong>Tổng hóa đơn:</strong> <?= number_format($order['total_price'], 0, ',', '.') ?> VNĐ
                                </div>
                            </div>
                        </div> <!-- row -->
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
