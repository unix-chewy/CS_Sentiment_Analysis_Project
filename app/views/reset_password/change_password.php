<?php
    session_start();
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../../../public/assets/css/login-register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <header class="promo-header">
        <div class="promo-header-links">
            <a href="#" class="shopee-login">
                <img src="../../../public/assets/images/splash-arts/shopee-header.png" alt="icon" class="shopee-header-image">
                <span class="shopee-login-text">Change Password</span>
            </a>
            <a href="#" class="help-link">Need Help?</a>
        </div>
    </header>

    <div class="wrapper">
        <form class="form-group">
            <div class="">
                <a class="text-decoration-none" href="./confirm_email.php">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="form-group">
                <label for="current-password">Current Password</label>
                <input type="" class="form-control" id="current-password" name="current-password" placeholder="Password" required>
            </div>
            <div>
                <?php echo htmlspecialchars($email); ?>
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">  
            </div>
            <div class="form-group">
                <label for="new-password">New Password</label>
                <input type="" class="form-control" id="new-password" name="new-password" placeholder="Password" required>   <!--PLEASE ADD VIEW TOGGLE ON PASSWORD FIELD -->
            </div>
            <button type="submit" class="btn btn-primary" id="change-password" name="change-password">Change Password</button>
        </form>
    </div>
    <script src="../../../public/assets/js/password-management.js"></script>
</body>
</html>
