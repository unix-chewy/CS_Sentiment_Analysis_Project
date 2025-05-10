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

            // Fetch all reviews for this product
            $sql_reviews = "SELECT 
                prc.review_text, 
                prc.user_id, 
                u.first_name, 
                u.last_name, 
                pv.votes AS rating
            FROM product_review_comments prc
            JOIN users u ON prc.user_id = u.id
            LEFT JOIN product_votes pv ON prc.prv_id = pv.id
            WHERE prc.product_id = ?
            ORDER BY prc.id DESC";

            $stmt_reviews = $conn->prepare($sql_reviews);
            $stmt_reviews->bind_param("i", $product_id);
            $stmt_reviews->execute();
            $result_reviews = $stmt_reviews->get_result();

            $reviews = [];
            while ($row = $result_reviews->fetch_assoc()) {
                $reviews[] = [
                    'username' => $row['first_name'] . ' ' . $row['last_name'],
                    'rating' => $row['rating'],
                    'review' => $row['review_text']
                ];
            }
        } else {
            echo "Product not found.";
            exit;
        }
    } else {
        echo "No product ID provided.";
        exit;
    }
?>

