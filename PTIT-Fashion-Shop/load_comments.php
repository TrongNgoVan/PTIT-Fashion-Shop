<?php
require_once('./db/conn.php');

$idsp = $_GET['id'];

// Truy vấn JOIN để lấy thông tin bình luận và người dùng
$sql_reviews = "SELECT reviews.*, users.name, users.avatar
                FROM reviews
                JOIN users ON reviews.user_id = users.id
                WHERE product_id = $idsp
                ORDER BY reviews.created_at DESC";
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
                </div>
                <small class="review-date">' . $review['created_at'] . '</small>
            </div>
            <div class="review-content">
                <p>' . nl2br(htmlspecialchars($review['comment'])) . '</p>
            </div>
        </div>
    ';
}
echo '</div>';
?>
