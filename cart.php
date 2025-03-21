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
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">
</head>
<style>
    #header {
        padding-top: 10px;
        padding-bottom: 10px;
    }
</style>

<body>
    <?php
    session_start();
    $is_homepage = false;
    require_once('./db/conn.php');
    require_once('components/header.php');
    ?>

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Giỏ hàng</h4>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">
                                Products <span>Total</span>
                            </div>

                            <!-- Form duy nhất cho cả Xóa & Thanh toán -->
                            <form action="cart_action.php" method="POST" id="cartForm">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <!-- Checkbox chọn tất cả -->
                                                <input type="checkbox" id="checkAll" />
                                            </th>
                                            <th>STT</th>
                                            <th></th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cart = $_SESSION['cart'] ?? [];
                                        $count = 0;

                                        foreach ($cart as $item) {
                                            $count++;
                                            $subTotal = $item['disscounted_price'] * $item['qty'];
                                        ?>
                                            <tr>
                                                <!-- Checkbox cho từng sản phẩm -->
                                                <td>
                                                    <input type="checkbox"
                                                        class="checkItem"
                                                        name="selected_items[]"
                                                        value="<?= $item['id'] ?>" />
                                                </td>
                                                <td><?= $count ?></td>
                                                <td>
                                                    <img src="quantri/<?= $item['images'] ?>" style="max-width: 100px;">
                                                </td>
                                                <td><?= $item['name'] ?></td>
                                                <!-- data-value để JS lấy đơn giá -->
                                                <td class="unitPrice" data-value="<?= $item['disscounted_price'] ?>">
                                                    <?= number_format($item['disscounted_price'], 0, '', '.') . " VNĐ" ?>
                                                </td>
                                                <td>
                                                    <div class="quantity-controls d-flex align-items-center">
                                                        <button type="button"
                                                            class="btn btn-outline-secondary minus-btn"
                                                            style="width: 32px;"
                                                            data-id="<?= $item['id'] ?>">-</button>

                                                        <span class="mx-2 quantity-label" style="min-width: 20px; text-align: center;">
                                                            <?= $item['qty'] ?>
                                                        </span>

                                                        <button type="button"
                                                            class="btn btn-outline-secondary plus-btn"
                                                            style="width: 32px;"
                                                            data-id="<?= $item['id'] ?>">+</button>

                                                        <!-- Input ẩn để lưu giá trị số lượng (qty) -->
                                                        <input type="hidden"
                                                            name="qty[<?= $item['id'] ?>]"
                                                            value="<?= $item['qty'] ?>" />
                                                    </div>
                                                </td>

                                                <!-- Cột Thành tiền của mỗi sản phẩm -->
                                                <td class="subTotalCell">
                                                    <?= number_format($subTotal, 0, '', '.') . " VNĐ" ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- Hiển thị tổng tiền các sản phẩm được CHỌN -->
                                <div class="checkout__order__total">
                                    Tổng tiền (đã chọn):
                                    <span id="totalPrice">0 VNĐ</span>
                                </div>

                                <!-- Hai nút: Xóa mục đã chọn (ban đầu ẩn) & Thanh toán -->
                                <div class="d-flex justify-content-between mt-3">
                                    <!-- name=\"deleteSelected\" => phân biệt trên server -->
                                    <button type="submit"
                                        name="deleteSelected"
                                        class="btn btn-danger"
                                        id="deleteSelected"
                                        style="display: none;">
                                        Xóa mục đã chọn
                                    </button>

                                    <!-- name=\"thanhtoan\" => phân biệt trên server -->
                                    <button type="submit"
                                        name="thanhtoan"
                                        class="btn btn-success">
                                        Thanh toán
                                    </button>
                                </div>
                            </form>
                            <!-- End form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once('components/footer.php'); ?>

    <!-- Các file JS cần thiết -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Khi checkAll
            $('#checkAll').click(function() {
                $('.checkItem').prop('checked', $(this).prop('checked'));
                toggleDeleteButton();
                updateTotal();
            });

            // Khi check/uncheck từng sản phẩm
            $('.checkItem').change(function() {
                toggleDeleteButton();
                updateTotal();
            });

            // Nút "-"
            $('.minus-btn').click(function() {
                let parent = $(this).closest('.quantity-controls');
                let qtyInput = parent.find('input[type=\"hidden\"]');
                let qtyLabel = parent.find('.quantity-label');
                let productId = $(this).data('id');
                let currentVal = parseInt(qtyInput.val()) || 1;
                if (currentVal > 1) {
                    let newVal = currentVal - 1;
                    qtyInput.val(newVal);
                    qtyLabel.text(newVal);
                }

                updateSubtotalRow($(this));
                updateTotal();
                updateCartAjax(productId, newVal);
            });

            // Nút "+"
            $('.plus-btn').click(function() {
                let parent = $(this).closest('.quantity-controls');
                let qtyInput = parent.find('input[type=\"hidden\"]');
                let qtyLabel = parent.find('.quantity-label');
                let productId = $(this).data('id');

                let currentVal = parseInt(qtyInput.val()) || 1;
                let newVal = currentVal + 1;
                qtyInput.val(newVal);
                qtyLabel.text(newVal);


                updateSubtotalRow($(this));
                updateTotal();
                updateCartAjax(productId, newVal);
            });

            // 1) Hàm ẩn/hiện nút Xóa mục đã chọn
            function toggleDeleteButton() {
                let anyChecked = $('.checkItem:checked').length > 0;
                if (anyChecked) {
                    // Nếu có sản phẩm nào được check => hiển thị nút Xóa
                    $('#deleteSelected').show();
                } else {
                    // Không có => ẩn nút Xóa
                    $('#deleteSelected').hide();
                }
            }

            // 2) Cập nhật Thành tiền (subTotal) cho 1 dòng
            function updateSubtotalRow(element) {
                let row = element.closest('tr');
                let unitPrice = parseInt(row.find('.unitPrice').data('value')) || 0;
                let qty = parseInt(row.find('input[type=\"hidden\"]').val()) || 1;
                let subTotal = unitPrice * qty;

                row.find('.subTotalCell').text(subTotal.toLocaleString('vi-VN') + ' VNĐ');
            }

            // 3) Cập nhật Tổng tiền các sản phẩm được chọn
            function updateTotal() {
                let sum = 0;
                $('.checkItem:checked').each(function() {
                    let row = $(this).closest('tr');
                    let unitPrice = parseInt(row.find('.unitPrice').data('value')) || 0;
                    let qty = parseInt(row.find('input[type=\"hidden\"]').val()) || 1;
                    sum += unitPrice * qty;
                });
                $('#totalPrice').text(sum.toLocaleString('vi-VN') + ' VNĐ');
            }

            function updateCartAjax(productId, newQty) {
                $.ajax({
                    url: 'updatecart.php', // Tên file PHP trên
                    type: 'POST',
                    data: {
                        id: productId, // key phải là 'id' để khớp PHP
                        qty: newQty // key phải là 'qty'
                    },
                    success: function(response) {
                        // parse JSON
                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            console.log('Cập nhật thành công');
                        } else {
                            console.log('Lỗi:', res.message);
                        }
                    },
                    error: function() {
                        console.log('Lỗi kết nối');
                    }
                });
                console.log('updateCartAjax() được gọi với:', productId, newQty);
            }


            // Khởi tạo
            toggleDeleteButton(); // Ẩn nút Xóa nếu chưa tích
            updateTotal(); // Cập nhật tổng tiền (nếu có sẵn checkbox check)
        });
    </script>
</body>

</html>



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