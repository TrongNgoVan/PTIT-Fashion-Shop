<?php
require_once('./db/conn.php');

$idsp = intval($_GET['id']);  // đảm bảo an toàn

// JOIN để lấy: review + user + số lượng mua
$sql_reviews = "
    SELECT reviews.*, users.name, users.avatar, order_details.qty
    FROM reviews
    JOIN users ON reviews.user_id = users.id
    JOIN order_details ON reviews.order_detail_id = order_details.id
    WHERE reviews.product_id = ?
    ORDER BY reviews.updated_at DESC
";

$stmt = $conn->prepare($sql_reviews);
$stmt->bind_param('i', $idsp);
$stmt->execute();
$result_reviews = $stmt->get_result();

echo '<div class="reviews-list">';
while ($review = $result_reviews->fetch_assoc()) {
    $userAvatar = htmlspecialchars($review['avatar']);
    $userName   = htmlspecialchars($review['name']);
    $rating     = (int)$review['rating'];
    $qty        = (int)$review['qty'];
    $date       = htmlspecialchars($review['updated_at']);
    $comment    = nl2br(htmlspecialchars($review['comment']));
    
    echo '<div class="review-item p-3 border-bottom">';
    echo '  <div class="review-header d-flex align-items-center mb-2">';
    echo '    <img src="' . $userAvatar . '" alt="avatar" class="rounded-circle me-2" style="width:60px; height:60px; object-fit:cover;">';
    echo '    <div class="flex-grow-1">';
    echo '      <div class="d-flex align-items-center">';
    echo '        <strong class="me-2">' . $userName . '</strong>';
    // hiển thị sao
    echo '        <div class="me-2">';
    for ($i = 1; $i <= 5; $i++) {
        $class = $i <= $rating ? 'text-warning' : 'text-muted';
        echo '<span class="fa fa-star ' . $class . '"></span>';
    }
    echo '        </div>';
    echo '        <span> (' . $rating . ' sao)</span>';
    echo '      </div>';
    echo '      <span class="text-secondary">Số lượng: ' . $qty . ' sản phẩm</span>';
    echo '    </div>';
    echo '    <span class="text-muted">' . $date . '</span>';
    echo '  </div>';
    echo '  <div class="review-content mb-2">';
    echo '    <p class="mb-1">' . $comment . '</p>';
    echo '  </div>';
    
    // hiển thị hình ảnh của review nếu có
    if (!empty($review['image'])) {
        // nếu có nhiều ảnh lưu dưới dạng JSON, tách ra mảng
        $images = json_decode($review['image'], true);
        if (!is_array($images)) {
            $images = [$review['image']];
        }
        echo '<div class="review-images d-flex gap-2">';
        foreach ($images as $img) {
            $src = htmlspecialchars($img);
            echo '<img src="' . $src . '" class="rounded" style="width:80px; height:80px; object-fit:cover; cursor:pointer;" onclick="window.open(\'' . $src . '\', \'_blank\')">';
        }
        echo '</div>';
    }
    
    echo '</div>'; // end review-item
}
echo '</div>';  

$stmt->close();
?>