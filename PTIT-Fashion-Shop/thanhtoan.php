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
    $is_homepage = false;
    $name = $phone = $email = $address = "";
    $uid = 0;
    $total_end = 0.0;
    $thanhtoan = [];
    if (isset($_SESSION['thanhtoan'])) {
        $thanhtoan = $_SESSION['thanhtoan'];
    }
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $uid = $user['id'];
        $name = $user['name'];
        $phone = $user['phone'];
        $email = $user['email'];
        $address = $user['address'];
    }
    require_once('./db/conn.php');


    if (isset($_POST['btDathang'])) {
        // Lấy phương thức vận chuyển và thanh toán từ form
        $shipping_method = mysqli_real_escape_string($conn, $_POST['shipping_method']);
        $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    
   
        foreach ($thanhtoan as $item) {
            $total_end +=  $item['qty'] * $item['disscounted_price'];
        }
        $discount_amount = 0.0;
        if (isset($_POST['discount_amount']) && is_numeric($_POST['discount_amount'])) {
            $discount_amount = floatval($_POST['discount_amount']);
        }
        
        // Trừ tiền giảm giá khỏi tổng đơn hàng
        $total_end = $total_end - $discount_amount;
        $tiendachuyen = 0.0;
        
    
        // Thêm đơn hàng vào cơ sở dữ liệu
        $sqli = "INSERT INTO orders VALUES (0, $uid, '$name', '$address', '$phone', '$email', 'Processing', NOW(), NOW(), $total_end, $tiendachuyen, '$shipping_method', '$payment_method', 'Chưa thanh toán')";
    
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
            }
    
            // Lưu thông tin đơn hàng vào session nếu là Thanh toán Online
            if ($payment_method == 'Thanh toán Online') {
                
                $_SESSION['donhang'] = [
                    'order_id' => $last_order_id,
                    'user_id' => $uid,
                    'name' => $name,
                    'address' => $address,
                    'phone' => $phone,
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
             <?php endwhile; else: ?>
                 <p>Hiện không có mã giảm giá nào.</p>
             <?php endif; ?>
          </div>
       </div>
    </div>
  </div>
</div>

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">

            <div class="checkout__form">
                <h4>Thông tin Khách hàng</h4>
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">


                            <div class="checkout__input">
                                <p>Họ & tên <span>*</span></p>
                                <input type="text" name="name" value="<?php echo $name; ?>">
                            </div>


                            <div class="checkout__input">
                                <p>Địa chỉ nhận hàng:<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ" class="checkout__input__add" name="address" value="<?php echo $address; ?>">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại:<span>*</span></p>
                                        <input type="text" name="phone" value="<?php echo $phone; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email:<span>*</span></p>
                                        <input type="text" name="email" value="<?php echo $email; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phương thức vận chuyển:<span>*</span></p>
                                        <select name="shipping_method" id="shipping_method">
    <option value="Vận Chuyển Thường">Vận Chuyển Thường</option>
    <option value="Vận Chuyển Hỏa Tốc">Vận Chuyển Hỏa Tốc</option>
    <option value="Nhận tại cửa hàng">Nhận tại cửa hàng</option>
</select>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                    <div class="checkout__input">
                        <p>Phương thức thanh toán:<span>*</span></p>
                        <select name="payment_method" id="payment_method">
                            
                            <option value="Thanh toán Online">Thanh toán Online</option>
                            <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                        </select>
                    </div>
                </div>
                            </div>


                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng</h4>
                                <div class="checkout__order__products">Sản phẩm     <span>     Thành tiền</span></div>
                                <ul>
                                    <?php
                                    $thanhtoan = [];
                                    if (isset($_SESSION['thanhtoan'])) {
                                        $thanhtoan = $_SESSION['thanhtoan'];
                                    }
                                    // var_dump($thanhtoan);die();
                                    $count = 0; //số thứ tự
                                    $total = 0;
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
<div class="checkout__order__discount">
    Tiền giảm: <span id="discountAmount">0 VNĐ</span>
</div>
<!-- Input ẩn để lưu số tiền giảm giá đã áp dụng -->
<input type="hidden" name="discount_amount" id="discountAmountInput" value="0">

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
<script>

$(document).on('click', '.select-coupon', function() {
    const code = $(this).data('code');
    const discountType = $(this).data('type');
    const discountValue = parseFloat($(this).data('value'));
    
    // Cập nhật giá trị tổng gốc từ phí vận chuyển
    const currentTotal = parseFloat($('#orderTotal').data('amount'));
    
    let discountAmount = 0;
    
    if(discountType === 'phan_tram') {
        discountAmount = currentTotal * (discountValue / 100);
    } else {
        discountAmount = Math.min(discountValue, currentTotal);
    }
    
    // Tính lại thành tiền sau khi trừ tiền giảm giá
    const finalTotal = currentTotal - discountAmount;
    
    // Cập nhật các phần hiển thị DOM
    $('#selectedDiscount').val(code);
    $('#discountAmount').text(formatCurrency(discountAmount));
    $('#finalTotal').text(formatCurrency(finalTotal));
    
    // Lưu số tiền giảm giá vào input ẩn để gửi lên server
    $('#discountAmountInput').val(discountAmount);

    // Ẩn modal mã giảm giá
    $('#discountModal').modal('hide');
});

// Hàm định dạng tiền tệ
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(amount);
}


</script>





    <?php

    require_once('components/footer.php');
    ?>

</body>

</html>



