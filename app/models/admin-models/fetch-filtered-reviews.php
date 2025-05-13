<?php
include "../../config/login-config.php";

// Get parameters
$sentiments = isset($_GET['sentiments']) ? $_GET['sentiments'] : '';
$product = isset($_GET['product']) ? $_GET['product'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 5;
$offset = ($page - 1) * $items_per_page;

// Base query for counting and fetching
$base_query = "FROM product_review_comments
               JOIN users ON product_review_comments.user_id = users.id
               JOIN products ON product_review_comments.product_id = products.id
               JOIN sentiments ON product_review_comments.id = sentiments.review_id
               WHERE 1=1";

// Add search conditions
if ($product != '') {
    $base_query .= " AND products.name LIKE '%" . $product . "%'";
}

if ($sentiments != '') {
    $feelings = explode(',', $sentiments);
    $base_query .= " AND sentiments.sentiment_label IN ('" . implode("','", $feelings) . "')";
}

// Get total count
$count_query = "SELECT COUNT(*) as total " . $base_query;
$total_result = $conn->query($count_query);
$total_items = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_items / $items_per_page);

// Fetch reviews with pagination
$query = "SELECT 
            product_review_comments.id,
            users.first_name,
            products.name,
            product_review_comments.review_text,
            sentiments.sentiment_label,
            sentiments.sentiment_score
        " . $base_query . "
        ORDER BY product_review_comments.id DESC
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $items_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();

$output = "";
while ($row = $result->fetch_assoc()) {
    $sentimentClass = strtolower($row['sentiment_label']);
    $output .= "<tr>";
    $output .= "<td>" . htmlspecialchars($row['first_name']) . "</td>";
    $output .= "<td>" . htmlspecialchars($row['name']) . "</td>";
    $output .= "<td>" . htmlspecialchars($row['review_text']) . "</td>";
    $output .= "<td class='sentiment-$sentimentClass'>" . htmlspecialchars($row['sentiment_label']) . "</td>";
    $output .= "<td>" . number_format($row['sentiment_score'], 2) . "</td>";
    $output .= "</tr>";
}

// Add pagination info to the response
$pagination = [
    'current_page' => $page,
    'total_pages' => $total_pages,
    'total_items' => $total_items
];

echo json_encode([
    'html' => $output,
    'pagination' => $pagination
]);

$conn->close();
?> 