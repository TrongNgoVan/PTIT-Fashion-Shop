<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tra cứu giao dịch</title>
        <!-- Bootstrap core CSS -->
        <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">  
        <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">VNPAY DEMO</h3>
            </div>
            <div style="width: 100%;padding-top:0px;font-weight: bold;color: #333333"><h3>Querydr</h3></div>
            <div style="width: 100% ;border-bottom: 2px solid black;padding-bottom: 20px" >
                <form action="/vnpay_php/vnpay_query.php" id="frmCreateOrder" method="post">        
                    <div class="form-group">
                        <label >OrderID</label>
                        <input class="form-control" data-val="true"  name="orderid" type="text" value="" />
                    </div>
                    <div class="form-group">
                        <label>Payment Date</label>
                        <input class="form-control" data-val="true"  name="paymentdate" type="text" value="" />
                    </div>
                    <input type="submit"  class="btn btn-default" value="Querydr" />
                </form>
            </div>


            <?php
            /*
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */
            require_once("config.php");

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $orderid = $_POST["orderid"];
                $hashSecret = $vnp_HashSecret;
                $ipaddr = $_SERVER['REMOTE_ADDR'];
                $inputData = array(
                    "vnp_Version" => '2.1.0',
                    "vnp_Command" => "querydr",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_TxnRef" => $orderid,
                    "vnp_OrderInfo" => 'Noi dung thanh toan',
                    "vnp_TransDate" => $_POST['paymentdate'],
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_IpAddr" => $ipaddr
                );
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_apiUrl = $vnp_apiUrl . "?" . $query;
                if (isset($hashSecret)) {
                    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                    $vnp_apiUrl .= 'vnp_SecureHash=' . $vnpSecureHash;
                }
                $ch = curl_init($vnp_apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $data = curl_exec($ch);
                curl_close($ch);
                echo $data;
            }
            ?>
        </div>
    </body>
</html>