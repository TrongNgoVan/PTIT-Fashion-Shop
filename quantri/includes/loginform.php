<!DOCTYPE html>
<html lang="en">

<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='https://www.google.com/recaptcha/api.js' async defer ></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>

    <title>Đăng nhập quản trị</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel ="icon" href ="img/ptit.png" type="image/x-icon">
    <style>
        .bg-gradient-primary {
            position: relative;
            background: url('../img/ptitnen.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

/* Tạo lớp phủ */
       .bg-gradient-primary::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(117, 116, 116, 0.3); /* Màu đỏ nhạt (pha lên trên) */
            backdrop-filter: blur(5px); /* Làm mờ hình nền */
            z-index: -1; 
             }
             .container {
                max-width: 650px; /* Điều chỉnh chiều rộng theo ý muốn */
                width: 100%; /* Để giữ form linh hoạt */
                margin: auto; /* Căn giữa form */
            }
       
            header{
                justify-content: center;
                display: flex;
                margin-bottom: 20px;
            }
            .header-img{
                max-width: 100%; /* Giúp ảnh không bị vỡ */
                height: auto;
            }
             
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-12 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-8  offset-lg-2">
                                <div class="header">
                                    <img src="../img/logo2.jpg" alt="PTIT Fashion" class="header-img">
                                </div>
                                <div class="p-5">
                                    
                                    <div class="text-center">
                                        <!-- <h1 class="h4 text-gray-900 mb-4">Login Form</h1> -->
                                        <?php echo "<h4 class='alert alert-danger'>$errorMsg</h4>" ?>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                        </div>

                                        <button name="btSubmit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                        <hr>
                                        <a href="#" onclick="alert('Đang hiện thực ...')"
                                            class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="#" onclick="alert('Đang hiện thực ...')"
                                            class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                        <div class="g-recaptcha" data-sitekey="6LdbgN4qAAAAAGpnKFzmAo5_30IH1NcYeRHLL8TZ"></div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
