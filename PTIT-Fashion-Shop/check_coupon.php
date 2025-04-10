<?php
// check_coupon.php
require_once('./db/conn.php');

header('Content-Type: application/json');

if (isset($_POST['discount_code']) && isset($_POST['currentTotal'])) {
    $discount_code = mysqli_real_escape_string($conn, $_POST['discount_code']);
    $currentTotal = floatval($_POST['currentTotal']);

    // Truy vấn lấy thông tin mã giảm giá từ bảng magiamgia
    $sql = "SELECT * FROM magiamgia WHERE code = '$discount_code'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $coupon = mysqli_fetch_assoc($result);

        // Kiểm tra ngày hết hạn
        if (strtotime($coupon['ngay_het_han']) < time()) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Mã giảm giá đã hết hạn.'
            ]);
            exit();
        }

        // Kiểm tra số lượt sử dụng so với số lượt giới hạn
        if ($coupon['so_luot_su_dung'] >= $coupon['so_luot_gioi_han']) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Mã giảm giá đã được sử dụng hết số lượt cho phép.'
            ]);
            exit();
        }

        // Kiểm tra điều kiện đơn hàng nếu có
        if ($coupon['dieu_kien_giam'] > 0 && $currentTotal < $coupon['dieu_kien_giam']) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Đơn hàng của bạn chưa đạt điều kiện áp dụng mã giảm giá này.'
            ]);
            exit();
        }

        // Tính số tiền giảm dựa theo loại giảm giá
        if ($coupon['loai_giam_gia'] === 'phan_tram') {
            $discountAmount = $currentTotal * ($coupon['gia_tri_giam'] / 100);
        } else {
            $discountAmount = min($coupon['gia_tri_giam'], $currentTotal);
        }

        echo json_encode([
            'status'         => 'success',
            'discountAmount' => $discountAmount
        ]);
    } else {
        echo json_encode([
            'status'  => 'error',
            'message' => 'Mã giảm giá không hợp lệ.'
        ]);
    }
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Dữ liệu không đầy đủ.'
    ]);
}
?>
