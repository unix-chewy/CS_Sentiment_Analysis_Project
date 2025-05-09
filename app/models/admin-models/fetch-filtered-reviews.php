<?php
include "../../config/login-config.php";

// Reused code from fetch-prodocuts.php
$sentiments = isset($_GET['sentiments']) ? $_GET['sentiments'] : '';

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
        JOIN sentiments ON product_review_comments.id = sentiments.review_id";

// Add sentiment filter only if sentiments are selected
if ($sentiments !== '') {
    $sentiment_values = explode(',', $sentiments);
    $placeholders = str_repeat('?,', count($sentiment_values) - 1) . '?';
    $sql .= " WHERE sentiments.sentiment_label IN ($placeholders)";
}

$sql .= " ORDER BY product_review_comments.id DESC";

$stmt = $conn->prepare($sql);

// Bind parameters if sentiments are selected
if ($sentiments !== '') {
    $types = str_repeat('s', count($sentiment_values));
    $stmt->bind_param($types, ...$sentiment_values);
}

$stmt->execute();
$result = $stmt->get_result();

// Display reviews
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $first_name = $row['first_name'];
        $product_name = $row['name'];
        $review_text = $row['review_text'];
        $sentiment = $row['sentiment_label'];
        $sentiment_score = $row['sentiment_score'];
        $sentimentClass = strtolower($sentiment);

        
        echo "<tr>";
        echo "<td>" . htmlspecialchars($first_name) . "</td>";
        echo "<td>" . htmlspecialchars($product_name) . "</td>";
        echo "<td>" . htmlspecialchars($review_text) . "</td>";
        echo "<td class='sentiment-$sentimentClass'>" . htmlspecialchars($sentiment) . "</td>";
        echo "<td>" . number_format($sentiment_score, 2) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No reviews found.</td></tr>";
}

$conn->close();
?> 