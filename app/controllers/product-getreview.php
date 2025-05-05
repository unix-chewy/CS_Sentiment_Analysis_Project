<?php include '../config/login-config.php';

session_start();

if (isset($_POST['add-review'])) {
    $user_id = $_POST['user_id'] ?? null;
    $product_id = $_POST['product_id'] ?? null;
    $review_text = $_POST['review'];
    $rating = $_POST['rating'];

    if (!empty($review_text) && !empty($rating)) {


        $stmt = $conn->prepare("INSERT INTO product_votes (product_id, user_id, votes) VALUES (?,?,?)");
        $stmt -> bind_param("iii", $product_id, $user_id, $rating);
        $stmt -> execute();
        $prv_id = $conn->insert_id;
        $stmt->close();


        $stmt = $conn->prepare("INSERT INTO product_review_comments (user_id, product_id, review_text, prv_id) VALUES (?,?,?,?)");
        $stmt -> bind_param("iisi", $user_id, $product_id, $review_text, $prv_id);
        $stmt -> execute();        
        $stmt->close();

        
    } 

    else {
        echo "please fill out the review form!!!!!";
    }
}


if (isset($_POST['update-review'])) {
    $prc_id = $_POST['prc_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;
    $product_id = $_POST['product_id'] ?? null;
    $prv_id = $_POST['prv_id'] ?? null;
    $review_text = $_POST['review'];
    $rating = $_POST['rating'];

    if (!empty($review_text) && !empty($rating)) {

        $update_stmt = $conn->prepare("UPDATE product_votes SET votes = ? WHERE id = ?");
        $update_stmt -> bind_param("ii", $rating, $prv_id);
        $update_stmt -> execute();
        $update_stmt->close();


        $update_stmt = $conn->prepare("UPDATE product_review_comments SET review_text = ? WHERE id = ?");
        $update_stmt -> bind_param("si", $review_text, $prc_id);
        $update_stmt -> execute();        
        $update_stmt->close();

        
    } 

    else {
        echo "please fill out the review form!!!!!";
    }
}

?>