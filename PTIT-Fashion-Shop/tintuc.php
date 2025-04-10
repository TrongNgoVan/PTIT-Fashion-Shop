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
<style>
    /* Giảm khoảng cách giữa menu và phần tin tức */
    .blog-details {
        padding-top: 10px !important;
        margin-top: 0px !important;
    }

    /* Kiểm soát khoảng cách tổng thể của container */
    .container {
        margin-top: 0px !important;
        padding-top: 10px !important;
    }

    /* Nếu có khoảng trắng do padding */
    .header {
        margin-bottom: 0px !important;
        padding-bottom: 0px !important;
    }

    .news-header {
        display: flex;
        align-items: center;
        gap: 15px;
        /* Khoảng cách giữa ảnh và tiêu đề */
    }

    .news-header img {
        width: 200px;
        /* Điều chỉnh kích thước avatar */
        height: 200px;
        flex-shrink: 0;
        /* Đảm bảo ảnh không bị co lại */
    }

    .news-header h2 {
        margin: 0;
        /* Loại bỏ khoảng trắng thừa */
        font-size: 26px;
        font-weight: bold;
    }
</style>

<body>
    <?php
    session_start();
    $is_homepage = false;
    require_once('components/header.php');

    require_once('./db/conn.php');
    $idsp = $_GET['id'];
    $sql_str = "select * from news where id=$idsp";
    $result = mysqli_query($conn, $sql_str);
    $row = mysqli_fetch_assoc($result);
    $anh = $row['avatar'];
    ?>



    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="#">All</a></li>
                                <?php

                                $sql_str2 = "select * from newscategories order by id";
                                $result2 = mysqli_query($conn, $sql_str2);
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                ?>
                                    <li><a href="#">
                                            <?= $row2['name'] ?> (20)
                                        </a></li>
                                <?php } ?>
                                <!-- <li><a href="#">Food (5)</a></li>
                            <li><a href="#">Life Style (9)</a></li>
                            <li><a href="#">Travel (10)</a></li> -->
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Tin mới</h4>
                            <div class="blog__sidebar__recent">

                                <?php

                                $sql_str3 = "select * from news order by created_at desc limit 0, 3";
                                $result3 = mysqli_query($conn, $sql_str3);
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                ?>
                                    <a href="#" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="<?= '/PTIT_SHOP/quantri/' . $row3['avatar'] ?>" width="70px" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6><?= $row3['title'] ?></h6>
                                            <span><?= $row3['created_at'] ?></span>
                                        </div>
                                    </a>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Tìm kiếm</h4>
                            <div class="blog__sidebar__item__tags">
                                <?php
                                $sql_str2 = "select * from newscategories order by id";
                                $result2 = mysqli_query($conn, $sql_str2);
                                while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                    <a href="#"><?= $row2['name'] ?></a>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <div class="news-header">
                            <img src="<?= '/PTIT_SHOP/quantri/' . $row['avatar'] ?>" alt="">
                            <h2><?= $row['title'] ?></h2>
                        </div>
                        <p><?= $row['description'] ?></p>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Tin tức liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $sql_str4 = "select * from news where newscategory_id=" . $row["newscategory_id"] . " and id <> " . $row['id'];
                // echo $sql_str4;
                // exit;
                $result4 = mysqli_query($conn, $sql_str4);
                while ($row4 = mysqli_fetch_assoc($result4)) {
                ?>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="<?= '/PTIT_SHOP/quantri/' . $row4['avatar'] ?>" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i><?= $row4['created_at'] ?></li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="tintuc.php?id=<?= $row4['id'] ?>"><?= $row4['title'] ?></a></h5>
                                <?= $row4['description'] ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- Related Blog Section End -->
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

</body>

</html>