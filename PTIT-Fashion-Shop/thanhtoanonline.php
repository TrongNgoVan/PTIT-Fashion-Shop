<?php
session_start();
if (!isset($_SESSION['donhang'])) {
    die("<h3 style='color: red; text-align: center;'>Không tìm thấy thông tin đơn hàng!</h3>");
}
$donhang = $_SESSION['donhang'];
$order_id = $donhang['order_id'];
// Giả sử tiền cần thanh toán đã được trừ số tiền đã chuyển (nếu có)
$total = $donhang['total'] - $donhang['tiendachuyen'];
$name = $donhang['name'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh Toán Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">
</head>

<body>
    <div class="container my-5">
        <!-- Thông báo đơn hàng đã đặt thành công -->
        <h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
            </svg>
            Đặt hàng thành công
        </h1>
        <span class="text-muted">Mã đơn hàng #HDPTITSHOP<?= $order_id; ?></span>

        <!-- Box hiển thị khi thanh toán thành công (ẩn ban đầu) -->
        <div id="success_pay_box" class="p-2 text-center pt-3 border border-2 mt-5" style="display:none">
            <h2 class="text-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-check-circle text-success" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                </svg>
                Thanh toán thành công
            </h2>
            <p class="text-center text-success">
                Chúng tôi đã nhận được thanh toán, đơn hàng sẽ được chuyển đến quý khách trong thời gian sớm nhất!
            </p>
        </div>

        <!-- Box thông báo lỗi/thông báo khác (ẩn ban đầu) -->
        <div id="error_pay_box" class="alert alert-warning mt-4" style="display:none"></div>

        <!-- Giao diện thanh toán (Checkout) -->
        <div class="row mt-5" id="checkout_box">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 border text-center p-2">
                        <p class="fw-bold">Cách 1: Mở app ngân hàng và quét mã QR</p>
                        <div class="my-2">
                            <img src="https://qr.sepay.vn/img?bank=MBBank&acc=0904708498&template=compact&amount=<?= intval($total); ?>&des=HDPTITSHOP<?= $order_id; ?>" class="img-fluid" alt="QR Code">
                            <span>Trạng thái: Chờ thanh toán...
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 border p-2">
                        <p class="fw-bold">Cách 2: Chuyển khoản thủ công theo thông tin</p>
                        <div class="text-center">
                            <img src="https://qr.sepay.vn/assets/img/banklogo/MB.png" class="img-fluid" style="max-height:50px" alt="MB Bank">
                            <p class="fw-bold">Ngân hàng MBBank</p>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Chủ tài khoản: </td>
                                    <td><b>Ngọ Văn Trọng</b></td>
                                </tr>
                                <tr>
                                    <td>Số TK: </td>
                                    <td><b>0904708498</b></td>
                                </tr>
                                <tr>
                                    <td>Số tiền: </td>
                                    <td><b><?= number_format($total, 0, ',', '.'); ?>đ</b></td>
                                </tr>
                                <tr>
                                    <td>Nội dung CK: </td>
                                    <td><b>HDPTITSHOP<?= $order_id; ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="bg-light p-2">Lưu ý: Vui lòng giữ nguyên nội dung chuyển khoản HDPTITSHOP<?= $order_id; ?> để hệ thống tự động xác nhận thanh toán</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 bg-light border-top">
                <p class="fw-bold">Thông tin đơn hàng</p>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><span class="fw-bold"><?= $name; ?></span></td>
                            <td class="text-end fw-bold"><?= number_format($total, 0, ',', '.'); ?>đ</td>
                        </tr>
                        <tr>
                            <td>Thuế</td>
                            <td class="text-end">-</td>
                        </tr>
                        <tr>
                            <td><span class="fw-bold">Tổng</span></td>
                            <td class="text-end fw-bold"><?= number_format($total, 0, ',', '.'); ?>đ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-5">
            <p>
                <a id="backHome" class="text-decoration-none" href="index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg> Về trang chủ!!!
                </a>
            </p>
        </div>

    </div>

    <!-- Các file JS cần thiết -->
    <script src="api.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <script>
        var pay_status = 'Unpaid';
        // Hàm kiểm tra trạng thái thanh toán dựa vào API (sử dụng hàm checkPaid từ api.js)
        // Bắt sự kiện click vào liên kết "Về trang chủ"
        // $("#backHome").on("click", function(event) {
        //     if (pay_status === "Unpaid") {
        //         event.preventDefault(); // Ngăn chuyển hướng ngay lập tức
        //         var confirmOrder = confirm("Bạn có muốn tiếp tục đặt đơn hàng và thanh toán tại nhà không?");
        //         if (confirmOrder) {
        //             // Chuyển hướng sang trang cập nhật phương thức thanh toán
        //             window.location.href = "update_payment_method.php?order_id=<?= $order_id; ?>";
        //         } else {
        //             // Chuyển hướng sang trang xóa đơn hàng
        //             window.location.href = "delete_order.php?order_id=<?= $order_id; ?>";
        //         }
        //     }
        // });

        function check_payment_status() {
            if (pay_status === 'Unpaid') {
                checkPaid().then(data => {
                    if (data && data.error === 0) {
                        var records = data.data.records;
                        // Nội dung CK cần so sánh
                        var invoiceDesc = "HDPTITSHOP<?= $order_id; ?>";
                        // Duyệt qua danh sách giao dịch
                        for (var i = 0; i < records.length; i++) {
                            var record = records[i];
                            if (record.description.indexOf(invoiceDesc) !== -1) {
                                var recordAmount = Math.abs(record.amount);
                                // Nếu số tiền chính xác
                                if (recordAmount === <?= $total; ?>) {
                                    // Cập nhật trạng thái thanh toán thành "Paid"
                                    $.ajax({
                                        type: "POST",
                                        url: "update_payment_status.php",
                                        data: {
                                            order_id: <?= $order_id; ?>,
                                            amount: recordAmount
                                        },
                                        success: function(response) {
                                            $("#checkout_box").hide();
                                            $("#error_pay_box").hide();
                                            $("#success_pay_box").show();
                                            pay_status = 'Paid';
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Lỗi cập nhật trạng thái thanh toán:", error);
                                        }
                                    });
                                    break;
                                }
                                // Nếu số tiền chuyển khoản thừa
                                else if (recordAmount > <?= $total; ?>) {
                                    var extra = recordAmount - <?= $total; ?>;
                                    // Gửi thông tin số tiền thừa sang file PHP khác để cập nhật đơn hàng
                                    $.ajax({
                                        type: "POST",
                                        url: "update_payment_status_extra_missing.php",
                                        data: {
                                            order_id: <?= $order_id; ?>,
                                            type: "extra",
                                            amount: recordAmount
                                        },
                                        success: function(response) {
                                            $("#checkout_box").hide();
                                            $("#error_pay_box").hide();
                                            $("#success_pay_box").show();
                                            $("#success_pay_box").html("Số tiền chuyển khoản thừa: " + extra.toLocaleString() + "đ. Hệ thống sẽ sớm hoàn lại tiền cho bạn vào tài khoản hoặc lúc nhận hàng!").show();
                                            pay_status = 'Extra';
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Lỗi cập nhật trạng thái thanh toán thừa:", error);
                                        }
                                    });
                                    break;
                                }
                                // Nếu số tiền chuyển khoản thiếu
                                else if (recordAmount < <?= $total; ?>) {
                                    var missing = <?= $total; ?> - recordAmount;
                                    // Gửi thông tin số tiền thiếu sang file PHP khác để cập nhật đơn hàng
                                    $.ajax({
                                        type: "POST",
                                        url: "update_payment_status_extra_missing.php",
                                        data: {
                                            order_id: <?= $order_id; ?>,
                                            type: "missing",
                                            amount: recordAmount
                                        },
                                        success: function(response) {
                                            $("#checkout_box").hide();
                                            $("#error_pay_box").html("Số tiền chuyển khoản thiếu: " + missing.toLocaleString() + "đ. Bạn có thể thanh toán đủ khi nhận hàng!").show();
                                            pay_status = 'Missing';
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Lỗi cập nhật trạng thái thanh toán thiếu:", error);
                                        }
                                    });
                                    break;
                                }
                            }
                        }
                    }
                }).catch(error => {
                    console.error("Lỗi trong checkPaid:", error);
                });
            }
        }
        // Kiểm tra trạng thái thanh toán mỗi 2 giây
        setInterval(check_payment_status, 10000);
    </script>
</body>

</html>