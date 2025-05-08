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
    <link rel="stylesheet" href="css/sanpham.css" type="text/css">
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

    //kiem tra nut them vao gio duoc nhan
    if (isset($_POST['atcbtn'])) {
        $id = $_POST['pid'];
        $qty = $_POST['qty'];
        // them san pham vao gio hang
        $cart = [];
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }
        // print_r($cart);
        $isFound = false;
        for ($i = 0; $i < count($cart); $i++) {
            // print_r($cart[$i]);
            if ($cart[$i]['id'] == $id) {
                $cart[$i]['qty'] += $qty;
                $isFound = true;
                break;
            }
        }
        if (!$isFound) {  //khong tim thay san pham trong gio
            $sql_str = "select * from products where id = $id";
            // echo $sql_str; exit;
            $result = mysqli_query($conn, $sql_str);
            $product = mysqli_fetch_assoc($result); //lay ra san pham
            $product['qty'] = $qty;
            $cart[] = $product;
        }

        //update session
        $_SESSION['cart'] = $cart;
        // print_r($cart); exit;
    }

    require_once('components/header.php');

    //toi uu code sau
    $idsp = $_GET['id'];
    $sql_str = "select * from products where id=$idsp";
    $result = mysqli_query($conn, $sql_str);
    $row = mysqli_fetch_assoc($result);
    $anh_arr = explode(';', $row['images']);



    $sql_reviews = "SELECT * FROM reviews WHERE product_id = $idsp ORDER BY created_at DESC";
    $result_reviews = mysqli_query($conn, $sql_reviews);
    //  xử lý comment
    // Tính tổng điểm và số lượng review của sản phẩm
    // Truy vấn tính điểm review trung bình và tổng số review của sản phẩm
    $sql_rating = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews 
               FROM reviews 
               WHERE product_id = $idsp";
    $result_rating = mysqli_query($conn, $sql_rating);
    $rating_data = mysqli_fetch_assoc($result_rating);
    $avg_rating = $rating_data['avg_rating'] ? round($rating_data['avg_rating'], 1) : 0;
    $total_reviews = $rating_data['total_reviews'] ?: 0;

    $sql_buyers = "SELECT COUNT(*) AS total_purchases 
               FROM order_details
               WHERE product_id = $idsp";
    $result_buyers = mysqli_query($conn, $sql_buyers);
    $buyers_data = mysqli_fetch_assoc($result_buyers);
    $total_purchases = $buyers_data['total_purchases'] ?: 0;





    ?>





    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?= "/PTIT_SHOP/quantri/" . $anh_arr[0] ?>"
                                alt="<?= $row['name'] ?>">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php
                            for ($i = 0; $i < count($anh_arr); $i++) {
                            ?>
                                <img data-imgbigurl="<?= "/PTIT_SHOP/quantri/" . $anh_arr[$i] ?>"
                                    src="<?= "/PTIT_SHOP/quantri/" . $anh_arr[$i] ?>">
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>
                            <?= $row['name'] ?>
                        </h3>
                        <div class="product__details__rating">
                            <?php
                            // Hiển thị số sao dựa trên điểm trung bình
                            for ($i = 0; $i < floor($avg_rating); $i++) {
                                echo '<i class="fa fa-star"></i>';
                            }
                            // Nếu có phần thập phân >= 0.5, hiển thị 1 sao bán
                            if ($avg_rating - floor($avg_rating) >= 0.5) {
                                echo '<i class="fa fa-star-half-o"></i>';
                            }
                            ?>

                            <span class="average-rating"><?= $avg_rating ?> điểm</span>
                            <span>( <?= $total_purchases ?> lượt mua)</span>
                        </div>
                        <div class="product__details__price">
                            <?= $row['price'] ?>
                        </div>
                        <p>
                            <?= $row['summary'] ?>
                        </p>
                        <form id="addCartForm">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" class="qty-text" />
                                        <input type="hidden" value="1" name="qty" />
                                    </div>
                                    <!-- Hidden chứa ID sản phẩm -->
                                    <input type="hidden" name="pid" value="<?= $idsp ?>">
                                </div>
                            </div>
                            <?php if ($row['stock'] > 0) { ?>
                                <button type="submit" class="primary-btn">Thêm vào giỏ hàng</button>
                            <?php } else { ?>
                                <button type="button" class="primary-btn" style="opacity: 0.5; cursor: not-allowed;" disabled>
                                    Tạm thời hết hàng
                                </button>
                            <?php } ?>
                        </form>

                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li>
                                <b>Tình trạng:</b>
                                <?php if ($row['stock'] > 0) { ?>
                                    <span> Còn <?= $row['stock'] ?> sản phẩm</span>
                                <?php } else { ?>
                                    <span>Tạm thời hết hàng</span>
                                <?php } ?>
                            </li>
                            <li><b>Thương hiệu:</b> <span><?= $row['brand_id'] ?></span></li>
                            <li><b>Danh mục:</b> <span><?= $row['category_id'] ?></span></li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mô tả</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Đánh giá <span>(<?= $total_reviews ?> reviews)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                
                                    <?= $row['description'] ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc review-container">


                                    <!-- Phần form viết đánh giá -->
                                    <div class="write-review-section">

                                        <form id="commentForm">

                                            <div class="form-row">
                                                <div class="rating-select">
                                                    <select name="rating">
                                                        <option value="5">5 <span class="gold-star">⭐</span></option>
                                                        <option value="4">4 <span class="gold-star">⭐</span></option>
                                                        <option value="3">3 <span class="gold-star">⭐</span></option>
                                                        <option value="2">2 <span class="gold-star">⭐</span></option>
                                                        <option value="1">1 <span class="gold-star">⭐</span></option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="submit-review-btn">Gửi đánh giá</button>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="comment" id="comment" rows="3" placeholder="Chia sẻ cảm nhận của bạn về sản phẩm..." required></textarea>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="reviews-divider"></div>
                                    <!-- Khu vực hiển thị comment -->
                                    <div id="comments_section">

                                    </div>

                                    <!-- Phần danh sách đánh giá -->

                                </div>
                            </div>

                            <style>
                                
                                /* Định dạng chung */
                                .review-container {
                                    font-family: 'Cairo', sans-serif;
                                    max-width: 100%;
                                    margin: 0 auto;
                                }

                                .review-section-title {
                                    font-size: 20px;
                                    font-weight: 600;
                                    color: #333;
                                    margin-bottom: 15px;
                                }

                                /* Phần form đánh giá */
                                .write-review-section {
                                    background-color: #f9f9f9;
                                    border-radius: 6px;
                                    padding: 15px;
                                    margin-bottom: 20px;
                                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                                }

                                .form-title {
                                    font-size: 16px;
                                    font-weight: 600;
                                    margin-bottom: 12px;
                                    color: #444;
                                }

                                .form-row {
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                    margin-bottom: 12px;
                                }

                                .rating-select select {
                                    padding: 8px 12px;
                                    border-radius: 4px;
                                    border: 1px solid #ddd;
                                    background-color: white;
                                    width: 100px;
                                    appearance: none;
                                    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
                                    background-repeat: no-repeat;
                                    background-position: right 10px center;
                                    background-size: 1em;
                                }

                                .form-group textarea {
                                    width: 100%;
                                    padding: 10px 12px;
                                    border-radius: 4px;
                                    border: 1px solid #ddd;
                                    resize: vertical;
                                    font-family: inherit;
                                    min-height: 80px;
                                    transition: border-color 0.2s ease;
                                }

                                .form-group textarea:focus {
                                    border-color: rgb(17, 28, 227);
                                    outline: none;
                                }

                                .submit-review-btn {
                                    background-color: rgb(181, 7, 7);
                                    color: white;
                                    border: none;
                                    padding: 8px 16px;
                                    border-radius: 4px;
                                    font-weight: 600;
                                    cursor: pointer;
                                    transition: background-color 0.2s ease;
                                    font-size: 14px;
                                }

                                .submit-review-btn:hover {
                                    background-color: rgb(237, 26, 26);
                                }

                                /* Phân cách giữa form và danh sách */
                                .reviews-divider {
                                    height: 1px;
                                    background-color: #eee;
                                    margin: 20px 0;
                                }

                                /* Danh sách đánh giá */
                                .reviews-title {
                                    font-size: 16px;
                                    font-weight: 600;
                                    margin-bottom: 15px;
                                    color: #444;
                                }

                                .reviews-list {
                                    max-height: 500px;
                                    overflow-y: auto;
                                    padding-right: 5px;
                                }

                                .review-item {
                                    padding: 12px 0;
                                    border-bottom: 1px solid #eee;
                                }

                                .review-item:last-child {
                                    border-bottom: none;
                                }

                                .review-header {
                                    display: flex;
                                    justify-content: space-between;
                                    margin-bottom: 8px;
                                }

                                .user-info {
                                    display: flex;
                                    align-items: center;
                                    gap: 10px;
                                }

                                .user-name {
                                    font-weight: 600;
                                    color: #333;
                                }

                                .rating-stars {
                                    color: #555;
                                }

                                .gold-star {
                                    color:  #FFD700  ;
                                    text-shadow: 0 0 1px #FFA500;
                                }

                                .review-date {
                                    color: #999;
                                    font-size: 14px;
                                }

                                .review-content p {
                                    margin: 0;
                                    color: #555;
                                    line-height: 1.5;
                                }

                                /* Tối ưu cho thiết bị di động */
                                @media (max-width: 768px) {
                                    .form-row {
                                        flex-direction: column;
                                        align-items: flex-start;
                                    }

                                    .rating-select {
                                        margin-bottom: 10px;
                                    }

                                    .submit-review-btn {
                                        width: 100%;
                                    }
                                }

                                .product__details__rating {
                                    font-size: 18px;
                                    color: #ffcc00;
                                    margin-bottom: 10px;
                                }

                                .product__details__rating i {
                                    margin-right: 2px;
                                }

                                .product__details__rating span {
                                    font-size: 14px;
                                    color: #555;
                                    margin-left: 10px;
                                }

                                .average-rating {
                                    font-weight: bold;
                                    margin-left: 10px;
                                }
                            </style>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Thêm ngôi sao vàng vào tùy chọn đánh giá
                                    const ratingSelect = document.getElementById('rating');
                                    const options = ratingSelect.options;

                                    for (let i = 0; i < options.length; i++) {
                                        const stars = '★'.repeat(parseInt(options[i].value));
                                        options[i].innerHTML = options[i].value + ' ' + stars;
                                    }

                                    // Đảm bảo tất cả ngôi sao đều có màu vàng
                                    const allStars = document.querySelectorAll('.gold-star');
                                    allStars.forEach(star => {
                                        star.style.color = '#FFD700';
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Các sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                //tim cac san pham lien quan cung category_id voi san pham nay
                $dmid = $row['category_id'];
                $sql2 = "select * from products where category_id=$dmid  and id <> $idsp";
                $result2 = mysqli_query($conn, $sql2);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $arrs = explode(";", $row2["images"]);
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?= "/PTIT_SHOP/quantri/" . $arrs[0] ?>">
                                <ul class="product__item__pic__hover">
                                    <li>
                                        <!-- Thay thẻ <a> để thêm data-id -->
                                        <a
                                            class="add-to-cart"
                                            data-id="<?= $row2['id'] ?>">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="sanpham.php?id=<?= $row2['id'] ?>"><?= $row2['name'] ?></a></h6>
                                <h5><?= $row2['disscounted_price'] ?></h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="all-products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Có thể bạn cũng thích</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php

                // Lấy category_id của sản phẩm hiện tại
                $dmid = $row['category_id'];

                // Truy vấn để lấy tất cả sản phẩm ngoại trừ sản phẩm cùng category_id
                $sql_all = "SELECT * FROM products WHERE category_id <> $dmid";
                $result_all = mysqli_query($conn, $sql_all);

                // Lặp qua danh sách sản phẩm và hiển thị
                while ($row_all = mysqli_fetch_assoc($result_all)) {
                    $arrs = explode(";", $row_all["images"]);
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?= "/PTIT_SHOP/quantri/" . $arrs[0] ?>">
                                <ul class="product__item__pic__hover">
                                    <li>
                                        <a class="add-to-cart" data-id="<?= $row_all['id'] ?>">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="sanpham.php?id=<?= $row_all['id'] ?>"><?= $row_all['name'] ?></a></h6>
                                <h5><?= $row_all['disscounted_price'] ?> VND</h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
    <?php require_once('components/footer.php'); ?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <!--  khi thông báo sản phẩm thêm vào giỏ, không nên thông báo kiểu chặn trang và yêu cầu bấm oke
      tạo thông báo kiểu hiển thị ra đấy nhưng không ảnh hưởng gì đến trang, vài giây là biến mất -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


    <script>
        $(document).ready(function() {


            loadComments();


            $('#addCartForm').submit(function(e) {
                e.preventDefault(); // Ngăn form submit reload trang

                let pid = $(this).find('input[name=\"pid\"]').val();
                let qty = $(this).find('input[name=\"qty\"]').val() || 1;

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
                            $('#cartCount').text(res.cartCount);
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
                            $('#cartCount').text(res.cartCount);
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



        $('#commentForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn không cho form gửi theo cách truyền thống

            $.ajax({
                type: 'POST',
                url: 'comment.php',
                data: $(this).serialize() + '&product_id=<?= $idsp ?>',
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.success) {
                        // Làm mới phần bình luận
                        loadComments();
                        $('#commentForm')[0].reset(); // Xóa form sau khi gửi
                    } else {
                        alert(res.message);
                    }
                }
            });
        });

        function loadComments() {
            $.get('load_comments.php?id=<?= $idsp ?>', function(data) {
                $('#comments_section').html(data);
            });
        }
    </script>



</body>

</html>