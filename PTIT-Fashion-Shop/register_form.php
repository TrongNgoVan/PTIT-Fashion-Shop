<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- reCAPTCHA & thư viện khác -->
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>

    <title>Đăng ký thành viên</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="img/ptit.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />

    <!-- Script của intl-tel-input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <!-- Script utils (hỗ trợ format) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"></script>

    <style>
        .bg-gradient-primary {
            position: relative;
            background: url('img/ptitnen.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .bg-gradient-primary::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(116, 114, 114, 0.3);
            backdrop-filter: blur(5px);
            z-index: -1;
        }

        .container {
            max-width: 800px;
            width: 100%;
            margin: auto;
        }

        header {
            justify-content: center;
            display: flex;
            margin-bottom: 20px;
        }

        .header-img {
            max-width: 100%;
            height: auto;
        }

        /* Tùy chỉnh cho phần hiển thị lỗi email */
        #emailError {
            color: red;
            display: none;
            margin-top: 5px;
        }

        /* Tùy chỉnh cho phần hiển thị lỗi số điện thoại */
        #phoneError {
            color: red;
            display: none;
            margin-top: 5px;
        }

        /* Tùy chỉnh cho phần hiển thị lỗi email */
        #passwordError {
            color: red;
            display: none;
            margin-top: 5px;
        }

        #nameError {
            color: red;
            display: none;
            margin-top: 5px;
        }

        /* Tùy chỉnh cho intl-tel-input để làm cho input điện thoại dài bằng input tên */
        .iti {
            width: 100% !important;
            display: block;
        }

        .iti__flag-container {
            z-index: 5;
        }

        .iti input {
            width: 100% !important;
        }

        /* Đảm bảo căn lề phù hợp cho phần nhập liệu của số điện thoại */
        .iti--separate-dial-code input.form-control {
            padding-left: 90px !important;
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
                            <div class="col-lg-8 offset-lg-2">
                                <div class="p-5">

                                    <div class="header">
                                        <img src="img/logo2.jpg" alt="PTIT Fashion" class="header-img">
                                    </div>

                                    <div class="text-center">
                                        <?php
                                        if (!empty($errorMsg)) {
                                            echo "<h4 class='alert alert-danger'>$errorMsg</h4>";
                                        }
                                        ?>
                                    </div>

                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="username" name="username" class="form-control form-control-user"
                                                id="exampleInputName" aria-describedby="nameHelp"
                                                placeholder="Enter Your Name...">
                                            <small id="nameError"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="tel"
                                                id="phone"
                                                name="phone"
                                                class="form-control form-control-user"
                                                placeholder="Enter Phone...">
                                            <small id="phoneError"></small>
                                        </div>

                                        <div class="form-group">
                                            <input type="add" name="add" class="form-control form-control-user"
                                                id="exampleInputAdd" aria-describedby="addHelp"
                                                placeholder="Enter Address...">
                                        </div>

                                        <!-- Phần email -->
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                            <!-- Thẻ hiển thị lỗi email real-time -->
                                            <small id="emailError"></small>
                                        </div>
                                        <!-- Phần mật khẩu -->
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                            <small id="passwordError"></small>
                                        </div>
                                        <!-- Phần nhập lại mật khẩu -->
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleRepeatPassword" placeholder="Repeat Password">
                                        </div>

                                        <button name="btSubmit" class="btn btn-primary btn-user btn-block">
                                            Register
                                        </button>

                                        <hr>
                                        <a href="#" onclick="alert('Đang hiện thực ...')"
                                            class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Register with Google
                                        </a>
                                        <a href="#" onclick="alert('Đang hiện thực ...')"
                                            class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form.user");

            // ========== Bắt lỗi số điện thoại theo thời gian thực ==========
            const phoneInput = document.querySelector("input[name='phone']");
            const phoneError = document.getElementById("phoneError");

            // Khởi tạo intl-tel-input
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "vn", // Mặc định hiển thị cờ VN
                separateDialCode: true, // Tách mã quốc gia riêng
                // preferredCountries: ["vn"], // Nếu muốn chỉ 1 quốc gia
            });

            // Lắng nghe sự kiện input để bắt lỗi real-time
            phoneInput.addEventListener("input", function() {
                let phoneValue = phoneInput.value.trim();

                if (phoneValue === "") {
                    phoneError.style.display = "none";
                    phoneError.textContent = "";
                    phoneInput.style.borderColor = "";
                    return;
                }
                if (phoneValue[0] == "0") {
                    phoneError.style.display = "block";
                    phoneError.textContent = "Số điện thoại đã có số 0 ở đầu";
                    phoneInput.style.borderColor = "red";
                    return;
                }
                if (phoneValue.length != 9) {
                    phoneError.style.display = "block";
                    phoneError.textContent = "Số điện thoại phải có đúng 9 số";
                    phoneInput.style.borderColor = "red";
                    return;
                }


                // Kiểm tra từng ký tự xem có phải số hay không
                let isValid = true;
                for (let i = 0; i < phoneValue.length; i++) {
                    const char = phoneValue.charAt(i);
                    if (char < "0" || char > "9") {
                        isValid = false;
                        break;
                    }
                }

                if (!isValid) {
                    phoneError.style.display = "block";
                    phoneError.textContent = "Số điện thoại chỉ được phép chứa các chữ số từ 0 - 9";
                    phoneInput.style.borderColor = "red";
                } else {
                    phoneError.style.display = "none";
                    phoneError.textContent = "";
                    phoneInput.style.borderColor = "blue";
                }
            });
            // ========== Kết thúc phần bắt lỗi số điện thoại ==========
            // ========== Bắt lỗi tên theo thời gian thực ==========
            const nameInput = document.querySelector("input[name='username']");
            const nameError = document.getElementById("nameError");
            nameInput.addEventListener("input", function() {
                let nameValue = nameInput.value.trim();
                if (nameValue === "") {
                    nameError.style.display = "none";
                    nameError.textContent = "";
                    nameInput.style.borderColor = "";
                    return;
                }
                // Nếu username có ít hơn 3 ký tự
                if (nameValue.length < 3) {
                    nameError.style.display = "block";
                    nameError.textContent = "Username phải có ít nhất 3 ký tự.";
                    nameInput.style.borderColor = "red";
                    return;
                }
                // Kiểm tra từng ký tự: chỉ cho phép chữ và số
                let isValid = true;
                for (let i = 0; i < nameValue.length; i++) {
                    let ch = nameValue.charAt(i);
                    // Nếu ký tự không phải chữ hoặc số
                    if (!((ch >= 'a' && ch <= 'z') || (ch >= 'A' && ch <= 'Z'))) {
                        isValid = false;
                        break;
                    }
                }
                if (!isValid) {
                    nameError.style.display = "block";
                    nameError.textContent = "Username chỉ được chứa chữ và số, không chứa ký tự đặc biệt hoặc khoảng trắng.";
                    nameInput.style.borderColor = "red";
                    return;
                }
                nameError.style.display = "none";
                nameError.textContent = "";
                nameInput.style.borderColor = "blue";

            });
            // =========== Bắt lỗi mật khẩu ==========
            const passwordInput = document.querySelector("#exampleInputPassword");
            const passwordError = document.getElementById("passwordError");
            passwordInput.addEventListener("input", function() {
                let passValue = passwordInput.value.trim();
                if (passValue === "") {
                    // Nếu mật khẩu để trống, ẩn lỗi và khôi phục viền mặc định
                    passwordError.style.display = "none";
                    passwordError.textContent = "";
                    passwordInput.style.borderColor = "";
                    return;
                }
                // Kiểm tra độ dài mật khẩu
                if (passValue.length < 8) {
                    passwordError.style.display = "block";
                    passwordError.textContent = "Mật khẩu phải có ít nhất 8 ký tự.";
                    passwordInput.style.borderColor = "red";
                    return;
                }

                // Kiểm tra chữ hoa
                let hasUpperCase = false;
                for (let i = 0; i < passValue.length; i++) {
                    if (passValue[i] >= 'A' && passValue[i] <= 'Z') {
                        hasUpperCase = true;
                        break;
                    }
                }
                if (!hasUpperCase) {
                    passwordError.style.display = "block";
                    passwordError.textContent = "Mật khẩu phải chứa ít nhất một chữ hoa.";
                    passwordInput.style.borderColor = "red";
                    return;
                }

                // Kiểm tra chữ thường
                let hasLowerCase = false;
                for (let i = 0; i < passValue.length; i++) {
                    if (passValue[i] >= 'a' && passValue[i] <= 'z') {
                        hasLowerCase = true;
                        break;
                    }
                }
                if (!hasLowerCase) {
                    passwordError.style.display = "block";
                    passwordError.textContent = "Mật khẩu phải chứa ít nhất một chữ thường.";
                    passwordInput.style.borderColor = "red";
                    return;
                }

                // Kiểm tra số
                let hasNumber = false;
                for (let i = 0; i < passValue.length; i++) {
                    if (passValue[i] >= '0' && passValue[i] <= '9') {
                        hasNumber = true;
                        break;
                    }
                }
                if (!hasNumber) {
                    passwordError.style.display = "block";
                    passwordError.textContent = "Mật khẩu phải chứa ít nhất một chữ số.";
                    passwordInput.style.borderColor = "red";
                    return;
                }

                // Kiểm tra ký tự đặc biệt
                let hasSpecial = false;
                const specialChars = "!@#$%^&*()_+\\-=\\[\\]{};':\"\\\\|,.<>\\/?";
                for (let i = 0; i < passValue.length; i++) {
                    if (specialChars.indexOf(passValue[i]) !== -1) {
                        hasSpecial = true;
                        break;
                    }
                }
                if (!hasSpecial) {
                    passwordError.style.display = "block";
                    passwordError.textContent = "Mật khẩu phải chứa ít nhất một ký tự đặc biệt.";
                    passwordInput.style.borderColor = "red";
                    return;
                }

                // Nếu vượt qua tất cả các kiểm tra, hiển thị viền xanh
                passwordError.style.display = "none";
                passwordError.textContent = "";
                passwordInput.style.borderColor = "blue";

                // Kiểm tra lại mật khẩu xác nhận
                if (confirmPasswordInput.value.trim() !== "") {
                    const event = new Event("input", {
                        bubbles: true
                    });
                    confirmPasswordInput.dispatchEvent(event);
                }
            });
            // ========== Kết thúc phần bắt lỗi mật khẩu ==========

            // ========== Bắt lỗi nhập lại mật khẩu theo thời gian thực ==========
            const confirmPasswordInput = document.querySelector("#exampleRepeatPassword");

            // Tạo phần tử hiển thị lỗi cho nhập lại mật khẩu
            const confirmPasswordError = document.createElement("small");
            confirmPasswordError.id = "confirmPasswordError";
            confirmPasswordError.style.color = "red";
            confirmPasswordError.style.display = "none";
            confirmPasswordError.style.marginTop = "5px";

            // Thêm phần tử hiển thị lỗi vào sau input nhập lại mật khẩu
            confirmPasswordInput.parentNode.appendChild(confirmPasswordError);

            // Lắng nghe sự kiện input để bắt lỗi real-time
            confirmPasswordInput.addEventListener("input", function() {
                let confirmValue = confirmPasswordInput.value.trim();
                let originalValue = passwordInput.value.trim();

                if (confirmValue === "") {
                    // Nếu trường nhập lại mật khẩu trống, ẩn lỗi và khôi phục viền mặc định
                    confirmPasswordError.style.display = "none";
                    confirmPasswordError.textContent = "";
                    confirmPasswordInput.style.borderColor = "";
                    return;
                }

                // Kiểm tra xem mật khẩu nhập lại có khớp với mật khẩu gốc không
                if (confirmValue !== originalValue) {
                    confirmPasswordError.style.display = "block";
                    confirmPasswordError.textContent = "Mật khẩu nhập lại không khớp với mật khẩu đã nhập.";
                    confirmPasswordInput.style.borderColor = "red";
                } else {
                    // Nếu mật khẩu khớp, hiển thị viền xanh
                    confirmPasswordError.style.display = "none";
                    confirmPasswordError.textContent = "";
                    confirmPasswordInput.style.borderColor = "blue";
                }
            });
            // ========== Kết thúc phần bắt lỗi nhập lại mật khẩu ==========

            // ========== Bắt lỗi email theo thời gian thực ==========
            const emailInput = document.querySelector("input[name='email']");
            const emailError = document.getElementById("emailError");

            //Lắng nghe sự kiện để bắt lỗi real time
            emailInput.addEventListener("input", function() {
                let emailValue = emailInput.value.trim();

                if (emailValue === "") {
                    // Nếu để trống, ẩn lỗi và khôi phục viền mặc định
                    emailError.style.display = "none";
                    emailError.textContent = "";
                    emailInput.style.borderColor = "";
                    return;
                }
                // Kiểm tra email có kết thúc bằng @gmail.com hay không
                if (!emailValue.endsWith("@gmail.com")) {
                    emailError.style.display = "block";
                    emailError.textContent = "Email phải kết thúc bằng @gmail.com";
                    emailInput.style.borderColor = "red";
                    return;
                }

                // Kiểm tra phần username trước @ có hợp lệ không
                let tenNguoiDung = emailValue.substring(0, emailValue.indexOf("@"));
                if (tenNguoiDung.length < 3) {
                    emailError.style.display = "block";
                    emailError.textContent = "Tên người dùng phải có ít nhất 3 ký tự";
                    emailInput.style.borderColor = "red";
                    return;
                }
                emailError.style.display = "none";
                emailError.textContent = "";
                emailInput.style.borderColor = "blue";
            });
            // ========== Kết thúc phần kiểm tra email ==========

            // Kiểm tra toàn bộ form trước khi submit
            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Ngăn chặn gửi form nếu có lỗi
                let isValid = true;

                // Lấy giá trị các ô input
                let username = document.querySelector("input[name='username']").value.trim();
                let phone = document.querySelector("input[name='phone']").value.trim();
                let add = document.querySelector("input[name='add']").value.trim();
                let email = document.querySelector("input[name='email']").value.trim();
                let password = passwordInput.value.trim();
                let confirmPassword = confirmPasswordInput.value.trim();

                // Kiểm tra Username (Tối thiểu 3 ký tự)
                let usernameRegex = /^[a-zA-Z0-9]{3,}$/;
                if (!usernameRegex.test(username)) {
                    showError("Username phải có ít nhất 3 ký tự, không chứa ký tự đặc biệt hoặc dấu cách.");
                    isValid = false;
                }

                // Kiểm tra số điện thoại (10 số, bắt đầu bằng 0)
                let phoneRegex = /^0\d{9}$/;
                if (!phoneRegex.test(phone)) {
                    showError("Số điện thoại không hợp lệ. Phải có 10 số và bắt đầu bằng 0.");
                    isValid = false;
                }

                // Kiểm tra địa chỉ (Không để trống)
                if (add === "") {
                    showError("Địa chỉ không được để trống.");
                    isValid = false;
                }

                // Kiểm tra Email (Định dạng email hợp lệ)
                let emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
                if (!emailRegex.test(email)) {
                    showError("Email không hợp lệ.");
                    isValid = false;
                }

                // Kiểm tra Password (Tối thiểu 8 ký tự)
                let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
                if (!passwordRegex.test(password)) {
                    showError("Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.");
                    isValid = false;
                }

                // Kiểm tra nhập lại Password
                if (password !== confirmPassword) {
                    showError("Mật khẩu nhập lại không khớp.");
                    isValid = false;
                }

                // Nếu không có lỗi, submit form
                if (isValid) {
                    form.submit();
                }
            });

            // Hàm hiển thị lỗi bằng SweetAlert2
            function showError(message) {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi nhập liệu!",
                    text: message,
                    confirmButtonText: "OK"
                });
            }
        });
    </script>

</body>

</html>