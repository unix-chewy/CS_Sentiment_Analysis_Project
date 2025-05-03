<?php include '../../config/login-config.php';
    session_start();

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $sql_product = "SELECT * FROM products ORDER BY id";
    $stmt_product = $conn->prepare($sql_product);
    $stmt_product->execute();
    $result_product = $stmt_product->get_result();
    $product = $result_product->fetch_assoc();
    $product_id = $product['id'];
?>
