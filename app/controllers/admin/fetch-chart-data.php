<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "shopee_db";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: application/json');

// Get sentiment data
$sentiments = [];
$sqlSentiments = "SELECT * FROM sentiments";
$resSentiments = $conn->query($sqlSentiments);
if (! $resSentiments) {
    die("Sentiments query failed: " . $conn->error);
}
while ($row = $resSentiments->fetch_assoc()) {
    $sentiments[] = $row;
}

// Get most rated products data
$most_rated_products = [];
$sqlMostRated = "
    SELECT 
        p.name as product_name,
        COUNT(prc.id) as review_count
    FROM products p
    LEFT JOIN product_review_comments prc ON p.id = prc.product_id
    GROUP BY p.id, p.name
    ORDER BY review_count DESC
    LIMIT 3
";
$resMostRated = $conn->query($sqlMostRated);
if (! $resMostRated) {
    die("Most rated products query failed: " . $conn->error);
}
while ($row = $resMostRated->fetch_assoc()) {
    $most_rated_products[] = $row;
}

// Get category data
$categories = [];
$sqlCategories = "
    SELECT
      c.product_category,
      COUNT(s.id) AS count
    FROM sentiments s
    JOIN products p ON s.product_id = p.id
    JOIN categories c ON p.category_id = c.id
    GROUP BY c.product_category
";
$resCategories = $conn->query($sqlCategories);
if (! $resCategories) {
    die("Categories query failed: " . $conn->error);
}
while ($row = $resCategories->fetch_assoc()) {
    $categories[] = $row;
}

// Get sentiment trends per month (Positive/Neutral/Negative over time)
$sentiment_trends = [];
$sqlTrends = "
    SELECT
      s.sentiment_label,
      DATE_FORMAT(prc.created_at, '%Y-%m') AS month,
      COUNT(*) AS review_count
    FROM sentiments s
    JOIN product_review_comments prc ON s.review_id = prc.id
    GROUP BY s.sentiment_label, month
    ORDER BY month, s.sentiment_label
";
$resTrends = $conn->query($sqlTrends);
if (! $resTrends) {
    die("Sentiment trends query failed: " . $conn->error);
}
while ($row = $resTrends->fetch_assoc()) {
    $row['review_count'] = (int) $row['review_count'];
    $sentiment_trends[] = $row;
}

echo json_encode([
    'sentiments'        => $sentiments,
    'categories'        => $categories,
    'sentiment_trends'  => $sentiment_trends,
    'most_rated_products' => $most_rated_products
]);
exit;
?>