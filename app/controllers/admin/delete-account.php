<?php
include "../../config/login-config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // First delete PRC and PRV to avoid the foreign key errors
    $delete_reviews_query = "DELETE FROM product_review_comments WHERE user_id = $id";
    if ($conn->query($delete_reviews_query) !== TRUE) {
        echo "Error deleting reviews: " . $conn->error;
        exit;
    }

    $delete_votes_query = "DELETE FROM product_votes WHERE user_id = $id";
    if ($conn->query($delete_votes_query) !== TRUE) {
        echo "Error deleting votes: " . $conn->error;
        exit;
    }

    // Delete the user
    $delete_user_query = "DELETE FROM users WHERE id = $id";
    if ($conn->query($delete_user_query) === TRUE) {
        echo "User and related data deleted successfully!";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid request or missing ID";
}

$conn->close();
?> 