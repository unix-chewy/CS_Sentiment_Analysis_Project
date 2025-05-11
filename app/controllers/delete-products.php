<?php include '../config/login-config.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["id"]) || !is_numeric($_POST["id"])) {
        echo json_encode(["success" => false, "message" => "Invalid product ID"]);
        exit;
    }
    $id = intval($_POST["id"]);

    // Deleting Sentiments
    if ($conn->query("DELETE FROM sentiments WHERE product_id = $id") !== TRUE) {
        echo json_encode(["success" => false, "message" => "Error deleting sentiment: " . $conn->error]);
        exit;
    }

    // Deleting Reviews
    if ($conn->query("DELETE FROM product_review_comments WHERE product_id = $id") !== TRUE) {
        echo json_encode(["success" => false, "message" => "Error deleting reviews: " . $conn->error]);
        exit;
    }

    // Deleting Ratings
    if ($conn->query("DELETE FROM product_votes WHERE product_id = $id") !== TRUE) {
        echo json_encode(["success" => false, "message" => "Error deleting ratings: " . $conn->error]);
        exit;
    }

    // Delete the product itself
    if ($conn->query("DELETE FROM products WHERE id = $id") === TRUE) {
        echo json_encode(["success" => true, "message" => "Product and related reviews deleted successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting product: " . $conn->error]);
    }
}
?>
