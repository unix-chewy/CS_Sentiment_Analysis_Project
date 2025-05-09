<?php
include "../../config/login-config.php";

// reused code from edit-products.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];
    
    $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', 
    email = '$email', role_id = '$role_id' WHERE id = $user_id";
    
    if ($conn->query($query)) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $conn->error;
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?> 