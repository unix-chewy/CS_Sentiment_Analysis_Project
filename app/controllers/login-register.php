<?php include '../config/login-config.php';

// Register
if (isset($_POST['signup_button'])) {
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['confirm_pass'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    $hashed_pass = md5($password);

    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);
    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } 
    else{
        $insert_query = "INSERT INTO users (first_name, last_name, email, password, role_id) 
                        VALUES ('$first_name', '$last_name', '$email', '$hashed_pass', 2)";
        
        if ($conn->query($insert_query) === TRUE) {
            echo "Registration successful!";
            header("Location: ../views/login.php");
            exit();
        } 
        else{
            echo "Error: " . $conn->error;
        }
    }
}

// Login
if (isset($_POST['login_button'])) {
    $email = $_POST['email'];
    $password = md5($_POST['pass']); 

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role_id']; 

        if ($_SESSION['role'] == 1) {
            header("Location: ../views/admin/admin_homepage.php");
        }
        else{
            header("Location: ../views/user/user_homepage.php");
        }
        exit();
    }
    else{
        echo "Incorrect email or password!";
    }
}
?>