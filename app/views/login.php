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
            <div class="login-options">
                <p>Log In</p>
                <button class="btn btn-qr">Login with QR</button>
            </div>

            <form class="login-form">
                <div class="form-group">
                    <input type="text" placeholder="Phone number / Username / Email" required>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-submit">LOG IN</button>
            </form>

            <div class="footer-links">
                <a href="#" class="forgot-password">Forgot Password</a>
                <div class="or-divider">──────────    OR    ──────────</div>
                <div class="social-login">
                    <button class="btn-social facebook"><i class="icon-fb"></i>Facebook</button>
                    <button class="btn-social google"><i class="icon-google"></i>Google</button>
                </div>
                <p class="signup-link">New to Shopee? <a href="#" id="signup-href">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>
</html>