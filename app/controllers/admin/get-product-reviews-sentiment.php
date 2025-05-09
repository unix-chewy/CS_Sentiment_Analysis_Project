<?php
include '../../config/login-config.php';

// Fetch product reviews with user, product, and sentiment info from the sentiments table
$sql = "SELECT 
            product_review_comments.id,
            users.first_name,
            products.name,
            product_review_comments.review_text,
            sentiments.sentiment_label,
            sentiments.sentiment_score
        FROM product_review_comments
        JOIN users ON product_review_comments.user_id = users.id
        JOIN products ON product_review_comments.product_id = products.id
        JOIN sentiments ON product_review_comments.id = sentiments.review_id
        ORDER BY product_review_comments.id DESC";

$result = $conn->query($sql);

// I did Json Response here instead of directly showing it in the review-table for admin
// reused code of json activities from beforre
if ($result) {
    $reviews = [];
    while ($row = $result->fetch_assoc()) {
        $reviews[] = [
            'id'               => $row['id'],
            'username'         => $row['first_name'],
            'product_name'     => $row['name'],
            'review_text'      => $row['review_text'],
            'sentiment_label'  => $row['sentiment_label'],
            'sentiment_score'  => $row['sentiment_score']
        ];
    }
    echo json_encode(['reviews' => $reviews]);
} else {
    echo json_encode(['error' => 'Error fetching product reviews: ' . $conn->error]);
}
?> 