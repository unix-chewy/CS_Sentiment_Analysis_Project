<?php 
    header('Content-Type: application/json');
    include '../../config/login-config.php';
    session_start();  
    $user_id = $_SESSION['user_id'] ?? null;  // code ni Fritzch for checking user acc

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $product_id = intval($_GET['id']);
        $sql_checkreview = "SELECT * FROM product_review_comments WHERE user_id = ? AND product_id = ?";
        $stmt_checkreview = $conn->prepare($sql_checkreview);
        $stmt_checkreview->bind_param("ii", $user_id, $product_id);
        $stmt_checkreview->execute();
        $result_checkreview = $stmt_checkreview->get_result();
        
        if ($result_checkreview->num_rows > 0) {
            echo json_encode([
                'status' => 'exists',
                'redirect' => "../user/product-page.php?id=" . urlencode($product_id)
            ]);
        } else {
            echo json_encode([
                'status' => 'new',
                'message' => 'No review yet.'
            ]);
        }
        exit;
    }