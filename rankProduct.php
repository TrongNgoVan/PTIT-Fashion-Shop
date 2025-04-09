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

<body>
    <style>
        .price-filter-form {
            margin-top: 15px;
        }

        .price-input-group {
            display: flex;
            gap: 10px;
            align-items: flex-end;
            flex-wrap: wrap;
        }

        .price-input-item {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 120px;
        }

        .price-input-item label {
            font-weight: bold;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .price-input-item input {
            padding: 6px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .site-btn {
            padding: 4px 12px;           /* Giảm padding để nút nhỏ hơn */
            background-color:rgb(226, 7, 18);
            border: none;
            color: #fff;
            border-radius: 2px;          /* Bo góc nhẹ để ra dạng chữ nhật */
            font-size: 14px;             /* Chữ nhỏ hơn */
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .site-btn:hover {
            background-color: #e65c50;
        }
    </style>
    <?php
    session_start();
    $is_homepage = false;
    require_once('components/header.php');

    require('./db/conn.php');
    $filter_price_min = $_GET['min'] ?? 0;
    $filter_price_max = $_GET['max'] ?? 999999999;
    $filter_category = isset($_GET['category']) ? intval($_GET['category']) : 0;
    $where_clauses = ["p.status = 1"];
    if ($filter_category !== '') {
        $where_clauses[] = "p.category_id = '" . mysqli_real_escape_string($conn, $filter_category) . "'";
    }
    $where_clauses[] = "p.disscounted_price BETWEEN {$filter_price_min} AND {$filter_price_max}";
    $where_sql = implode(' AND ', $where_clauses);
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
                                    $sql_str = "SELECT * FROM categories ORDER BY name";
                                    $result = mysqli_query($conn, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Kiểm tra nếu danh mục đang được chọn thì in đậm
                                        $selected = ($row['id'] == $filter_category) ? 'style="font-weight: bold;"' : '';
                                        echo '<li><a href="?category=' . $row['id'] . '" ' . $selected . '>' . $row['name'] . '</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Giá sản phẩm</h4>
                            <form method="GET" class="price-filter-form">
                                <input type="hidden" name="category" value="<?= htmlspecialchars($filter_category) ?>">
                                <div class="price-input-group">
                                    <div class="price-input-item">
                                        <label for="min">Từ:</label>
                                        <input type="number" name="min" id="min" value="<?= $filter_price_min ?>" placeholder="Giá thấp nhất">
                                    </div>
                                    <div class="price-input-item">
                                        <label for="max">Đến:</label>
                                        <input type="number" name="max" id="max" value="<?= $filter_price_max ?>" placeholder="Giá cao nhất">
                                    </div>
                                </div>
                                <button type="submit" class="site-btn mt-2">Lọc</button>
                            </form>

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
                    <div class="row">
                        <?php
                            $category_filter = isset($_GET['category']) ? intval($_GET['category']) : 0;

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
                                AND p.disscounted_price BETWEEN {$filter_price_min} AND {$filter_price_max}
                            ";

                            
                            if ($category_filter > 0) {
                                $sql .= " AND p.category_id = $category_filter";
                            }
                            
                            $sql .= "
                                GROUP BY p.id
                                ORDER BY avg_rating DESC
                            ";
                            
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Phân tách các ảnh từ cột images
                                $anh_arr = explode(';', $row['images']);
                        ?>
                        
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?= "quantri/" . $anh_arr[0] ?>">
                                    <ul class="product__item__pic__hover">
                                        <li>
                                            <!-- Thay thẻ <a> để thêm data-id -->
                                            <a
                                                class="add-to-cart"
                                                data-id="<?= $row['id'] ?>">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="sanpham.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></h6>
                                    <div class="prices">
                                        <span class="old"><?= number_format($row['price'], 0, '', '.') . " VNĐ" ?></span>
                                        <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                    </div>
                                    <!-- Hiển thị rating và số lượng đánh giá -->
                                    <div class="product__item__rating">
                                        <p>⭐ <?= round($row['avg_rating'], 1) ?> (<?= $row['review_count'] ?> đánh giá)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
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
