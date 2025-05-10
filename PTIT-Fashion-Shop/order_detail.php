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
    <style>
        .action-btn {
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 10px;
            transition: 0.25s ease;
            min-width: 160px;
            color: white;
            margin-right: 36px;
        }

        .action-btn.btn-danger {
            background-color: #ba1604;
        }

        .action-btn.btn-warning {
            background-color: #3205d6;
        }

        .action-btn.btn-info {
            background-color: #049548;
        }

        .action-btn:hover:not(:disabled) {
            opacity: 0.9;
            transform: scale(1.03);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .action-btn:disabled {
            opacity: 0.5;
            pointer-events: none;
            cursor: not-allowed;
            background-color: #bdc3c7 !important;
            color: white;
            box-shadow: none;
        }
    </style>
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
        .completed+.line {
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
    function formatCurrency($amount)
    {
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
            $diff_str = "Thanh toán thừa: " . formatCurrency($payment_diff) . "Shop iu sẽ hoàn tiền sớm cho bạn nhé^^!!!";
        }
    } elseif ($payment_status === "Thanh toán thiếu") {
        $payment_diff = $total_price - $amount_paid;
        if ($payment_diff > 0) {
            $diff_str = "Thanh toán thiếu: " . formatCurrency($payment_diff) . " -> Vui lòng thanh toán đủ khi nhận hàng bạn nhé!!!";
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
                                        <th>Đánh giá</th> <!-- cột mới -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT *, products.name AS pname, order_details.status AS review_status, order_details.price AS oprice  
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

                                            <td class="text-center">
                                                <?php if ($order_status === 'Delivered' && $row1['review_status'] == 0): ?>
                                                    <button
                                                        class="btn btn-sm btn-primary review-btn"
                                                        data-detail-id="<?= $row1['id'] ?>"
                                                        data-product-id="<?= $row1['product_id'] ?>">
                                                        Đánh giá
                                                    </button>
                                                <?php elseif ($row1['review_status'] == 1): ?>
                                                    <button
                                                        class="btn btn-sm btn-link view-review-btn text-success"
                                                        data-detail-id="<?= $row1['id'] ?>">
                                                        Đã đánh giá
                                                    </button>
                                                <?php endif; ?>

                                            </td>
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
    <?php
    // Quyền thao tác
    $canCancel   = in_array($order_status, ['Processing', 'Confirmed']);
    $canExchange = $order_status === 'Delivered';
    $canReturn   = $order_status === 'Delivered';

    // Lấy yêu cầu mới nhất (nếu có)
    $rqRes = mysqli_query($conn, "
      SELECT type, status, created_at, updated_at
      FROM order_requests
      WHERE order_id = $id
      ORDER BY created_at DESC
      LIMIT 1
    ");
    $latestRq = ($rqRes && mysqli_num_rows($rqRes) > 0)
        ? mysqli_fetch_assoc($rqRes)
        : null;

    // Nhãn tiếng Việt cho type và status
    $typeLabels = [
        'cancel'   => 'Hủy đơn',
        'return'   => 'Trả hàng',
        'exchange' => 'Đổi hàng'
    ];
    $statusLabels = [
        'pending'  => ['text-warning', 'Cửa hàng Đang xử lý'],
        'approved' => ['text-success', 'Cửa hàng Đã duyệt'],
        'rejected' => ['text-danger',  ' Cửa hàng Đã từ chối']
    ];
    ?>
    <div class="container mt-4">
        <div class="card shadow-lg border-0 p-4">
            <h5 class="text-center mb-4">Thao tác đơn hàng</h5>

            <div class="d-flex justify-content-center gap-3 flex-wrap mb-3">
                <!-- Hủy đơn hàng -->
                <button
                    id="cancelOrder"
                    class="btn action-btn btn-danger request-btn"
                    data-type="cancel"
                    <?= $canCancel ? '' : 'disabled' ?>>
                    Hủy đơn hàng
                </button>

                <!-- Trả hàng -->
                <button
                    id="returnOrder"
                    class="btn action-btn btn-warning text-white request-btn"
                    data-type="return"
                    <?= $canReturn ? '' : 'disabled' ?>>
                    Trả hàng
                </button>

                <!-- Đổi hàng -->
                <button
                    id="exchangeOrder"
                    class="btn action-btn btn-info text-white request-btn"
                    data-type="exchange"
                    <?= $canExchange ? '' : 'disabled' ?>>
                    Đổi hàng
                </button>
            </div>

            <?php if ($latestRq):
                $lblType   = $typeLabels[$latestRq['type']] ?? ucfirst($latestRq['type']);
                list($cls, $lblStatus) = $statusLabels[$latestRq['status']]
                    ?? ['text-secondary', 'Không xác định'];
                $time1 = date("H:i d-m-Y", strtotime($latestRq['created_at']));
                $time2 = date("H:i d-m-Y", strtotime($latestRq['updated_at']));

            ?>
                <div class="text-center py-2 border-top">
                    <span class="fw-bold">Yêu cầu <?= $lblType ?>:</span>
                    <span class="text-muted small">Được gửi lúc (<?= $time1 ?>)</span>
                    <span> || </span>
                    <span class="<?= $cls ?>"><?= $lblStatus ?></span>
                    <span class="text-muted small">(<?= $time2 ?>)</span>
                </div>
            <?php endif; ?>

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
    <script>
        $(function() {
            // Mở modal
            $(document).on('click', '.review-btn, .view-review-btn', function() {
                const detailId = $(this).data('detail-id');
                const pid = $(this).data('product-id') || null;
                const isNew = $(this).hasClass('review-btn');

                // Đặt form
                $('#reviewForm [name="order_detail_id"]').val(detailId);
                if (pid) $('#reviewForm [name="product_id"]').val(pid);

                // Chuyển tiêu đề + nút + delete-button
                if (isNew) {
                    $('#reviewModalTitle').text('Đánh giá sản phẩm');
                    $('#reviewSubmitBtn').text('Gửi đánh giá');
                    $('#deleteReviewBtn').hide();
                    $('#reviewForm')[0].reset();
                } else {
                    $('#reviewModalTitle').text('Cập nhật đánh giá');
                    $('#reviewSubmitBtn').text('Cập nhật đánh giá');
                    $('#deleteReviewBtn').show(); // hiện nút xóa
                    // load dữ liệu cũ
                    $.getJSON('get_review.php', {
                            order_detail_id: detailId
                        })
                        .done(function(res) {
                            $('#reviewForm [name="rating"]').val(res.rating);
                            $('#reviewForm [name="comment"]').val(res.comment);
                            if (res.image) {
                                $('#previewImage').attr('src', res.image).show();
                                // nếu muốn lưu image path để xóa / override cũng có thể đặt vào hidden input
                            } else {
                                $('#previewImage').hide();
                            }
                        })
                        .fail(function() {
                            $('#reviewForm')[0].reset();
                        });
                }

                $('#reviewModal').modal('show');
            });

            $('#reviewImage').on('change', function() {
                const file = this.files[0];
                if (!file) return $('#previewImage').hide();
                const url = URL.createObjectURL(file);
                $('#previewImage').attr('src', url).show();
            });


            $('#reviewForm').on('submit', function(e) {
                e.preventDefault();
                const formEl = this;
                const formData = new FormData(formEl);

                $.ajax({
                    url: 'comment.php',
                    type: 'POST',
                    data: formData,
                    contentType: false, // bắt buộc
                    processData: false, // bắt buộc
                    dataType: 'json',
                    success(resp) {
                        if (resp.success) {
                            $('#reviewModal').modal('hide');
                            const odId = resp.order_detail_id;
                            const $td = $(`button.review-btn[data-detail-id="${odId}"]`).closest('td');
                            if ($td.length) {
                                // lần đầu
                                $td.html(`<button class="btn btn-sm btn-link view-review-btn text-success" data-detail-id="${odId}">Đã đánh giá</button>`);
                            } else {
                                alert('Cập nhật đánh giá thành công!');
                            }
                        } else {
                            alert(resp.message || 'Gửi đánh giá thất bại');
                        }
                    },
                    error() {
                        alert('Không thể kết nối đến server.');
                    }
                });
            });




            // Xóa đánh giá
            $('#deleteReviewBtn').on('click', function() {
                if (!confirm('Bạn có chắc muốn xóa đánh giá này?')) return;
                const detailId = $('#reviewForm [name="order_detail_id"]').val();

                $.post('delete_review.php', {
                    order_detail_id: detailId
                }, function(resp) {
                    if (resp.success) {
                        $('#reviewModal').modal('hide');

                        // Trả lại nút đánh giá (review-btn)
                        const $cell = $(`button.view-review-btn[data-detail-id="${detailId}"]`).closest('td');
                        $cell.html(`
                <button class="btn btn-sm btn-primary review-btn" 
                    data-detail-id="${detailId}" 
                    data-product-id="${resp.product_id}">
                    Đánh giá
                </button>
            `);
                    } else {
                        alert(resp.message || 'Xóa đánh giá thất bại');
                    }
                }, 'json');
            });


            // --- Các script khác cho request-btn (giữ nguyên) ---
            $('.request-btn').on('click', function() {
                if ($(this).is(':disabled')) return;
                const type = $(this).data('type');
                const labels = {
                    cancel: 'Hủy đơn hàng',
                    return: 'Trả hàng',
                    exchange: 'Đổi hàng'
                };
                $('#actionModalLabel').text(labels[type]);
                $('#actionSubmitBtn').text('Gửi ' + labels[type]);
                $('#actionType').val(type);
                $('#actionReason').val('');
                new bootstrap.Modal(document.getElementById('actionModal')).show();
            });

            $('#actionForm').on('submit', function(e) {
                e.preventDefault();
                $.post('order_request.php', $(this).serialize(), function(resp) {
                    if (resp.success) {
                        $('#actionModal').modal('hide');
                        alert('Gửi yêu cầu thành công!');
                        setTimeout(() => location.reload(), 500);
                    } else {
                        alert(resp.message || 'Có lỗi, vui lòng thử lại.');
                    }
                }, 'json').fail(function() {
                    alert('Không thể kết nối đến server.');
                });
            });
        });
    </script>






    <!-- Action Modal -->
    <div class="modal fade" id="actionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="actionForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionModalLabel">Yêu cầu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="order_id" value="<?= $id ?>">
                    <input type="hidden" name="type" id="actionType">
                    <div class="mb-3">
                        <label for="actionReason" class="form-label">Lý do</label>
                        <textarea name="reason" id="actionReason" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="actionSubmitBtn">Gửi</button>
                </div>
            </form>
        </div>
    </div>



    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="reviewForm" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reviewModalTitle">Đánh giá sản phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_id">
                        <input type="hidden" name="order_detail_id">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Số sao</label>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="5">5 ⭐</option>
                                <option value="4">4 ⭐</option>
                                <option value="3">3 ⭐</option>
                                <option value="2">2 ⭐</option>
                                <option value="1">1 ⭐</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Nội dung</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3" required
                                placeholder="Chia sẻ cảm nhận của bạn..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="reviewImage" class="form-label">Hình ảnh</label>
                            <input type="file" name="review_image" id="reviewImage" class="form-control" accept="image/*">
                            <img id="previewImage" src="" alt="" class="img-fluid mt-2" style="display:none; max-height:150px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger me-auto" id="deleteReviewBtn" style="display: none;">
                            Xóa đánh giá
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" id="reviewSubmitBtn">Gửi đánh giá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>