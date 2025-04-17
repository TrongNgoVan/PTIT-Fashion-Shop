<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PTIT Fashion Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/my.css" type="text/css">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">
</head>
<body>
    <?php
    session_start();
    $is_homepage = false;
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }
    ?>
    
    <?php require('components/header.php'); ?>

    <?php
    // Lấy id đơn hàng
    $id = $_GET['id'];
    
    // Kết nối CSDL
    require('db/conn.php');

    // Hàm định dạng tiền tệ
    function formatCurrency($amount) {
        return number_format($amount, 0, ',', '.') . ' VNĐ';
    }

    // Lấy thông tin đơn hàng
    $sql_str = "SELECT * FROM orders WHERE id = $id";
    $res = mysqli_query($conn, $sql_str);
    $row = mysqli_fetch_assoc($res);

    // Danh sách trạng thái đơn hàng
    $status_steps = [
        "Đơn Hàng Đã Đặt",
        "Đã Xác Nhận Đơn Hàng",
        "Đã Giao Cho ĐVVC",
        "Đã Nhận Được Hàng",
        "Đánh Giá"
    ];

    // Ánh xạ trạng thái CSDL -> trạng thái giao diện
    $map_status = [
        "Processing" => "Đơn Hàng Đã Đặt",
        "Confirmed"  => "Đã Xác Nhận Đơn Hàng",
        "Shipping"   => "Đã Giao Cho ĐVVC",
        "Delivered"  => "Đã Nhận Được Hàng"
    ];

    // Lấy trạng thái và ngày từ CSDL
    $order_status = $row['status'];
    $status_dates = [
        "Đơn Hàng Đã Đặt"        => $row['created_at'] ?? null,
        "Đã Xác Nhận Đơn Hàng"    => $row['updated_at'] ?? null,
        "Đã Giao Cho ĐVVC"        => $row['updated_at'] ?? null,
        "Đã Nhận Được Hàng"       => $row['updated_at'] ?? null
    ];

    // Nếu đơn bị hủy, đặt chỉ số trạng thái = -1
    if ($order_status === "Cancelled") {
        $status_index = -1;
    } else {
        $status_index = array_search($map_status[$order_status], $status_steps);
    }

    // Danh sách trạng thái thanh toán
    $payment_steps = [
        "Chưa thanh toán",
        "Thanh toán thiếu",
        "Đã thanh toán",
        "Thanh toán thừa"
    ];

    // Lấy trạng thái thanh toán và số tiền đã thanh toán từ CSDL
    $payment_status = $row['status_pay']; // Ví dụ: "Thanh toán thiếu" hoặc "Thanh toán thừa"
    $amount_paid = $row['tiendachuyen'] ?? 0; // Số tiền khách hàng đã thanh toán; nếu chưa có thì mặc định 0
    $total_price = $row['total_price']; // Tổng tiền đơn hàng
    $payment_index = array_search($payment_status, $payment_steps);

    // Tính hiệu số thanh toán (nếu quá hay thiếu)
    $payment_diff = 0;
    $diff_str = "";
    if ($payment_status === "Thanh toán thừa") {
        $payment_diff = $amount_paid - $total_price;
        if ($payment_diff > 0) {
            $diff_str = "Thanh toán thừa: " . formatCurrency($payment_diff)."Shop iu sẽ hoàn tiền sớm cho bạn nhé^^!!!";
        }
    } elseif ($payment_status === "Thanh toán thiếu") {
        $payment_diff = $total_price - $amount_paid;
        if ($payment_diff > 0) {
            $diff_str = "Thanh toán thiếu: " . formatCurrency($payment_diff) ." -> Vui lòng thanh toán đủ khi nhận hàng bạn nhé!!!" ;
        }
    }
    ?>

    <!-- Hiển thị các bước trạng thái đơn hàng -->
    <div class="container mt-4">
        <div class="card shadow-lg border-0 p-4">
            <div class="d-flex justify-content-between align-items-center text-center">
                <?php for ($i = 0; $i < count($status_steps); $i++): 
                    $completed = ($status_index !== -1 && $i <= $status_index) ? "completed" : "";
                    $date_text = isset($status_dates[$status_steps[$i]]) ? date("H:i d-m-Y", strtotime($status_dates[$status_steps[$i]])) : "";
                ?>
                    <div class="step <?= $completed ?>">
                        <div class="icon">
                            <i class="fa 
                                <?= $i == 0 ? 'fa-file-text' : ($i == 1 ? 'fa-dollar' : ($i == 2 ? 'fa-truck' : ($i == 3 ? 'fa-dropbox' : 'fa-star'))) ?>">
                            </i>
                        </div>
                        <p><?= $status_steps[$i] ?></p>
                        <small class="date"><?= $date_text ?></small>
                    </div>
                    <?php if ($i < count($status_steps) - 1): ?>
                        <div class="line <?= $completed ?>"></div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <!-- Hiển thị các bước trạng thái thanh toán -->
    <div class="container mt-4">
        <div class="card shadow-lg border-0 p-4">
            <div class="d-flex justify-content-between align-items-center text-center">
                <?php for ($i = 0; $i < count($payment_steps); $i++):
                    $active = $i <= $payment_index ? "completed" : "";
                ?>
                    <div class="step <?= $active ?>">
                        <div class="icon">
                            <i class="fa 
                                <?= $i == 0 ? 'fa-times-circle' : ($i == 1 ? 'fa-exclamation-circle' : ($i == 2 ? 'fa-check-circle' : 'fa-plus-circle')) ?>">
                            </i>
                        </div>
                        <p><?= $payment_steps[$i] ?></p>
                    </div>
                    <?php if ($i < count($payment_steps) - 1): ?>
                        <div class="line <?= $active ?>"></div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            <?php if (!empty($diff_str)): ?>
                <div class="text-end mt-3">
                    <h5 class="fw-bold text-danger"><?= $diff_str ?></h5>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 120px;
        }
        .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ccc;
            /* Mặc định màu xám */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .line {
            flex: 1;
            height: 4px;
            background-color: #ccc;
            margin: 0 10px;
        }
        .completed .icon,
        .completed + .line {
            background-color: #28a745;
        }
        .date {
            font-size: 12px;
            color: gray;
        }
        .small-currency {
            font-size: 1.1rem;
        }
        .discount {
            color: red;
            font-weight: bold;
        }
    </style>

    <!-- Thông tin khách hàng & chi tiết đơn hàng -->
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <div class="row">
                    <!-- Thông tin khách hàng -->
                    <div class="col-md-4">
                        <div class="card p-4 border-0 shadow-sm">
                            <h5 class="mb-3">Thông tin khách hàng</h5>
                            <div class="row mb-2">
                                <div class="col-4 fw-bold">Họ Tên:</div>
                                <div class="col-8"><?= $row['name'] ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 fw-bold">Địa chỉ:</div>
                                <div class="col-8"><?= $row['address'] ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 fw-bold">Phone:</div>
                                <div class="col-8"><?= $row['phone'] ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4 fw-bold">Email:</div>
                                <div class="col-8"><?= $row['email'] ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6 fw-bold">Trạng thái đơn:</div>
                                <div class="col-6">
                                    <span class="badge bg-<?= ($row['status'] == 'Confirmed' ? 'success' : 'danger') ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </div>
                            </div>
                            <a href="list_order.php" class="btn btn-danger px-4">Quay lại</a>
                        </div>
                    </div>

                    <!-- Chi tiết đơn hàng -->
                    <div class="col-md-8">
                        <div class="card p-4 border-0 shadow-sm">
                            <h5 class="mb-3">Chi tiết đơn hàng</h5>
                            <table class="table table-bordered">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>STT</th>
                                        <th></th>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT *, products.name AS pname, order_details.price AS oprice  
                                            FROM products, order_details
                                            WHERE products.id = order_details.product_id 
                                            AND order_id = $id";
                                    $res = mysqli_query($conn, $sql);
                                    $stt = 0;
                                    while ($row1 = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= ++$stt ?></td>
                                            <td>
                                                <img src="/PTIT_SHOP/quantri/<?= $row1['images'] ?>" style="max-width: 100px;">
                                            </td>
                                            <td><?= $row1['pname'] ?></td>
                                            <td class="text-end"><?= number_format($row1['oprice'], 0, '', '.') ?> VNĐ</td>
                                            <td class="text-center"><?= $row1['qty'] ?></td>
                                            <td class="text-end"><?= number_format($row1['total'], 0, '', '.') ?> VNĐ</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="text-end mt-3">
                                <h5 class="fw-bold">Tiền sản phẩm: <?= number_format($row['tiensanpham'], 0, '', '.') ?> VNĐ</h5>
                            </div>
                            <div class="text-end mt-3">
                                <h5 class="currency small-currency">Phí vận chuyển: <?= number_format($row['phivanchuyen'], 0, '', '.') ?> VNĐ</h5>
                            </div>
                            <div class="text-end mt-3">
                                <h5 class="currency discount small-currency">Giảm giá: -<?= number_format($row['giamgia'], 0, '', '.') ?> VNĐ</h5>
                            </div>
                            <div class="text-end mt-3">
                                <h5 class="fw-bold">Tổng tiền: <?= number_format($row['total_price'], 0, '', '.') ?> VNĐ</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('components/footer.php'); ?>

    <!-- JS Scripts -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
