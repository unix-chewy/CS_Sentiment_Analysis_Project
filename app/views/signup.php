<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee Login</title>
    <link rel="stylesheet" href="../../public/assets/css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-content">
            <form class="login-form" method="POST" action="../controllers/login-register.php">
                <div class="form-group">
                    <input type="text" name = "fname" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name = "lname" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name = "email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name = "pass" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name = "confirm_pass" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-submit" name="signup_button">SIGN UP</button>
            </form>
            <div class="footer-links">
                <div class="or-divider">──────────    OR    ──────────</div>
                <div class="social-login">
                    <button class="btn-social facebook"><i class="icon-fb"></i>Facebook</button>
                    <button class="btn-social google"><i class="icon-google"></i>Google</button>
                </div>
                <p class="signup-link">Have an account? <a href="login.php" id="signup-href">Log in</a></p>
            </div>
        </div>
    </div>
</body>
</html>