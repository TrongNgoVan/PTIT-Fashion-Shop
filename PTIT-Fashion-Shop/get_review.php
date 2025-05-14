<?php
require 'db/conn.php';
$id = intval($_GET['order_detail_id']);
$sql = "SELECT rating, comment, image FROM reviews WHERE 	order_detail_id = $id";
$res = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($res)) {
  header('Content-Type: application/json');
  echo json_encode($row);
}
