<?php
include '../config/login-config.php';

// Register
if (isset($_POST['signup_button'])) {
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['confirm_pass'];

    if ($password !== $confirm_password) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match!"]);
        exit();
    }

    $hashed_pass = md5($password);

    // Determine role_id
    $role_id = isset($_POST['role']) && $_POST['role'] === 'admin' ? 1 : 2; // Admin or User

    // Check for existing email
    $check_email = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email already exists!"]);
    } else {
        $insert_query = "INSERT INTO users (first_name, last_name, email, password, role_id) 
                         VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssssi", $first_name, $last_name, $email, $hashed_pass, $role_id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "User added!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
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

        // Prepare a response with role-based message
        $message = ($_SESSION['role'] == 1) ? "Admin login successful!" : "User login successful!";

        echo json_encode([
            "status" => "success",
            "message" => $message,
            "role" => $_SESSION['role']
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Incorrect email or password!"]);
    }
}
?>
