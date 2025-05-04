<?php include '../config/login-config.php';

// This code block confirms the email of the user
if (isset($_POST['confirm-email'])) {
    $email = $_POST['email'];

    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);

    // If email exists
    if ($result->num_rows > 0) {

        // urlencode() = Encoding a string to be used in a query part of a URL, as a convenient way to pass variables to the next page.
        header("Location: ../views/reset_password/new_password.php?email=" . urlencode($email));
        exit();
    } 
    // If email does not exist, pass error back to confirm_email.php
    else {
        header("Location: ../views/reset_password/confirm_email.php?error=account_not_found");    // passes query parameter ['error']
        exit();
        }
}

// This code block resets the password of the user
if (isset($_POST['reset-password'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new-password'];
    $hashed_pass = md5($new_password);

    // Look for account from db and get ID
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


    $update_stmt = "UPDATE users SET password = '$hashed_pass' WHERE id = '$user_id'";  // SQL query replacing old with new pw
    
    // This code runs the statement and redirects to the login page if SUCCESSFUL
    if ($result = $conn->query($update_stmt)) {
        echo "Password reset successful!";
        header("Location: ../views/login.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>