<?php include '../config/login-config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    $product_id = $_POST['product_id'] ?? null;
    $review_text = $_POST['review'];
    $rating = $_POST['rating'];

    if (!empty($review_text) && !empty($rating)) {

        $stmt = $conn->prepare("INSERT INTO product_review_comments (user_id, product_id, review_text) VALUES (?,?,?)");
        $stmt -> bind_param("iis", $user_id, $product_id, $review_text);
        $stmt -> execute();        
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO product_votes (product_id, user_id, votes) VALUES (?,?,?)");
        $stmt -> bind_param("iii", $product_id, $user_id, $rating);
        $stmt -> execute();
        $stmt->close();
    } 

    else {
        echo "please fill out the review form!!!!!";
    }
}

?>