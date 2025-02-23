<?php

    // echo "xin chao";

   
    require('../db/conn.php');

    //lay du lieu tu form
    $name = $_POST['name'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
  
    
    // cau lenh them vao bang
    $sql_str = "INSERT INTO `categories` (`name`, `slug`,  `status`) VALUES 
    ( '$name', 
    '$slug', 
    'Active');";

    // echo $sql_str; exit;

    //thuc thi cau lenh
    mysqli_query($conn, $sql_str);

    //tro ve trang 
    header("location: listcats.php");
?>