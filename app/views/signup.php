<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee Login</title>
    <link rel="stylesheet" href="../../public/assets/css/login-register.css">
</head>
<body>

<header class="promo-header">
        <div class="promo-header-links">
            <a href="#" class="shopee-login">
                <img src="../../public/assets/images/shopee-header.png" alt="icon" class="shopee-header-image">
                <span class="shopee-login-text">Sign Up</span>
            </a>
            <a href="#" class="help-link">Need Help?</a>
        </div>
    </header>

    <div class="wrapper">
        <div class="center-background-bar"></div> 
        <div class="login-page">
            <!-- Left -->
            <div class="image-section">
                <img src="../../public/assets/images/splash-arts/shopee-1.png" alt="Placeholder Image" class="image-left">
            </div>
            <!-- Right  -->
            <div class="login-section">
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
        </div>
    </div>
</body>
</html>

