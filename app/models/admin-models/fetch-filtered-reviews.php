<?php
include "../../config/login-config.php";
// reused code from fetch-products.php
// Get what user typed
$sentiments = isset($_GET['sentiments']) ? $_GET['sentiments'] : '';
$product = isset($_GET['product']) ? $_GET['product'] : '';

// Make the basic query
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

// Add search conditions one by one
if ($product != '') {
    $sql = $sql . " WHERE products.name LIKE '%" . $product . "%'";
}

if ($sentiments != '') {
    $feelings = explode(',', $sentiments);
    if ($product != '') {
        $sql = $sql . " AND sentiments.sentiment_label IN ('" . implode("','", $feelings) . "')";
    } else {
        $sql = $sql . " WHERE sentiments.sentiment_label IN ('" . implode("','", $feelings) . "')";
    }
}

// Sort by newest first
$sql = $sql . " ORDER BY product_review_comments.id DESC";

// Run the query
$result = $conn->query($sql);

// Show the reviews
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
} 

$conn->close();
?> 