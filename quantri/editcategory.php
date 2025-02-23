<?php


//lay id goi edit
$id = $_GET['id'];

//ket noi csdl
require('../db/conn.php');

$sql_str = "select * from categories where id=$id";
$res = mysqli_query($conn, $sql_str);

$cat = mysqli_fetch_assoc($res);

if (isset($_POST['btnUpdate'])) {
    //neu nut Cap nhat duoc nhan
    //lay name
    $name = $_POST['name'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    //thuc hien viec cap nhat
    $sql_str2 = "update categories set name='$name', slug='$slug' where id=$id";

    mysqli_query($conn, $sql_str2);

    //chuyen qua trang listcats
    header("location: listcats.php");
} else {
    require('includes/header.php');
    ?>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Cập nhật danh mục sản phẩm</h1>
                            </div>
                            <form class="user" method="post" action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="name" name="name"
                                        aria-describedby="emailHelp" placeholder="Tên danh mục"
                                        value="<?php echo $cat['name'] ?>">
                                </div>
                                <button class="btn btn-primary" name="btnUpdate">Cập nhật</button>
                            </form>
                            <hr>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php
    require('includes/footer.php');
}
?>