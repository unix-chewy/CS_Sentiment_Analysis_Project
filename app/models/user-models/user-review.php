<?php include '../../config/login-config.php';


    $user_id = $_SESSION['user_id'] ?? null;  // code ni Fritzch for checking user acc

    if (isset($_GET['id'])) {  // reused code and tweaked, refer to product-controller.php for explanation
        $product_id = intval($_GET['id']);

        $sql_product = "SELECT * FROM products WHERE id = ?"; // select product id from database na nag mmatch dun sa url
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->bind_param("i", $product_id);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();

        if ($result_product->num_rows === 1) {  // for safety
            $product = $result_product->fetch_assoc();
        } else {
            echo "Product not found.";
            exit;
        }
    } else {
        echo "No product ID provided.";
        exit;
    }
?>
