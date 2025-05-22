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
    <!-- Chatbot icon và khung chat -->
<style>
  /* General Chatbot Styling */
  #chat-container {
    display: none;
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 400px;
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    font-family: 'Poppins', sans-serif;
    flex-direction: column;
    z-index: 1100;
  }

  #chat-container h2 {
    margin: 0 0 10px 0;
    font-size: 22px;
    text-align: center;
  }

  #chat-box {
    height: 350px;
    overflow-y: auto;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
    padding: 15px;
    border: none;
    display: flex;
    flex-direction: column;
  }

  .user-message {
    background: #B6B6B6;
    color: white;
    padding: 10px;
    border-radius: 10px;
    margin: 8px 0;
    text-align: right;
    max-width: 75%;
    align-self: flex-end;
  }

  .bot-message {
    background: #8D8D8D;
    color: white;
    padding: 10px;
    border-radius: 10px;
    margin: 8px 0;
    text-align: left;
    max-width: 75%;
    align-self: flex-start;
  }

  .input-container {
    display: flex;
    margin-top: 15px;
  }

  #user-input {
    flex: 1;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 20px;
    outline: none;
    font-size: 16px;
    transition: 0.3s;
  }

  #user-input:focus {
    border-color: #007bff;
  }

  button {
    padding: 12px 20px;
    margin-left: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
  }

  button:hover {
    background: #0056b3;
  }

  /* Scrollbar */
  #chat-box::-webkit-scrollbar {
    width: 8px;
  }
  #chat-box::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
  }

  /* Icon chatbot */
  #chatbot-icon {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    cursor: pointer;
    z-index: 1101;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #chatbot-icon svg {
    fill: white;
    width: 24px;
    height: 24px;
  }
</style>

<div id="chatbot-icon" title="Chat với AI">
  <img src="uploads/chatbot.gif" alt="Chatbot Icon" style="width: 150%; height: 150%; border-radius: 50%;">
</div>


<div id="chat-container">
  <h2>10 vạn câu hỏi vì sao!!!</h2>
  <div id="chat-box"></div>
  <div class="input-container">
    <input type="text" id="user-input" placeholder="Trò chuyện phiếm cùng tôi nhé!!!">
    <button onclick="sendMessage()">Send</button>
  </div>
</div>

<script>
  const chatbotIcon = document.getElementById('chatbot-icon');
  const chatContainer = document.getElementById('chat-container');

  chatbotIcon.addEventListener('click', () => {
    if (chatContainer.style.display === 'flex') {
      chatContainer.style.display = 'none';
    } else {
      chatContainer.style.display = 'flex';
      document.getElementById('user-input').focus();
    }
  });

  // Xử lý gửi tin nhắn đơn giản
  function sendMessage(){
	const userInput = document.getElementById('user-input').value.trim();

    if (userInput === "") return;

    const chatBox = document.getElementById('chat-box');
    // append user message
    const userMessage = document.createElement('div');
    userMessage.className = 'user-message';
    userMessage.textContent = userInput;
    chatBox.appendChild(userMessage);

    fetch("chatbot.php", {
    	method: 'POST',
    	headers: {'Content-Type': 'application/json'},
    	body: JSON.stringify({message: userInput})
    }).then(respose=> respose.json())
      .then(data => {
      	const botMessage = document.createElement('div');
      	botMessage.className = 'bot-message';
        botMessage.textContent = data.error ? `Bot: ${data.error}`:  `PTIT_Shop: ${data.response}`;
       chatBox.appendChild(botMessage);
       document.getElementById('user-input').value='';
       chatBox.scrollTop = chatBox.scrollHeight;
    }).catch(error=> {
    	const errorMessage = document.createElement('div');
      	errorMessage.className = 'bot-message';
        errorMessage.textContent = 'Bot: Failed to fetch  respose.';
       chatBox.appendChild(errorMessage);
    });
}
</script>


   


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