<?php
    include "../../config/login-config.php";
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=sentiment-analysis.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['sentiment_id', 'product_name', 'user_first_name', 'user_last_name', 'rating',
                        'review_text', 'sentiment_label', 'sentiment_score']);
    
    $sql = "SELECT
                sentiments.id AS sentiment_id,
                products.name AS product_name,
                users.first_name AS user_first_name,
                users.last_name AS user_last_name,
                product_votes.votes AS rating,
                product_review_comments.review_text AS review_text,
                sentiments.sentiment_label AS sentiment_label,
                sentiments.sentiment_score AS sentiment_score
            FROM sentiments
            LEFT JOIN products ON sentiments.product_id = products.id
            LEFT JOIN product_review_comments 
                ON sentiments.product_id = product_review_comments.product_id 
                AND sentiments.user_id = product_review_comments.user_id
            LEFT JOIN product_votes 
                ON sentiments.product_id = product_votes.product_id 
                AND sentiments.user_id = product_votes.user_id
            LEFT JOIN users ON sentiments.user_id = users.id
            ORDER BY products.name ASC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
    fclose($output);
?>