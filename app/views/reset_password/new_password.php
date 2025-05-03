<?php
    if (!isset($_GET['email'])) {
        header("Location: confirm_email.php"); // Return to confirm_email.php if email was not fetched properly.
        exit();
    }

    // Get and decode the email parameter from confirm_email.php
    $email = urldecode($_GET['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../../../public/assets/css/login-register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>

    <header class="promo-header">
        <div class="promo-header-links">
            <a href="#" class="shopee-login">
                <img src="../../../public/assets/images/splash-arts/shopee-header.png" alt="icon" class="shopee-header-image">
                <span class="shopee-login-text">Reset Password</span>
            </a>
            <a href="#" class="help-link">Need Help?</a>
        </div>
    </header>

    <div class="wrapper">
        <form method="POST" action="../../controllers/reset_password.php">
            <div class="">
                <a class="text-decoration-none" href="./confirm_email.php">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div>Set your password</div>
            <div>Create a new password for</div>
            <div>
                <?php echo htmlspecialchars($email); ?>
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">  
            </div>
            <div class="form-group">
                <label for="new-password">New Password</label>
                <input type="" class="form-control" id="new-password" name="new-password" placeholder="Password">   <!--PLEASE ADD VIEW TOGGLE ON PASSWORD FIELD -->
            </div>
            <button type="submit" class="btn btn-primary" name="reset-password">Next</button>
        </form>
    </div>
</body>
</html>
