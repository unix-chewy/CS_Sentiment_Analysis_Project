<?php
include '../config/login-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"]; 

    // Deleting Reviews First to ensure no foreigns key constraint blocks the deletion process
    $delete_review_query = "DELETE FROM product_review_comments WHERE product_id = $id";
    if ($conn->query($delete_review_query) !== TRUE) {
        echo "Error deleting reviews: " . $conn->error;
        exit; 
    }

    // Deleting Review Ratings First to ensure no foreigns key constraint blocks the deletion process
    $delete_ratings_query = "DELETE FROM product_votes WHERE product_id = $id";
    if ($conn->query($delete_ratings_query) !== TRUE) {
        echo "Error deleting ratings : " . $conn->error;
        exit; 
    }

    // Delete the product itself
    $delete_product_query = "DELETE FROM products WHERE id = $id";
    if ($conn->query($delete_product_query) === TRUE) {
        echo "Product and related reviews deleted successfully!";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}
?>
