<?php include '../config/login-config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item-name'];
    $item_description = $_POST['item-description'];
    $item_category = $_POST['item-category'];
    $item_price = $_POST['item-price'];
    $imgData = file_get_contents($_FILES['item-image']['tmp_name']);

    // Handles the case when ADD NEW item category was selected
    if ($item_category === "-1") {
        $new_category = $_POST['new-category']; // Get new category name
        $sql_cat = "INSERT INTO categories (product_category) VALUES(?)";
        $stmt = $conn->prepare($sql_cat);
        $stmt->bind_param('s', $new_category);
        $stmt->execute() or die("<b>Error:</b> Problem on adding new category<br/>" . mysqli_connect_error());
        $item_category = $conn->insert_id;  // Store last inserted ID
        }

        
    $sql = "INSERT INTO products (name, photo, description, price, category_id) VALUES(?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssii', $item_name, $imgData, $item_description, $item_price, $item_category);
    $stmt->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
    $stmt->close();
    }
?>