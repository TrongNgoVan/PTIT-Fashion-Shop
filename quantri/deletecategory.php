<?php

//lay id goi den
$delid = $_GET['id'];

require('conn.php');

$sql_str = "delete from categories where id=$delid";
mysqli_query($conn, $sql_str);

//trở về trang liệt kê brands
header("location: listcats.php");

