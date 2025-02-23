
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Độc lạ Thời Trang | Nơi quy tụ các thiết kế thời trang hàng đầu VN</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel ="icon" href ="img/ptit.png" type="image/x-icon">
    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<style>
#header {
   padding-top: 10px;
   padding-bottom: 60px;
   border-bottom: 2px solid #ddd; 
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
    text-decoration: underline; /* Gạch chân khi hover */
}
.logIn_signIn_button {
    color: black ; /* Đặt màu chữ thành đen */
    text-decoration: none; /* Bỏ gạch chân */

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


                  if (isset($_SESSION["user"])) {
                    $username = $_SESSION["user"]["name"];
                    
 
                    
                    echo '
                    <div class="pull-right">
                        <img src="img/avt.jpg" id="icon_acount" alt="" style="border-radius: 50%; width: 55px; height: 55px; object-fit: cover;">
                        <div style="padding-top: 5px; padding-right: 0px; float: right;">
                            <b><a class="logIn_signIn_button"  href="profile.php">' . $username. '</a></b>
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
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- <div class="hero__search"> -->
                        <div class="hero__search__form">
                            <form action="timkiem.php" method="get">
                                <!-- <div class="hero__search__categories"> -->
                                    <!-- Tất cả danh mục
                                    <span class="arrow_carrot-down"></span> -->
                                    <select name="danhmuc">
                                        <option value='*'>Tất cả danh mục</option>
                                        <?php
                                        require('./db/conn.php');
                                        $sql_str = "select * from categories order by name";
                                        $result = mysqli_query($conn, $sql_str);
                                            while ($row = mysqli_fetch_assoc($result)){
                                        ?>
                                            <option value=<?=$row['id']?>><?=$row['name']?></option>
                                        <?php } ?>
                                    </select>
                                <!-- </div> -->
                                <input type="text" name="tukhoa" placeholder="Bạn cần tìm gì?">
                                <button type="submit" class="site-btn">Tìm</button>
                            </form>
                        </div>
                        
                    <!-- </div> -->
                </div>
                

                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="./cart.php"><i class="fa fa-shopping-bag"></i> <span>
                                <?php
                                    $cart = [];
                                    if (isset($_SESSION['cart'])) {
                                        $cart = $_SESSION['cart'];
                                    }
// print_r($cart);exit;
                                    $count = 0;  //hien thi so luong san pham trong gio hang
                                    $tongtien = 0;
                                    foreach ($cart as $item) {
                                        $count += $item['qty'];
                                        $tongtien += $item['qty'] * $item['disscounted_price'];
                                    }   
                                    //hien thi so luong
                                    echo $count;
                                ?>
                            </span></a></li>
                        </ul>
                        <!-- <div class="header__cart__price">Tổng tiền: <span><?=number_format($tongtien, 0, '', '.'). " VNĐ" ?></span></div> -->
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <?php   
    if ($is_homepage){
        echo '<section class="hero">';
    } else {
        echo '<section class="hero hero-normal">';
    }
    ?>
    <!-- <section class="hero"> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all" >
                            <i class="fa fa-bars"></i>
                            <span>Danh mục sản phẩm</span>
                        </div>
                        <ul>
                            <?php
                                
                                $sql_str = "select * from categories order by name";
                                $result = mysqli_query($conn, $sql_str);
                                while ($row = mysqli_fetch_assoc($result)){
                            ?>
                            <li><a href="#"><?=$row['name']?></a></li>

                            <?php } ?>
                         
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                  
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Trang chủ</a></li>
                            <li><a href="./shop.php">Cửa hàng</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="#">Shop Details</a></li>
                                    <li><a href="#">Shoping Cart</a></li>
                                    <li><a href="#">Check Out</a></li>
                                    <li><a href="#">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Tin tức</a></li>
                            <li><a href="#">Liên hệ</a></li>
                            <li><a href="./list_order.php">Đơn Hàng của bạn</a></li>
                        </ul>
                    </nav>
               
                    
                    <?php   
    if ($is_homepage){
       ?>
 <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>Rẻ, Đẹp, Chất Lượng</span>
                            <h2>Phong Cách<br /> Sáng Tạo <br/> Khác Biệt   </h2>
                           
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
<?php
    }
    ?>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
