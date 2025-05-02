<?php include '../config/login-config.php';

// This code block confirms the email of the user
if (isset($_POST['confirm-email'])) {
    $email = $_POST['email'];

    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);
    if ($result->num_rows > 0) {
        header("Location: ../views/reset_password/new_password.php?email=" . urlencode($email));
        exit();
    } 
    // EDIT ERROR IF NO EMAIL EXISTS
    else{
        echo "ACCOUNT DOES NOT EXIST!";
    }
}

// This code block resets the password of the user
if (isset($_POST['reset-password'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new-password'];

    $get_id = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($get_id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
    } 
    else {
        echo "ACCOUNT DOES NOT EXIST!";
        exit();
    }

    $hashed_pass = md5($new_password);

    $update_stmt = "UPDATE users SET password = '$hashed_pass' WHERE id = '$user_id'";
    
    if ($result = $conn->query($update_stmt)) {
        echo "Password reset successful!";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>