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
    <link rel="stylesheet" href="css/rank.css" type="text/css">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">
</head>

<body>
    <?php
    session_start();
    $is_homepage = false;
    require_once('components/header.php');
    ?>

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục sản phẩm</h4>
                            <ul>
                                <?php
                                require('./db/conn.php');
                                $sql_str = "select * from categories order by name";
                                $result = mysqli_query($conn, $sql_str);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <li><a href="#"><?= $row['name'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <?php
                        // Cấu hình phân trang
                        $limit = 10;
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $page = ($page < 1) ? 1 : $page;
                        $offset = ($page - 1) * $limit;

                        // Đếm tổng số sản phẩm
                        $count_sql = "SELECT COUNT(DISTINCT p.id) AS total 
                                    FROM products p 
                                    WHERE p.status = 1";
                        $count_result = mysqli_query($conn, $count_sql);
                        $count_row = mysqli_fetch_assoc($count_result);
                        $total_products = $count_row['total'];
                        $total_pages = ceil($total_products / $limit);
                        // Truy vấn sản phẩm xếp hạng theo rating trung bình (cao xuống thấp)
                        $sql = "
                            SELECT 
                                p.id,
                                p.name,
                                p.slug,
                                p.summary,
                                p.price,
                                p.disscounted_price,
                                p.images,
                                IFNULL(AVG(r.rating), 0) AS avg_rating,
                                COUNT(r.id) AS review_count
                            FROM products p
                            LEFT JOIN reviews r ON p.id = r.product_id
                            WHERE p.status = 1
                            GROUP BY p.id
                            ORDER BY avg_rating DESC
                            LIMIT $limit OFFSET $offset
                        ";


                        $result = mysqli_query($conn, $sql);
                    ?>

                    <!-- Hiển thị danh sách sản phẩm -->
                    <div class="col-lg-11 col-md-12">
                        <div class="row" style="margin: 10px;">
                            <?php
                            $rank = $offset + 1;
                            while ($row = mysqli_fetch_assoc($result)) { 
                                $anh_arr = explode(';', $row['images']);
                            ?>
                            <div class="col-12 mb-4">
                                <div class="product__item d-flex align-items-center p-3 border rounded shadow-sm">
                                    <div class="product__item__pic me-4" style="margin: 10px; width: 150px; height: 150px; background-size: cover; background-position: center; background-image: url('<?= "/PTIT_SHOP/quantri/" . $anh_arr[0] ?>'); position: relative;">
                                        <div class="rank-badge">#<?= $rank++ ?></div>
                                    </div>
                                    <div class="product__item__text flex-grow-1">
                                        <h5><a href="sanpham.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h5>
                                        <div class="prices mb-2">
                                            <span class="old text-muted me-2"><del><?= number_format($row['price'], 0, '', '.') ?> VNĐ</del></span>
                                            <span class="curr text-danger fw-bold"><?= number_format($row['disscounted_price'], 0, '', '.') ?> VNĐ</span>
                                        </div>
                                        <p class="mb-1">⭐ <?= round($row['avg_rating'], 1) ?> (<?= $row['review_count'] ?> đánh giá)</p>
                                        <button class="btn btn-sm btn-primary add-to-cart" style="background: #c72f2f; border: #c72f2f;" data-id="<?= $row['id'] ?>">
                                            <i class="fa fa-shopping-cart me-1"></i> Thêm vào giỏ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <!-- Hiển thị phân trang -->
                        <div class="product__pagination mt-4">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?= $page - 1 ?>"><i class="fa fa-long-arrow-left"></i></a>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?= $page + 1 ?>"><i class="fa fa-long-arrow-right"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <?php
    require_once('components/footer.php');
    ?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.add-to-cart').click(function(e) {
                e.preventDefault(); // Chặn nhảy trang (href="#")

                // Lấy ID sản phẩm từ data-id
                let pid = $(this).data('id');
                let qty = 1;

                // Gửi AJAX đến file xử lý, ví dụ add_to_cart.php
                $.ajax({
                    url: 'add_to_cart.php',
                    type: 'POST',
                    data: {
                        pid: pid,
                        qty: qty
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            // Gọi SweetAlert2
                            Swal.fire({
                                toast: true,
                                position: 'center',
                                icon: 'success',
                                title: 'Thêm thành công!',
                                text: 'Sản phẩm đã được thêm vào Giỏ hàng!',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            // Cập nhật số lượng giỏ (nếu có)
                            // $('#cartCount').text(res.cartCount);
                        } else {
                            // Thông báo lỗi
                            Swal.fire({
                                toast: true,
                                position: 'center',
                                icon: 'error',
                                title: 'Không thể thêm sản phẩm!',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    },
                    error: function() {
                        // Thông báo lỗi kết nối
                        Swal.fire({
                            toast: true,
                            position: 'center',
                            icon: 'error',
                            title: 'Kết nối thất bại!',
                            text: 'Vui lòng kiểm tra lại đường truyền mạng.',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>