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
</head>

<body>
    <?php
    session_start();
    $is_homepage = false;
    require_once('components/header.php');

    //lay từ khóa tìm kiếm
    $danhmuc = $_GET['danhmuc'];
    $tukhoa = $_GET['tukhoa'];
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
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm mới nhất</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                                        $sql_str = "SELECT * FROM `products` order by created_at desc limit 0, 3";
                                        $result = mysqli_query($conn, $sql_str);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $anh_arr = explode(';', $row['images']);
                                        ?>
                                            <a href="sanpham.php?id=<?= $row['id'] ?>" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="<?= "http://localhost/quantri/" . $anh_arr[0] ?>" alt="">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6><?= $row['name'] ?></h6>
                                                    <!-- <span><?= $row['price'] ?></span> -->
                                                    <div class="prices">
                                                        <span class="old"><?= $row['price'] ?></span>
                                                        <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                                        $sql_str = "SELECT * FROM `products` order by created_at desc limit 3, 3";
                                        $result = mysqli_query($conn, $sql_str);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $anh_arr = explode(';', $row['images']);
                                        ?>
                                            <a href="sanpham.php?id=<?= $row['id'] ?>" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="<?= "http://localhost/quantri/" . $anh_arr[0] ?>" alt="">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6><?= $row['name'] ?></h6>
                                                    <div class="prices">
                                                        <span class="old"><?= $row['price'] ?></span>
                                                        <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <h3>Kết quả tìm kiếm</h3>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <?php
                            if ($danhmuc == '*') { ///* la tat ca danh muc nen bo qua dieu kien category_id = $danhmuc
                                $sql_str = "select * from products where
        
        name like '%$tukhoa%' 
        or description like '%$tukhoa%'
        or summary like '%$tukhoa%'
    order by name";
                            } else {
                                $sql_str = "select * from products where
        (category_id = $danhmuc)
        and 
        (name like '%$tukhoa%' 
        or description like '%$tukhoa%'
        or summary like '%$tukhoa%')
    order by name";
                            }

                            // echo $sql_str; exit;
                            $result = mysqli_query($conn, $sql_str);

                            ?>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6>Có <span><?= mysqli_num_rows($result) ?></span> sản phẩm</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $anh_arr = explode(';', $row['images']);
                        ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?= "http://localhost/quantri/" . $anh_arr[0] ?>">
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
                                        <!-- <h5><?= $row['price'] ?></h5> -->
                                        <div class="prices">
                                            <span class="old"><?= $row['price'] ?></span>
                                            <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
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
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Giảm giá</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <?php
                                $sql_str = "SELECT products.id as pid, products.name as pname, categories.name as cname, round((price - disscounted_price)/price*100) as discount, images, price, disscounted_price  FROM `products`, `categories` where products.category_id=categories.id order by discount desc limit 0, 6 ";
                                $result = mysqli_query($conn, $sql_str);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $anh_arr = explode(';', $row['images']);
                                ?>
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                data-setbg="<?= "http://localhost/quantri/" . $anh_arr[0] ?>">
                                                <div class="product__discount__percent">-<?= $row['discount'] ?>%</div>
                                                <ul class="product__item__pic__hover">

                                                    <li>
                                                        <!-- Thay thẻ <a> để thêm data-id -->
                                                        <a
                                                            class="add-to-cart"
                                                            data-id="<?= $row['pid'] ?>">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span><?= $row['cname'] ?></span>
                                                <h5><a href="sanpham.php?id=<?= $row['pid'] ?>"><?= $row['pname'] ?></a></h5>
                                                <!-- <div class="product__item__price"><?= $row['disscounted_price'] ?> <span><?= $row['price'] ?></span></div> -->
                                                <div class="prices">
                                                    <span class="old"><?= $row['price'] ?></span>
                                                    <span class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
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