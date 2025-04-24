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
    <link rel="stylesheet" href="css/thanhtoan.css" type="text/css">
    <link rel="stylesheet" href="css/magiamgia.css" type="text/css">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">
</head>
<!-- Modal Discount Code -->



<body>


    <?php
    session_start();
    require_once('./db/conn.php');
    function convertCurrencyToFloat($str)
    {
        // Loại bỏ các ký tự không phải số và dấu chấm thập phân
        // Nếu tiền tệ của bạn sử dụng dấu chấm làm dấu phân cách hàng nghìn,
        // bạn có thể loại bỏ dấu chấm trước đó, thay vào đó, nếu có dấu phẩy làm dấu thập phân, chuyển đổi thành dấu chấm
        // Ví dụ: "2.155.000 đ" -> "2155000"
        // Hoặc "2,155,000 VNĐ" -> "2155000"

        // Loại bỏ tất cả ký tự không phải số
        $cleaned = preg_replace('/[^\d.]/', '', $str);

        // Nếu chuỗi có nhiều dấu chấm (ví dụ sử dụng dấu chấm làm ngăn cách hàng nghìn)
        // Bạn có thể loại bỏ tất cả dấu chấm và (nếu cần) thêm lại dấu chấm thập phân nếu có phần thập phân.
        // Ở đây, giả sử số tiền không có phần thập phân, nên chỉ loại bỏ tất cả dấu chấm.
        if (substr_count($cleaned, '.') > 1) {
            $cleaned = str_replace('.', '', $cleaned);
        }

        return floatval($cleaned);
    }
    $is_homepage = false;
    $name = $phone = $email = $address = "";
    $uid = 0;

    $thanhtoan = [];

    if (isset($_SESSION['thanhtoan'])) {
        $thanhtoan = $_SESSION['thanhtoan'];
    }
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $uid = $user['id'];



        // Truy vấn lấy tất cả các địa chỉ nhận hàng của người dùng từ bảng thongtinnhanhang
        $sql = "SELECT * FROM thongtinnhanhang WHERE id_user = $uid ";
        $result = mysqli_query($conn, $sql);

        $thongtin = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $thongtin[] = $row;
        }
        $email = $user['email'];

        // Lấy địa chỉ mặc định (là địa chỉ đầu tiên trong danh sách)
        if (count($thongtin) > 0) {
            $default = $thongtin[0];
            $address = implode(', ', [
                $default['diachi'],
                $default['xa'],
                $default['huyen'],
                $default['tinh']
            ]);
            $name = $default['tennguoinhan'];
            $phone = $default['sodienthoai'];
        } else {
            $address = "";
        }
    }

    // Nếu người dùng đã chọn mã giảm giá, thực hiện kiểm tra



    if (isset($_POST['btDathang'])) {

        $address_luu = mysqli_real_escape_string($conn, $_POST['address']);
        $name_luu = mysqli_real_escape_string($conn, $_POST['name']);
        $phone_luu = mysqli_real_escape_string($conn, $_POST['phone']);

        $tiensanpham = isset($_POST['product_total']) ? convertCurrencyToFloat($_POST['product_total']) : 0;
        $phivanchuyen = isset($_POST['shipping_fee']) ? convertCurrencyToFloat($_POST['shipping_fee']) : 0;
        $giamgia = isset($_POST['discount_amount']) ? convertCurrencyToFloat($_POST['discount_amount']) : 0;
        $total_end = $tiensanpham + $phivanchuyen - $giamgia;

        // Lấy phương thức vận chuyển và thanh toán từ form
        $shipping_method = mysqli_real_escape_string($conn, $_POST['shipping_method']);
        $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

        // Tính phí vận chuyển theo phương thức

        // Tính tổng đơn hàng từ các sản phẩm
        // foreach ($thanhtoan as $item) {
        //     $total_end += $item['qty'] * $item['disscounted_price'];
        // }





        $tiendachuyen = 0.0;


        // Thêm đơn hàng vào cơ sở dữ liệu
        $sqli = "INSERT INTO orders VALUES (0, $uid, '$name_luu', '$address_luu', '$phone_luu', '$email', 'Processing', NOW(), NOW(), $total_end,$tiensanpham, $phivanchuyen,$giamgia, $tiendachuyen, '$shipping_method', '$payment_method', 'Chưa thanh toán')";

        if (mysqli_query($conn, $sqli)) {
            $last_order_id = mysqli_insert_id($conn);
            foreach ($thanhtoan as $item) {
                $masp = $item['id'];
                $disscounted_price = $item['disscounted_price'];
                $qty = $item['qty'];
                $total = $item['qty'] * $item['disscounted_price'];
                $sqli2 = "insert into order_details values 
            (0, $last_order_id, $masp,  $disscounted_price, $qty, $total, now(), now())";

                // echo $sqli2, exit;
                mysqli_query($conn, $sqli2);

                $updateInventorySql = "UPDATE products 
                SET stock = stock - $qty 
                WHERE id = $masp";
                mysqli_query($conn, $updateInventorySql);
            }
            // Nếu người dùng đã áp mã giảm giá, tăng số lượt sử dụng của mã đó
            if (isset($_POST['discount_code']) && !empty($_POST['discount_code'])) {
                $discountCode = mysqli_real_escape_string($conn, $_POST['discount_code']);
                $updateVoucherSql = "UPDATE magiamgia 
                                 SET so_luot_su_dung = so_luot_su_dung + 1 
                                 WHERE code = '$discountCode'";
                mysqli_query($conn, $updateVoucherSql);
            }

            // Lưu thông tin đơn hàng vào session nếu là Thanh toán Online
            if ($payment_method == 'Thanh toán Online') {

                $_SESSION['donhang'] = [
                    'order_id' => $last_order_id,
                    'user_id' => $uid,
                    'name' => $name_luu,
                    'address' => $address_luu,
                    'phone' => $phone_luu,
                    'email' => $email,
                    'total' => $total_end,
                    'tiendachuyen' => $tiendachuyen,
                    'shipping_method' => $shipping_method,
                    'payment_method' => $payment_method,
                    'status' => 'Chưa thanh toán'
                ];

                // Điều hướng đến trang thanh toán online
                header("Location: thanhtoanonline.php");
            } else {
                // Nếu không phải Thanh toán Online, điều hướng đến trang cảm ơn
                header("Location: thankyou.php");
            }

            // Xóa session thanh toán
            unset($_SESSION["thanhtoan"]);
            exit();
        }
    }




    require_once('components/header.php');


    ?>

    <!-- nên nhớ nếu muốn hiển thị cái gì hay xử lý cái gì ngay trên giao diện thì bắt buộc phải dùng js , chứ không là nó sẽ gửi dưx liệu ngược lại cho server để server xử lý, lúc đó thì nó sẽ load lại -->
    <div id="discountModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="discountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="discountModalLabel">Danh Sách Mã Giảm Giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="coupon-list">
                        <?php
                        $sql = "SELECT * FROM magiamgia ORDER BY ngay_het_han ASC";
                        $result = $conn->query($sql); // Nếu dùng mysqli, hoặc thay đổi theo PDO nếu cần

                        if ($result && $result->num_rows > 0):
                            while ($row = $result->fetch_assoc()):
                                $gia_tri = $row['loai_giam_gia'] === 'phan_tram' ? $row['gia_tri_giam'] . '%' : number_format($row['gia_tri_giam'], 0, ',', '.') . 'đ';
                                $dieu_kien = $row['dieu_kien_giam'] > 0 ? 'Từ đơn hàng ' . number_format($row['dieu_kien_giam'], 0, ',', '.') . 'đ' : 'Không có điều kiện';
                        ?>
                                <div class="coupon-card-custom">
                                    <div class="coupon-image">
                                        <img src="<?= htmlspecialchars($row['image']) ?>" alt="Mã giảm giá" />
                                    </div>
                                    <div class="coupon-content">
                                        <p><strong>Mô tả:</strong> <?= htmlspecialchars($row['mo_ta']) ?></p>
                                        <p><strong>Giá trị giảm:</strong> <?= $gia_tri ?></p>
                                        <p><strong>Điều kiện giảm:</strong> <?= $dieu_kien ?></p>
                                        <p><strong>Số lượt đã dùng:</strong> <?= $row['so_luot_su_dung'] ?></p>
                                        <p><strong>Số lượt giới hạn:</strong> <?= $row['so_luot_gioi_han'] ?></p>
                                        <p><strong>Ngày hết hạn:</strong> <?= date("d/m/Y", strtotime($row['ngay_het_han'])) ?></p>
                                        <p><strong>Mã code:</strong> <strong><?= htmlspecialchars($row['code']) ?></strong></p>
                                        <button type="button"
                                            class="btn btn-primary select-coupon"
                                            data-code="<?= htmlspecialchars($row['code']) ?>"
                                            data-type="<?= htmlspecialchars($row['loai_giam_gia']) ?>"
                                            data-value="<?= $row['gia_tri_giam'] ?>">
                                            Chọn mã này
                                        </button>

                                    </div>
                                </div>
                            <?php endwhile;
                        else: ?>
                            <p>Hiện không có mã giảm giá nào.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Address Modal -->
    <div id="addressModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Quản lý địa chỉ nhận hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="text-right mb-3">
                        <a href="add_thongtinnhanhang.php"
                            class="btn btn-success"
                            target="_blank"
                            onclick="openAddressForm(event)">
                            <i class="fa fa-plus"></i> Thêm thông tin mới
                        </a>
                    </div>

                    <table class="table table-bordered address-table">
                        <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên Người Nhận</th>
                                <th>Số Điện Thoại</th>
                                <th>Địa Chỉ</th>
                                <th>Xã/Phường</th>
                                <th>Huyện/Quận</th>
                                <th>Tỉnh/Thành Phố</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($thongtin as $index => $info): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($info['tennguoinhan']) ?></td>
                                    <td><?= htmlspecialchars($info['sodienthoai']) ?></td>
                                    <td><?= htmlspecialchars($info['diachi']) ?></td>
                                    <td><?= htmlspecialchars($info['xa']) ?></td>
                                    <td><?= htmlspecialchars($info['huyen']) ?></td>
                                    <td><?= htmlspecialchars($info['tinh']) ?></td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-select-address"
                                            data-diachi="<?= htmlspecialchars($info['diachi']) ?>"
                                            data-xa="<?= htmlspecialchars($info['xa']) ?>"
                                            data-huyen="<?= htmlspecialchars($info['huyen']) ?>"
                                            data-tinh="<?= htmlspecialchars($info['tinh']) ?>"
                                            data-name="<?= htmlspecialchars($info['tennguoinhan']) ?>"
                                            data-phone="<?= htmlspecialchars($info['sodienthoai']) ?>">
                                            Chọn
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">

            <div class="checkout__form">
                <h4>Thông tin nhận hàng</h4>
                <button id="changeAddressBtn" class="btn btn-primary">Thay đổi thông tin nhận hàng</button>
                <form id="checkoutForm" action="#" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">


                            <div class="checkout__input">
                                <p>Họ & tên <span>*</span></p>
                                <input type="text" name="name" value="<?php echo $name; ?>" readonly>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ nhận hàng:<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ" class="checkout__input__add" name="address" value="<?php echo $address; ?>" readonly>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại:<span>*</span></p>
                                        <input type="text" name="phone" value="<?php echo $phone; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email:<span>*</span></p>
                                        <input type="text" name="email" value="<?php echo $email; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Phương thức thanh toán:<span>*</span></p>
                                        <!-- START payment-options -->
                                        <div class="payment-options">
                                            <div class="payment-cards">
                                                <!-- COD -->
                                                <label class="payment-item">
                                                    <span class="payment-label">Thanh toán khi nhận hàng</span>
                                                    <div class="payment-card">
                                                        <input type="radio" name="payment_method" value="Thanh toán khi nhận hàng" checked>
                                                        <img src="img/cod.png" alt="COD">
                                                    </div>
                                                </label>
                                                <!-- Online Banking -->
                                                <label class="payment-item">
                                                    <span class="payment-label">Thanh toán Online</span>
                                                    <div class="payment-card">
                                                        <input type="radio" name="payment_method" value="Thanh toán Online">
                                                        <img src="img/banking.jpg" alt="Banking">
                                                    </div>
                                                </label>
                                                <!-- ZaloPay -->
                                                <label class="payment-item">
                                                    <span class="payment-label">ZaloPay</span>
                                                    <div class="payment-card">
                                                        <input type="radio" name="payment_method" value="zalopay">
                                                        <img src="img/zalopay.png" alt="ZaloPay">
                                                    </div>
                                                </label>
                                                <!-- Debit Card -->
                                                <label class="payment-item">
                                                    <span class="payment-label">Thẻ ghi nợ / Debit Card</span>
                                                    <div class="payment-card">
                                                        <input type="radio" name="payment_method" value="card">
                                                        <img src="img/visadebit.png" alt="Visa Debit">
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- END payment-options -->
                                    </div>
                                </div>

                            </div>

                            <div class="row">


                                <!-- Thay thế đoạn select bằng block này -->
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Phương thức vận chuyển:<span>*</span></p>
                                        <div class="shipping-options">
                                            <div class="shipping-cards">
                                                <!-- Nhận tại cửa hàng -->
                                                <label class="shipping-item">
                                                    <span class="shipping-label">Nhận tại cửa hàng</span>
                                                    <div class="shipping-card">
                                                        <input type="radio" name="shipping_method" value="Nhận tại cửa hàng" checked>
                                                        <img src="img/1.png" alt="Nhận tại cửa hàng">
                                                    </div>
                                                </label>
                                                <!-- Vận chuyển thường -->
                                                <label class="shipping-item">
                                                    <span class="shipping-label">Vận Chuyển Thường</span>
                                                    <div class="shipping-card">
                                                        <input type="radio" name="shipping_method" value="Vận Chuyển Thường">
                                                        <img src="img/2.png" alt="Vận Chuyển Thường">
                                                    </div>
                                                </label>

                                                <!-- Vận chuyển qua hàng không -->
                                                <label class="shipping-item">
                                                    <span class="shipping-label">Vận Chuyển Hỏa Tốc</span>
                                                    <div class="shipping-card">
                                                        <input type="radio" name="shipping_method" value="Vận Chuyển Hỏa Tốc">
                                                        <img src="img/3.png" alt="Vận Chuyển Hỏa Tốc">
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng</h4>
                                <div class="checkout__order__products">Sản phẩm <span> Thành tiền</span></div>
                                <ul>
                                    <?php
                                    $thanhtoan = [];
                                    if (isset($_SESSION['thanhtoan'])) {
                                        $thanhtoan = $_SESSION['thanhtoan'];
                                    }
                                    // var_dump($thanhtoan);die();
                                    $count = 0; //số thứ tự
                                    $total = 0;
                                    // $total += $tienvanchuyen;
                                    foreach ($thanhtoan as $item) {
                                        $total += $item['qty'] * $item['disscounted_price'];
                                    ?>
                                        <li>
                                            <?= $item['name'] ?> <span>
                                                <?= number_format($item['disscounted_price'] * $item['qty'], 0, '', '.') . " VNĐ" ?>
                                            </span>
                                        </li>
                                    <?php } ?>

                                </ul>
                                <div class="checkout__order__total">
                                    Tổng tiền: <span id="orderTotal" data-amount="<?= $total ?>">
                                        <?= number_format($total, 0, '', '.') . " VNĐ" ?>
                                    </span>
                                </div>

                                <div class="checkout__order__shipping">
                                    Phí vận chuyển: <span id="shippingFee">0 VNĐ</span>
                                </div>
                                <div class="checkout__order__discount">
                                    Tiền giảm: <span id="discountAmount">0 VNĐ</span>
                                </div>
                                <!-- Input ẩn để lưu số tiền giảm giá đã áp dụng -->
                                <input type="hidden" name="discount_amount" id="discountAmountInput" value="0">
                                <input type="hidden" name="shipping_fee" id="shippingFeeInput" value="0">
                                <input type="hidden" name="product_total" id="productTotalInput" value="0">
                                <input type="hidden" name="final_total" id="finalTotalInput" value="0">


                                <div class="checkout__order__final">
                                    Thành tiền: <span id="finalTotal">
                                        <?= number_format($total, 0, '', '.') . " VNĐ" ?>
                                    </span>
                                </div>



                                <div class="discount-code">
                                    <!-- Nút mở modal mã giảm giá -->
                                    <button type="button" class="site-btn discount-btn" data-toggle="modal" data-target="#discountModal">Chọn mã giảm giá</button>

                                    <!-- Input ẩn để lưu mã giảm giá đã chọn -->
                                    <input type="hidden" name="discount_code" id="selectedDiscount" value="">



                                    <!-- ... Phần đơn hàng giữ nguyên ... -->
                                    <button type="submit" class="site-btn" name="btDathang" id="submitBtn">Đặt hàng</button>
                                    <!-- <button type="submit" class="site-btn" name="btDathangtest" id="submitBtn">Đặt hàng</button> -->

                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Đường dẫn tuyệt đối (khuyến nghị) -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <!-- Thêm sau các thẻ script khác -->
    <script src="js/shipping.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            calculateTotal();
            // Lấy đối tượng form
            const checkoutForm = document.getElementById('checkoutForm');

            // Lắng nghe sự kiện submit của form
            checkoutForm.addEventListener('submit', function(e) {
                // Danh sách các trường cần kiểm tra (bạn có thể thêm hoặc bớt theo yêu cầu)
                const requiredFields = ['name', 'address', 'phone', 'email'];
                let missingInfo = false;
                let errorMessage = "Vui lòng thêm thông tin nhận hàng:\n";

                // Duyệt qua các trường cần kiểm tra
                requiredFields.forEach(function(fieldName) {
                    const field = checkoutForm.elements[fieldName];
                    if (field && field.value.trim() === "") {
                        missingInfo = true;
                        errorMessage += "- " + fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + "\n";
                        // Bạn có thể thêm class để highlight trường bị lỗi, ví dụ:
                        field.classList.add("input-error");
                    } else if (field) {
                        // Nếu trường có dữ liệu, xóa class lỗi nếu có
                        field.classList.remove("input-error");
                    }
                });

                // Nếu có thông tin chưa nhập, ngăn submit và hiển thị cảnh báo
                if (missingInfo) {
                    e.preventDefault();
                    alert(errorMessage);
                }
            });
        });
        $(document).on('click', '.select-coupon', function() {
            calculateTotal();
            const code = $(this).data('code');
            const orderTotal = parseFloat($('#orderTotal').data('amount'));

            // Lấy phí vận chuyển hiện tại (đã được tính toán trước đó)
            const shippingFee = parseFloat($('#shippingFee').text().replace(/[^\d]/g, '')) || 0;

            // Tổng tiền trước giảm giá (bao gồm cả phí vận chuyển)
            const subtotal = orderTotal + shippingFee;

            $.ajax({
                url: 'check_coupon.php',
                method: 'POST',
                data: {
                    discount_code: code,
                    currentTotal: subtotal // Gửi tổng tiền bao gồm cả phí vận chuyển
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'error') {
                        alert(response.message);
                    } else {
                        const discountAmount = parseFloat(response.discountAmount);
                        const finalTotal = subtotal - discountAmount;

                        // Cập nhật giao diện
                        $('#selectedDiscount').val(code);
                        $('#discountAmount').text(formatCurrency(discountAmount));
                        $('#finalTotal').text(formatCurrency(finalTotal));
                        $('#discountAmountInput').val(discountAmount);
                        $('#discountModal').modal('hide');
                    }
                },
                error: function() {
                    alert("Có lỗi xảy ra khi áp dụng mã giảm giá");
                }
            });
        });

        // Hàm tính toán tổng tiền hoàn chỉnh
        function calculateTotal() {
            const orderTotal = parseFloat($('#orderTotal').data('amount'));
            const shippingFee = parseFloat($('#shippingFee').text().replace(/[^\d]/g, '')) || 0;
            const discountAmount = parseFloat($('#discountAmountInput').val()) || 0;

            const finalTotal = orderTotal + shippingFee - discountAmount;
            $('#finalTotal').text(formatCurrency(finalTotal));
            $('#productTotalInput').val(orderTotal);
            $('#shippingFeeInput').val(shippingFee);
            $('#discountAmountInput').val(discountAmount);
            $('#finalTotalInput').val(finalTotal);
        }




        // Hàm định dạng tiền tệ
        function formatCurrency(amount) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount);
        }

        // Gọi hàm khi có thay đổi
        $(document).ready(function() {
            // Theo dõi các sự kiện thay đổi
            $('#shipping_method, input[name="address"], #discountAmountInput').on('change input', function() {
                setTimeout(calculateTotal, 100);
            });

            // Khi chọn địa chỉ mới
            $(document).on('click', '.btn-select-address', function() {
                setTimeout(calculateTotal, 200);
            });
        });

        // Xử lý mở modal
        $('#changeAddressBtn').click(function() {
            $('#addressModal').modal('show');
        });

        // Xử lý chọn địa chỉ bằng nút
        $(document).on('click', '.btn-select-address', function() {
            const $btn = $(this);
            const fullAddress = [
                $btn.data('diachi'),
                $btn.data('xa'),
                $btn.data('huyen'),
                $btn.data('tinh')
            ].join(', ');

            $('input[name="name"]').val($btn.data('name'));
            $('input[name="phone"]').val($btn.data('phone'));
            $('input[name="address"]').val(fullAddress);

            $('#addressModal').modal('hide');
        });

        // Trong file thanhtoan.php
        function openAddressForm(e) {
            e.preventDefault();
            const url = e.currentTarget.href;
            window.open(url, 'addressWindow', 'width=800,height=600');
        }

        // Hàm này cần được gọi từ trang add_thongtinnhanhang.php sau khi submit thành công
        function refreshParent() {
            if (window.opener && !window.opener.closed) {
                window.opener.location.reload();
            }
            window.close();
        }
    </script>

    <?php

    require_once('components/footer.php');
    ?>

</body>

</html>