<?php include '../config/login-config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item-name'];
    $item_description = $_POST['item-description'];
    $item_category = $_POST['item-category'];
    $item_price = $_POST['item-price'];
    $imgData = file_get_contents($_FILES['item-image']['tmp_name']);
    $sql = "INSERT INTO products (name, photo, description, price, category_id) VALUES(?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssii', $item_name, $imgData, $item_description, $item_price, $item_category);
    $stmt->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
    $stmt->close();
    }
?>