<?php include '../config/login-config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store id values
    $prc_id = intval($_POST["prc_id"]);
    $prv_id = intval($_POST["prv_id"]);
    $sen_id = intval($_POST["sen_id"]);

    $delete_sentiment_stmt = "DELETE FROM sentiments where id = $sen_id";
    if ($conn->query($delete_sentiment_stmt) !== TRUE) {
        echo "Error deleting sentiment: " . $conn->error;
        exit; 
    }

    // Deleting product_review_comment first because of FK constraint
    $delete_comment_stmt = "DELETE FROM product_review_comments where id = $prc_id";
    if ($conn->query($delete_comment_stmt) !== TRUE) {
        echo "Error deleting comment: " . $conn->error;
        exit; 
    }

    // Delete product_votes next
    $delete_vote_stmt = "DELETE FROM product_votes where id = $prv_id";
    if ($conn->query($delete_vote_stmt) !== TRUE) {
        echo "Error deleting rating: " . $conn->error;
        exit; 
    }
}
?>
