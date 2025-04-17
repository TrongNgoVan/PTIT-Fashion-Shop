<!-- Nhận xét về tốc độ hệ thống:
code rất loạn, logic các thứ đang rất rối loạn, không theo 1 kiến trúc nào cả , có nhiều phần lặp đi lặp lại,thừa, hệ thống chậm hẳn, khó cho việc maintain bảo trì và phát triển. 

-->

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
    <link rel="stylesheet" href="css/index.css" type="text/css">

    <link rel="icon" href="img/ptit.png" type="image/x-icon">
</head>
<style>
    #header {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    /* Hiệu ứng rung nhẹ */
    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-2px);
        }

        50% {
            transform: translateX(2px);
        }

        75% {
            transform: translateX(-2px);
        }
    }

    /* Hiệu ứng nhấp nháy */
    @keyframes blink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    /* Hiệu ứng nổi lên khi hover */
    .contact-icon {
        display: block;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact-icon:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.3);
    }

    /* Áp dụng hiệu ứng */
    .contact-icon.shake {
        animation: shake 0.4s infinite alternate;
    }

    .contact-icon.blink {
        animation: blink 1.5s infinite;
    }

    /* Vị trí cố định */
    .contact-box {
        position: fixed;
        bottom: 100px;
        right: 20px;
        z-index: 1000;
        text-align: center;
    }
   /* Overlay full màn hình */



    
</style>

<body>




    <?php
    session_start();
    $is_homepage = true;

    require_once('components/header.php');
    ?>





   

    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm nổi bật</h2>
                    </div>
                    
                </div>
            </div>
            <div class="row featured__filter">
                <?php
                $sql_str = "select products.id as pid, products.name as pname, images, price,disscounted_price, categories.slug as cslug from products, categories where products.category_id=categories.id; ";
                $result = mysqli_query($conn, $sql_str);
                while ($row = mysqli_fetch_assoc($result)) {
                    $anh_arr = explode(';', $row['images']);
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix <?= $row['cslug'] ?>">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="<?= "/PTIT_SHOP/quantri/" . $anh_arr[0] ?>">
                            <!--  trình duyệt đã truy cập trực tiếp đến server thì chỉ cần đường dẫn tuương đối là được, thuận lợi trong trường hợp đổi IP -->
                                <ul class="featured__item__pic__hover">
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
                            <div class="featured__item__text">
                                <h6><a href="sanpham.php?id=<?= $row['pid'] ?>"><?= $row['pname'] ?></a></h6>
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
    </section>




    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Tin tức</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php

                $sql_str = "select * from news order by created_at desc limit 0, 3";
                $result = mysqli_query($conn, $sql_str);
                while ($row = mysqli_fetch_assoc($result)) {

                ?>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="<?= '/PTIT_SHOP/quantri/' . $row['avatar'] ?>" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> <?= $row['updated_at'] ?></li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="tintuc.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a></h5>
                                <p><?= $row['sumary'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>

    <div class="contact-box">
        <!-- Nút Zalo -->
        <a href="https://zalo.me/0904708498" target="_blank">
            <img src="img/zalo.png"
                alt="Zalo" width="50" height="50"
                class="contact-icon shake"
                style="border-radius: 50%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
        </a>

        <br>

        <!-- Nút gọi điện -->
        <a href="tel:0904708498">
            <img src="https://cdn-icons-png.flaticon.com/128/724/724664.png"
                alt="Gọi điện" width="50" height="50"
                class="contact-icon blink"
                style="border-radius: 50%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
        </a>
    </div>

    <div style="position: fixed; bottom: 20px; right: 20px; z-index: 999;">
        <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
        <df-messenger
            intent="WELCOME"
            chat-title="tuvanbanhang"
            agent-id="64413262-5f38-4669-b5c3-03978e880987"
            language-code="en"></df-messenger>

    </div>


    <?php

    require_once('components/footer.php');
    ?>

    <!-- Js Plugins -->
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
            // Bắt sự kiện click vào link .add-to-cart
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
    </script>






</body>

</html>