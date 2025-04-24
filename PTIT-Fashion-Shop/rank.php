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
<style>
    /* Cải tiến giao diện sidebar */
.sidebar__item {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.sidebar__title {
    font-size: 18px;
    font-weight: 600;
    color: #d9534f; /* Màu đỏ chủ đạo */
    margin-bottom: 10px;
}

.sidebar__list {
    list-style: none;
    padding-left: 0;
}

.sidebar__list li a {
    display: block;
    padding: 8px 0;
    color: #333;
    font-size: 16px;
    text-decoration: none;
    border-bottom: 1px solid #eee;
}

.sidebar__list li a:hover {
    background-color: #f2f2f2;
    color: #d9534f; /* Màu đỏ khi hover */
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    font-size: 14px;
    width: 100%;
}

.form-control:focus {
    border-color: #d9534f; /* Màu đỏ khi focus */
    box-shadow: 0 0 5px rgba(217, 83, 79, 0.5);
}

.btn-danger {
    background-color: #d9534f; /* Màu đỏ */
    border-color: #d43f00;
}

.btn-danger:hover {
    background-color: #c9302c; /* Đổi màu khi hover */
    border-color: #ac2925;
}

select.form-control {
    height: 38px;
}

</style>

<body>
    <?php
    session_start();
    $is_homepage = false;
    require_once('components/header.php');
    // Lấy giá trị danh mục từ URL, nếu không có thì mặc định là "all"
    $category_filter = isset($_GET['category']) ? $_GET['category'] : 'all';

    // Cấu hình phân trang
    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = ($page < 1) ? 1 : $page;
    $offset = ($page - 1) * $limit;

    // Xây dựng điều kiện WHERE cho câu truy vấn SQL
    $category_condition = ($category_filter != 'all') ? "AND p.category_id = '$category_filter'" : "";

    // Đếm tổng số sản phẩm
    $count_sql = "
        SELECT COUNT(DISTINCT p.id) AS total 
        FROM products p 
        WHERE p.status = 1 $category_condition
    ";
    $count_result = mysqli_query($conn, $count_sql);
    $count_row = mysqli_fetch_assoc($count_result);
    $total_products = $count_row['total'];
    $total_pages = ceil($total_products / $limit);

    // Lấy giá trị lọc giá từ URL
    $min_price = isset($_GET['min-price']) ? (int)$_GET['min-price'] : 0;
    $max_price = isset($_GET['max-price']) ? (int)$_GET['max-price'] : PHP_INT_MAX;

    // Cập nhật điều kiện WHERE với lọc giá
    $price_condition = "AND p.disscounted_price BETWEEN $min_price AND $max_price";

    // Lấy giá trị lọc sao đánh giá từ URL
    $rating_filter = isset($_GET['rating']) ? (int)$_GET['rating'] : 0;

    // Thêm điều kiện lọc sao đánh giá vào câu truy vấn
    $rating_condition = ($rating_filter > 0) ? "HAVING AVG(r.rating) >= $rating_filter" : "";

    // Truy vấn sản phẩm với phân trang và lọc theo danh mục và sao đánh giá
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
        WHERE p.status = 1 $category_condition
        GROUP BY p.id
        $rating_condition
        ORDER BY avg_rating DESC
        LIMIT $limit OFFSET $offset
    ";


    $result = mysqli_query($conn, $sql);
    ?>

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <!-- Sidebar Danh mục -->
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar__item">
                        <h4 class="sidebar__title">Danh mục sản phẩm</h4>
                        <ul class="list-unstyled sidebar__list">
                            <li><a href="?category=all">Tất cả sản phẩm</a></li>
                            <?php
                            // Truy vấn danh mục sản phẩm từ cơ sở dữ liệu
                            $category_sql = "SELECT * FROM categories";
                            $category_result = mysqli_query($conn, $category_sql);
                            while ($category = mysqli_fetch_assoc($category_result)) {
                                echo '<li><a href="?category=' . $category['id'] . '">' . $category['name'] . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    
                    <div class="sidebar__item">
                        <h4 class="sidebar__title">Giá tiền</h4>
                        <form method="GET" action="">
                            <div class="form-group">
                                <label for="min-price">Giá thấp nhất:</label>
                                <input type="number" id="min-price" name="min-price" placeholder="Min" value="<?= isset($_GET['min-price']) ? $_GET['min-price'] : '' ?>" class="form-control mb-2">
                            </div>
                            <div class="form-group">
                                <label for="max-price">Giá cao nhất:</label>
                                <input type="number" id="max-price" name="max-price" placeholder="Max" value="<?= isset($_GET['max-price']) ? $_GET['max-price'] : '' ?>" class="form-control mb-2">
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">Lọc giá</button>
                        </form>
                    </div>

                    <div class="sidebar__item">
                        <h4 class="sidebar__title">Đánh giá</h4>
                        <form method="GET" action="">
                            <select name="rating" onchange="this.form.submit()" class="form-control">
                                <option value="">Chọn sao đánh giá</option>
                                <option value="1" <?= isset($_GET['rating']) && $_GET['rating'] == '1' ? 'selected' : '' ?>>1 Sao</option>
                                <option value="2" <?= isset($_GET['rating']) && $_GET['rating'] == '2' ? 'selected' : '' ?>>2 Sao</option>
                                <option value="3" <?= isset($_GET['rating']) && $_GET['rating'] == '3' ? 'selected' : '' ?>>3 Sao</option>
                                <option value="4" <?= isset($_GET['rating']) && $_GET['rating'] == '4' ? 'selected' : '' ?>>4 Sao</option>
                                <option value="5" <?= isset($_GET['rating']) && $_GET['rating'] == '5' ? 'selected' : '' ?>>5 Sao</option>
                            </select>
                        </form>
                    </div>
                </div>


                <!-- Hiển thị sản phẩm -->
                <div class="col-lg-9 col-md-7">
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
                            <a href="?page=<?= $page - 1 ?>&category=<?= $category_filter ?>&rating=<?= $rating_filter ?>"><i class="fa fa-long-arrow-left"></i></a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="?page=<?= $i ?>&category=<?= $category_filter ?>&rating=<?= $rating_filter ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?= $page + 1 ?>&category=<?= $category_filter ?>&rating=<?= $rating_filter ?>"><i class="fa fa-long-arrow-right"></i></a>
                        <?php endif; ?>
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