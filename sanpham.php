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
    <link rel ="icon" href ="img/ptit.png" type="image/x-icon">
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
                $cart[$i]['qty']+= $qty; 
                $isFound = true;
                break;
            }
        }
        if (!$isFound) {  //khong tim thay san pham trong gio
            $sql_str = "select * from products where id = $id";
            // echo $sql_str; exit;
            $result = mysqli_query($conn, $sql_str);
            $product = mysqli_fetch_assoc($result);//thuc thi cau lenh ('select * from products where id = '.$id, true);
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
  
    if (isset($_POST['rating'])&& isset($_POST['comment'])) {
        if (isset($_SESSION['user'])) { // Kiểm tra xem user đã đăng nhập chưa
            $user_id = $_SESSION['user']['id'];
            $rating = $_POST['rating'];
            $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    
            $sql_insert = "INSERT INTO reviews (user_id, product_id, rating, comment, created_at) 
                           VALUES ('$user_id', '$idsp', '$rating', '$comment', NOW())";
            
            if (mysqli_query($conn, $sql_insert)) {
                // Sau khi thêm, load lại trang để cập nhật đánh giá mới
                
                header("Location: sanpham.php?id=".$idsp);
                exit();
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
            
        } else {
            echo "<script>alert('Bạn cần đăng nhập để đánh giá!');</script>";
        }
    }
    


   
    ?>
    

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?= "quantri/" . $anh_arr[0] ?>"
                                alt="<?= $row['name'] ?>">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php
                            for ($i = 0; $i < count($anh_arr); $i++) {
                                ?>
                                <img data-imgbigurl="<?= "quantri/" . $anh_arr[$i] ?>"
                                    src="<?= "quantri/" . $anh_arr[$i] ?>">
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
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">
                            <?= $row['price'] ?>
                        </div>
                        <p>
                            <?= $row['summary'] ?>
                        </p>
                        <form method="post">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" >
                                        <input type="hidden" value="1" name="qty">
                                    </div>
                                    <input type="hidden" name="pid" value="<?=$idsp?>">
                                </div>
                            </div>
                            <button class="primary-btn" name="atcbtn">Thêm vào giỏ hàng</button>
                        </form>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Tình trạng:</b> <span><?= $row['status'] ?>_Còn hàng</span></li>
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
                                    aria-selected="false">Đánh giá <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Thông tin sản phẩm</h6>
                                    <?= $row['description'] ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc review-container">
                                    
                                    
                                    <!-- Phần form viết đánh giá -->
                                    <div class="write-review-section">
                                 
                                        <form id="reviewForm" action="" method="POST">
                                            <div class="form-row">
                                                <div class="rating-select">
                                                    <select name="rating" id="rating" required>
                                                        <option value="5">5 <span class="gold-star">★</span></option>
                                                        <option value="4">4 <span class="gold-star">★</span></option>
                                                        <option value="3">3 <span class="gold-star">★</span></option>
                                                        <option value="2">2 <span class="gold-star">★</span></option>
                                                        <option value="1">1 <span class="gold-star">★</span></option>
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
                                    
                                    <!-- Phần danh sách đánh giá -->
                                    <div class="reviews-list">
                                       
                                        
                                        <?php while ($review = mysqli_fetch_assoc($result_reviews)) {
                                            $sql_users = "SELECT * FROM users WHERE id = $review[user_id]";
                                            $result_user = mysqli_query($conn, $sql_users);
                                            $user = mysqli_fetch_assoc($result_user);
                                        ?>
                                            <div class="review-item">
                                                <div class="review-header">
                                                    <div class="user-info">
                                                            <td>  
                                                                                             
                                                            <img src="<?=$user['avatar'] ?>" style="border-radius: 50%; width: 55px; height: 55px; object-fit: cover;">

                                                            </td>
                                        
                                                        <strong class="user-name"><?= $user['name']?></strong>
                                                        <span class="rating-stars"><?= $review['rating'] ?>/5 <span class="gold-star">★</span></span>
                                                    </div>
                                                    <small class="review-date"><?= $review['created_at'] ?></small>
                                                </div>
                                                <div class="review-content">
                                                    <p><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
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
    border-color:rgb(17, 28, 227);
    outline: none;
}

.submit-review-btn {
    background-color:rgb(181, 7, 7);
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
    background-color:rgb(237, 26, 26);
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
    color: #FFD700;
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Thêm ngôi sao vàng vào tùy chọn đánh giá
    const ratingSelect = document.getElementById('rating');
    const options = ratingSelect.options;
    
    for(let i = 0; i < options.length; i++) {
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
            while($row2 = mysqli_fetch_assoc($result2)) {
                $arrs = explode(";", $row2["images"]);
                        ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?="quantri/".$arrs[0]?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="sanpham.php?id=<?=$row2['id']?>"><?=$row2['name']?></a></h6>
                            <h5><?=$row2['disscounted_price']?></h5>
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



</body>

</html>