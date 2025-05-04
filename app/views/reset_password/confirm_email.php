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

    <!-- Main -->
    <div class="wrapper">
        <form method="POST" action="../../controllers/reset_password.php">  <!-- reset_password.php -->
            <div class="">
                <a class="text-decoration-none" href="../login.php">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="center">Reset Password</div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>

                <!-- This php code checks if there is an error passed from URL and the error is account_not_found then displays error msg. -->
                <?php if (isset($_GET['error']) && $_GET['error'] === 'account_not_found'): ?>    
                    <div class="text-danger mt-1">Account does not exist.</div>
                <?php endif;?>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <button type="submit" class="btn btn-primary" name="confirm-email">Continue</button>
        </form>
    </div>
</body>
</html>
