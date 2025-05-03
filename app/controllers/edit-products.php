<?php include '../config/login-config.php';


// Reused code for saving products
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"]; 
    $item_name = $_POST['item-name'];
    $item_description = $_POST['item-description'];
    $item_price = $_POST['item-price'];
    $item_category = $_POST['item-category'];

        // Get the image details
        $filename = $_FILES["item-image"]["name"];
        $tempname = $_FILES["item-image"]["tmp_name"];
        $folder = "../../public/assets/images/products/";  // Folder where images will be stored
        $old_image = $_POST["old-image"]; // old photo if ever admin does not want to change image product

        // Get only the file name (not the full path) and Move the uploaded image to /products
        if (!empty($filename)) {
            $file_path = $folder . $filename;
            if (move_uploaded_file($tempname, $file_path)) {
                echo "Image uploaded successfully!";
            } else {
                echo "Failed to upload image!";
            }
        } else {
            $filename = $old_image; // retain old image if user doesn't upload a new product photo 
        }

    if ($id) {
        $query = "UPDATE products SET name = '$item_name', photo = '$filename', description = '$item_description', price = '$item_price', 
        category_id = '$item_category' WHERE id = $id";
    } else {
        $query = "INSERT INTO products (name, photo, description, price, category_id) VALUES ('$item_name', '$filename', '$item_description',
        '$item_price', '$item_category')";
    }

    if ($conn->query($query)) {
        echo "Product Edited successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>