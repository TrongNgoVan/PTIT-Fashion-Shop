<?php
require('includes/header.php');
?>

<div>

    <style>
        .btn-danger {
            color: white !important;
            background-color: rgb(178, 5, 5) !important;
            border-color: rgb(178, 5, 5) !important;
        }

        .btn-warning {
            color: white !important;
            background-color: rgb(31, 91, 222) !important;
            border-color: rgb(37, 57, 242) !important;
        }

        .btn-warning:hover {
            color: black !important;
            background-color: rgb(41, 105, 243) !important;
            border-color: rgb(59, 78, 250) !important;
        }

        .btn-danger:hover {
            color: black !important;
            background-color: rgb(209, 4, 4) !important;
            border-color: rgb(178, 5, 5) !important;
        }

        /* Thêm chút khoảng cách cho form */
        .filter-form .form-group {
            margin-right: 1rem;
        }
    </style>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Khách hàng tiềm năng</h6>
            <form method="GET" class="filter-form form-inline">
                <div class="form-group">
                    <label for="min_orders">Số đơn ≥ </label>
                    <input type="number" id="min_orders" name="min_orders" class="form-control ml-1"
                        value="<?= isset($_GET['min_orders']) ? (int)$_GET['min_orders'] : 1 ?>" min="1">
                </div>
                <div class="form-group">
                    <label for="min_spent">Tổng tiền ≥ </label>
                    <input type="number" id="min_spent" name="min_spent" class="form-control ml-1"
                        value="<?= isset($_GET['min_spent']) ? (float)$_GET['min_spent'] : 0 ?>" min="1000" step="0.01">
                </div>
                <button type="submit" class="btn btn-warning">Lọc</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ & Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Số đơn</th>
                            <th>Tổng chi (₫)</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require('conn.php');

                        // Lấy giá trị lọc từ form
                        $min_orders = isset($_GET['min_orders']) ? (int)$_GET['min_orders'] : 1;
                        $min_spent  = isset($_GET['min_spent'])  ? (float)$_GET['min_spent'] : 1000;

                        // Truy vấn tổng số đơn & tổng chi theo khách
                        $sql = "
  SELECT 
    u.id, u.name, u.email, u.phone,
    COUNT(o.id)               AS total_orders,
    IFNULL(SUM(o.total_price),0) AS total_spent
  FROM users u
  LEFT JOIN orders o 
    ON o.user_id = u.id 
    AND (o.status_pay = 'Đã thanh toán' OR o.status_pay = 'Thanh toán thừa')
  GROUP BY u.id
  HAVING total_orders >= {$min_orders}
     AND total_spent  >= {$min_spent}
  ORDER BY total_spent DESC
";


                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                <td><?= $row['total_orders'] ?></td>
                                <td><?= number_format($row['total_spent'], 0, ',', '.') ?></td>
                                <td>
                                    <a class="btn btn-warning"
                                        href="send_email.php?user_id=<?= $row['id'] ?>">
                                        Gửi email
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
require('includes/footer.php');
?>