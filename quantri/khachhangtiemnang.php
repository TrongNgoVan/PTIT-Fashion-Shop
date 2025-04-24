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
                        value="<?= htmlspecialchars($_GET['min_orders'] ?? 1) ?>" min="1">
                </div>
                <div class="form-group">
                    <label for="min_spent">Tổng tiền ≥ </label>
                    <input type="number" id="min_spent" name="min_spent" class="form-control ml-1"
                        value="<?= htmlspecialchars($_GET['min_spent'] ?? 1000) ?>" min="1000" step="0.01">
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
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require('conn.php');

                        $min_orders = $_GET['min_orders'] ?? 1;
                        $min_spent = $_GET['min_spent'] ?? 1000;

                        $sql = "SELECT 
                                    u.id, 
                                    u.name, 
                                    u.email, 
                                    u.phone,
                                    COUNT(o.id) AS total_orders,
                                    IFNULL(SUM(o.total_price), 0) AS total_spent
                                FROM users u
                                LEFT JOIN orders o ON o.user_id = u.id 
                                    AND o.status_pay IN ('Đã thanh toán', 'Thanh toán thừa')
                                GROUP BY u.id
                                HAVING 
                                    total_orders >= ? 
                                    AND total_spent >= ?
                                ORDER BY total_spent DESC";

                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "dd", $min_orders, $min_spent);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $formatted_spent = number_format($row['total_spent'], 0, ',', '.');
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                <td><?= $row['total_orders'] ?></td>
                                <td><?= $formatted_spent ?>₫</td>
                                <td>
                                    <button class="btn btn-warning btn-send-email"
                                        data-user-id="<?= $row['id'] ?>"
                                        data-user-name="<?= htmlspecialchars($row['name']) ?>"
                                        data-user-email="<?= htmlspecialchars($row['email']) ?>">
                                        Gửi mail
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="emailForm" method="post" action="send_email.php">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="emailModalLabel">Gửi email cho <span id="modalUserName"></span></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="modalUserId">
                    <div class="form-group">
                        <label for="modalUserEmail">Địa chỉ email</label>
                        <input type="email" class="form-control" id="modalUserEmail" name="email" readonly>
                        
                    </div>
                    <div class="form-group">
                        <label for="emailSubject">Chủ đề</label>
                        <input type="text" class="form-control" id="emailSubject"  name="subject"
                               value="Ưu đãi đặc biệt dành riêng cho bạn!" required>
                    </div>
                    <div class="form-group">
                        <label for="emailBody">Nội dung</label>
                        <textarea class="form-control" id="emailBody"  name="message" rows="8" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Gửi ngay</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require('includes/footer.php'); ?>

<script>
$(document).ready(function() {
    $('.btn-send-email').click(function() {
        const userData = {
            id: $(this).data('user-id'),
            name: $(this).data('user-name'),
            email: $(this).data('user-email')
        };

        // Validate data
        if (!validateUserData(userData)) return;

        // Set modal content
        $('#modalUserId').val(userData.id);
        $('#modalUserName').text(userData.name);
        $('#modalUserEmail').val(userData.email);
        
        // Generate dynamic content
        $('#emailSubject').val(`Ưu đãi đặc biệt cho ${userData.name}`);
        $('#emailBody').val(generateEmailContent(userData));
        
        $('#emailModal').modal('show');
    });

    function validateUserData(user) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(user.email)) {
            alert('Email không hợp lệ!');
            return false;
        }
        if (user.name.trim().length < 2) {
            alert('Tên khách hàng không hợp lệ!');
            return false;
        }
        return true;
    }

    function generateEmailContent(user) {
        return `Kính gửi ${user.name},

Chúng tôi xin gửi đến quý khách chương trình ưu đãi đặc biệt:
- Giảm 20% cho đơn hàng tiếp theo
- Tích lũy điểm 3x cho lần mua sắm tới
- Hỗ trợ miễn phí vận chuyển

Áp dụng từ ngày 01/01/2024 đến 31/01/2024

Mã ưu đãi của bạn: VIP${user.id.toString().padStart(6, '0')}

Trân trọng,
Đội ngũ PTIT Fashion`;
    }
});
</script>
<!-- Hiển thị thông báo -->
<?php if (isset($_SESSION['email_status'])): ?>
    <div class="alert alert-<?= $_SESSION['email_status']['type'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['email_status']['message'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['email_status']); // Xóa thông báo sau khi hiển thị ?>
<?php endif; ?>