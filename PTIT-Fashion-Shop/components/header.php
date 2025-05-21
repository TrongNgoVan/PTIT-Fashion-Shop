<!DOCTYPE html>
<html lang="en">

<head>


</head>
<style>
    #header {
        padding-top: 10px;
        padding-bottom: 60px;
        border-bottom: 2px solid #ddd;
        font-family: inherit;
    }

    #icon_acount {
        height: 50px;
        width: 50px;
        padding: 0px;
        margin-right: 10px;
        float: left;
    }

    /* Các nút đăng nhập và đăng ký, đăng xuất và tên người dùng trên góc phải màn hình */
    .logIn_signIn_button:hover {
        cursor: pointer;
        color: blue;
        text-decoration: underline;
        /* Gạch chân khi hover */
    }

    .logIn_signIn_button {
        color: black;
        /* Đặt màu chữ thành đen */
        text-decoration: none;
        /* Bỏ gạch chân */

    }

    .hero__text {
        animation: fadeInUp 0.5s ease-in-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero__item {
        position: relative;
        background-size: cover;
        background-position: center;
        text-align: left;
        /* Căn chỉnh văn bản sang trái */
        padding: 100px 50px;
    }

    .hero__text {
        color: white;
        max-width: 500px;
    }

    .hero__text span {
        color: rgb(209, 6, 6);
        /* Màu vàng sáng */
        font-size: 18px;
        font-weight: bold;
    }

    .hero__text h2 {
        font-size: 48px;
        font-weight: bold;
        color: rgba(16, 1, 1, 0.93);
    }

    .marquee {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        position: relative;
        display: flex;
        align-items: center;
    }

    .marquee p {
        display: inline-block;
        padding-left: 100%;
        animation: marqueeScroll 5s linear infinite;
        margin: 0;
        color: rgb(247, 247, 245) !important;
        /* Màu đỏ tươi nổi bật */
        font-size: 25px;
        margin-top: 15px;
        font-weight: bold;
        /* Chữ đậm */
    }

    @keyframes marqueeScroll {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(-100%);
        }
    }

    .primary-btn:hover {
        background-color: rgb(226, 7, 18);
        /* Đổi màu khi hover */
        color: #000;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: none;
        /* ẩn mặc định */
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
    }

    /* Nội dung modal, dùng background-image của hero */
    .hero-modal {
        position: relative;
        width: 100%;
        max-width: 800px;
        height: 450px;
        background-size: cover;
        background-position: center;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        align-items: flex-end;
        color: #fff;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    }

    /* Nút đóng */
    .modal-close {
        position: absolute;
        top: 10px;
        right: 14px;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        font-size: 28px;
        line-height: 1;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
    }

    .hero__search__form .input-group {
        width: 100%;
        display: flex;
        align-items: center;
    }

    .hero__search__form button {
        width: 100px;  
        background:  #b30000;
        border: #b30000;
    }

    .hero__search__form .btn:hover {
        background-color: #990000;
    }

    .dm-border {
        margin-top: 10px;
    }

    .dm-title {
        font-size: 20px;
        font-weight: bold;
        color: #000;
        border-bottom: 2px solid  #b30000;
        padding-bottom: 8px;
    }

    .dm-item li {
        margin-bottom: 10px;
    }

    .dm-item li a {
        display: block;
        padding: 8px 12px;
        border-radius: 6px;
        background-color: #f8f9fa;
        color: #333;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
    }

    .dm-item li a::before {
        content: "•";
        color: #007bff;
        font-weight: bold;
        margin-right: 8px;
    }

    .menu-header li {
        margin-right: 5px;
        margin-left: 10px;
    }

</style>


<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>

    <!-- Header Section Begin -->
    <header class="header">


        <div class="container" id="header" style="">
            <div class="pull-left">
                <a href="index.php">
                    <img src="img/lg3.png" alt="">
                </a>
            </div>
            <?php
            require('./db/conn.php');

            $sql_banner = "SELECT * FROM banner WHERE status = 1";
            $result_banner = mysqli_query($conn, $sql_banner);
            $banner = mysqli_fetch_assoc($result_banner);


            if (isset($_SESSION["user"])) {
                $username = $_SESSION["user"]["name"];

                $AVATAR =  $_SESSION["user"]["avatar"];



                echo '
                    <div class="pull-right">
                        <img src="' . $AVATAR . '" id="icon_acount" alt="" style="border-radius: 50%; width: 55px; height: 55px; object-fit: cover;">
                        <div style="padding-top: 5px; padding-right: 0px; float: right;">
                            <b><a class="logIn_signIn_button"  href="profile.php">' . $username . '</a></b>
                            <br>
                            <a class="logIn_signIn_button"  href="logout.php" >Đăng xuất</a>
                        </div>
                    </div>';
            } else {
                echo '<div class="pull-right">
                            <img src="img/icon-account.png" id="icon_acount" alt="" style="border-radius: 50%; width: 55px; height: 55px; object-fit: cover;">
                            <div style="padding-top: 5px; padding-right: 0px; float: right;">
                                <b> <a class="logIn_signIn_button"  href="login.php">  Đăng nhập</a></b>
                                <br>
                                <a class="logIn_signIn_button" href="register.php" > Đăng ký</a>
                            </div>
                        </div>';
            }
            ?>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero__search__form">
                        <form action="timkiem.php" method="get" class="d-flex">
                            <!-- Thanh tìm kiếm -->
                            <div class="input-group flex-grow-1">
                                <input type="text" name="tukhoa" class="form-control" placeholder="Bạn cần tìm gì?">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Tìm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3 ml-auto">
                    <div class="header__cart">
                        <ul>
                            <li><a><b>Giỏ Hàng</b></a></li>
                            <li><a href="./cart.php"><i class="fa fa-shopping-cart"></i> <span id="cartCount">
                                <?php
                                $cart = [];
                                if (isset($_SESSION['cart'])) {
                                    $cart = $_SESSION['cart'];
                                }
                                $count = 0;  // Hiển thị số lượng sản phẩm trong giỏ hàng
                                foreach ($cart as $item) {
                                    $count += 1;
                                }
                                echo $count;
                                ?>
                            </span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <?php
    if ($is_homepage) {
        echo '<section class="hero">';
    } else {
        echo '<section class="hero hero-normal">';
    }
    ?>
    <!-- <section class="hero"> -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-3 mb-lg-3 dm-border">
                <div class="p-3 bg-light rounded shadow-sm">
                    <h5 class="mb-3 dm-title"><i class="fa fa-bars me-2"></i> Danh mục sản phẩm</h5>

                    <?php
                    // Kiểm tra nếu là trang chủ (index.php)
                    if (basename($_SERVER['PHP_SELF']) == 'index.php') {
                        echo '<ul class="list-unstyled dm-item">';
                        $category_sql = "SELECT * FROM categories ORDER BY name";
                        $category_result = mysqli_query($conn, $category_sql);
                        while ($category = mysqli_fetch_assoc($category_result)) {
                            echo '<li href="?category=' . $category['id'] . '">' . $category['name'] . '</li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>

            </div>
            <div class="col-lg-9">
                <nav class="header__menu mb-3">
                    <ul class="menu-header d-flex justify-content-between flex-wrap list-unstyled m-0 p-0">
                        <li class="active"><a href="./index.php">Trang chủ</a></li>
                        <li><a href="./shop.php">Cửa hàng</a></li>
                        <li><a href="magiamgia.php">Mã giảm giá</a>
                        </li>
                        <!-- <li><a href="./tintuc.php?id=1">Tin tức</a></li> -->
                        <li><a href="./rank.php">Xếp hạng</a></li>
                        <li><a href="./list_order.php">Đơn Hàng của bạn</a></li>
                        <li><a href="./thongtinnhanhang.php">Thông tin nhận hàng</a></li>
                    </ul>
                </nav>
                <?php
                if ($is_homepage) {
                    if ($banner) {
                ?>
                        <div class="hero__item set-bg" data-setbg="<?php echo $banner['image_path']; ?>">
                            <div class="hero__text">
                                <span>Rẻ, Đẹp, Chất Lượng</span>
                                <h2>Phong Cách<br /> Sáng Tạo <br /> Khác Biệt</h2>

                                <a href="<?php echo $banner['link_url']; ?>" class="primary-btn">SHOP NOW</a>
                                <div class="marquee">
                                    <p>🔥🔥 <?php echo htmlspecialchars($banner['hot_text']); ?> 🎁 🔥 🚀</p>
                                </div>
                            </div>

                        </div>


                        <!-- BANNER NỔI -->
                        <!-- Modal Hero Banner -->
                        <div id="heroModal" class="modal-overlay">
                            <div class="modal-content hero-modal" style="background-image: url('<?= $banner['image_path'] ?>')">
                                <button class="modal-close">&times;</button>
                                <div class="hero__text">
                                    <span>Rẻ, Đẹp, Chất Lượng</span>
                                    <h2>Phong Cách<br /> Sáng Tạo <br /> Khác Biệt</h2>
                                    <a href="<?= $banner['link_url'] ?>" class="primary-btn">SHOP NOW</a>
                                    <div class="marquee">
                                        <p>🔥🔥 <?= htmlspecialchars($banner['hot_text']) ?> 🎁 🔥 🚀</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('heroModal');
            var closeBtn = modal.querySelector('.modal-close');

            // Hiện modal
            modal.style.display = 'flex';

            // Đóng modal khi click nút
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        });
    </script>
    <!-- Hero Section End -->