<?php
require_once('./db/conn.php');

$idsp = intval($_GET['id']);  // đảm bảo an toàn

// JOIN để lấy: review + user + số lượng mua
$sql_reviews = "
    SELECT reviews.*, users.name, users.avatar, order_details.qty
    FROM reviews
    JOIN users ON reviews.user_id = users.id
    JOIN order_details ON reviews.order_detail_id = order_details.id
    WHERE reviews.product_id = $idsp
    ORDER BY reviews.updated_at DESC
";

$result_reviews = mysqli_query($conn, $sql_reviews);

echo '<div class="reviews-list">';
while ($review = mysqli_fetch_assoc($result_reviews)) {
    echo '
        <div class="review-item">
            <div class="review-header">
                <div class="user-info">
                    <img src="' . $review['avatar'] . '" style="border-radius: 50%; width: 55px; height: 55px; object-fit: cover;">
                    <strong class="user-name">' . htmlspecialchars($review['name']) . '</strong>
                    <span class="rating-stars">' . $review['rating'] . '/5 <span class="gold-star">★</span></span>
                    <span class="review-quantity">(Số Lượng: ' . $review['qty'] . ' )</span>
                </div>
                <small class="review-date">' . $review['updated_at'] . '</small>
            </div>
            <div class="review-content">
                <p>' . nl2br(htmlspecialchars($review['comment'])) . '</p>
            </div>
        </div>
    ';
}
echo '</div>';
?>
