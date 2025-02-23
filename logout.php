<?php
session_start();
unset($_SESSION["user"]);
// unset($_SESSION["cart"]); nếu muốn bảo mậthơn thì khi đăng xuất phải xóa giỏ hàng đi
//  thường thì giỏ hàng sẽ là lưu tạm thời trên sesion chứ không liên quan đến tài khoản, 
// sau đó muốn mua thì vào giỏ hàng mua,
//  nó sẽ đẩy toàn bộ sản phảm trong giỏ vào đơn hàng và xóa nhũng sản phẩm trong giỏ hàng đã mua . 
// đương nhiên đơn hàng và giỏ hàng không hề có quan hệ về mặt thực thể

header("Location: index.php");
?>

