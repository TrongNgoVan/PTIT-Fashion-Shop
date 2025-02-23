<?php
session_start();
// $dataFromClient = json_decode(file_get_contents('php://input'));


// if ($dataFromClient) {
//     $action = $dataFromClient->action;
//     $id = $dataFromClient->id;

//     switch ($action) {
//         case 'add':
//             addToCart($id);
//             break;
//     }

//     echo json_encode(['success' => "1"]);
// }
// echo json_encode(['success' => $dataFromClient]);
// function addToCart2($id)
// {
//     require_once("../db/conn.php");

//     $cart = [];
//     if (isset($_SESSION['cart'])) {
//         $cart = $_SESSION['cart'];
//     }

//     $isExist = false;
//     for ($i = 0; $i < count($cart); $i++) {
//         if ($cart[$i]['id'] == $id) {
//             $isExist = true;
//             //tang so luong le 1 don vi
//             $cart[$i]['count']++;
//             break;
//         }
//     }
//     //chua ton tai thi them vao $cart
//     if ($isExist) {
//         $sql = mysqli_query($conn, "select * products where id=$id");
//         $row = mysqli_fetch_assoc($sql);
//         $product = $row;
//         $product['count'] = 1;
//         $cart[] = $product;
//     }

//     //update session
//     $_SESSION['cart'] = $cart;
// }



//code hien thi so luong san pham trong gio hang - hien thi trong header
// $cart = [];
// if (isset($_SESSION['cart'])) {
//     $cart = $_SESSION['cart'];
// }
// $count = 0;
// foreach ($cart as $item) {
//     $count += $item['count'];
// }

//code cart.php
// $cart = [];
// if (isset($_SESSION['cart'])) {
//     $cart = $_SESSION['cart'];
// }

//hien thi danh sach $cart ra ngoai thanh cac row
// in gia tien ra VND  - 
// number_format($product['price'], 0, '', '.');



//them san pham vao gio hang
function addToCart($id, $quantity) {
{
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    $isFound = false;
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            $cart[$i]['qty']+= $quantity; 
            $isFound = true;
            break;
        }
    }
    if (!$isFound) {  //khong tim thay san pham trong gio
        $product = //thuc thi cau lenh ('select * from products where id = '.$id, true);
        $product['qty'] = $quantity;
        $cart[] = $product;
    }

    //update session
    $_SESSION['cart'] = $cart;
}

//xoa san pham
function deleteItem($id)
{
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            array_splice($cart, $i, 1);
            break;
        }
    }

    //update session
    $_SESSION['cart'] = $cart;
}

// cart.php - giỏ hàng
$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
// var_dump($cart);die();
$count = 0;
$total = 0;
foreach ($cart as $item) {
    $total += $item['num'] * $item['price'];
    echo '
		<tr>
			<td>' . (++$count) . '</td>
			<td><img src="' . $item['thumbnail'] . '" style="width: 100px"></td>
			<td>' . $item['title'] . '</td>
			<td>' . number_format($item['price'], 0, '', '.') . ' VND</td>
			<td>' . $item['num'] . '</td>
			<td>' . number_format($item['num'] * $item['price'], 0, '', '.') . ' VND</td>
			<td><button class="btn btn-danger" onclick="deleteItem(' . $item['id'] . ')">Delete</button></td>
		</tr>';
}
?>
</tbody>
</table>
<p style="font-size: 26px; mau: red">
    <?= number_format($total, 0, '', '.') ?> VND
</p>
<a href="checkout.php">
    <button class="btn btn-success" style="width: 100%; font-size: 30px;">Thanh toán</button>
</a>
</div>
</div>

<?php
// thanh toán
if (!empty($_POST)) {
    $fullname = getPost('fullname');
    $address = getPost('address');
    $email = getPost('email');
    $phone_number = getPost('phone_number');
    $order_date = date('Y-m-d H:i:s');

    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    if ($cart == null || count($cart) == 0) {
        header('Location: products.php');
        die();
    }

    $sql = "insert into orders (fullname, address, email, phone_number, order_date) values ('$fullname', '$address', '$email', '$phone_number', '$order_date')";
    execute($sql);

    $sql = "select * from orders where order_date = '$order_date'";
    $order = executeResult($sql, true);

    $orderId = $order['id'];

    foreach ($cart as $item) {
        $product_id = $item['id'];
        $num = $item['num'];
        $price = $item['price'];
        $sql = "insert into order_details(order_id, product_id, num, price) values ($orderId, $product_id, $num, $price)";
        execute($sql);
    }

    // session_destroy();
    unset($_SESSION['cart']);

    header('Location: complete.php');
    die();
}