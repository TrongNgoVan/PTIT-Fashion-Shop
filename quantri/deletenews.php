<?php

//lay id goi den
$delid = $_GET['id'];

//ket noi csdl
require('conn.php');

//tim cac hinh anh cua san pham va xoa
$sql1 = "select avatar from news where id=$delid";
$rs = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($rs);

//tim anh va xoa
$img = $row['avatar'];
unlink($img);


//xoa du lieu san pham trong CSDL
$sql_str = "delete from news where id=$delid";
mysqli_query($conn, $sql_str);

//trở về trang liệt kê brands
header("location: listnews.php");

