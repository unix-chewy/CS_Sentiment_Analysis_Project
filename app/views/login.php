<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/css/login-register.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <header class="promo-header">
        <div class="container-fluid">
            <div class="promo-header-links row align-items-center">
                <div class="col-auto">
                    <a href="#" class="shopee-login">
                        <img src="../../public/assets/images/splash-arts/shopee-header.png" alt="icon" class="shopee-header-image img-fluid">
                        <span class="shopee-login-text d-none d-md-inline">Log In</span>
                    </a>
                </div>
                <div class="col-auto ms-auto">
                    <a href="#" class="help-link">Need Help?</a>
                </div>
            </div>
        </div>
    </header>


<div class="wrapper">
    <div class="center-background-bar">
    <div class="login-page container">
        <div class="row g-0">
            <!-- Left Image Section -->
            <div class="col-md-6 d-none d-md-flex image-section align-items-center justify-content-center">
                <img src="../../public/assets/images/splash-arts/shopee-1.png" 
                     alt="Shopee" 
                     class="image-left img-fluid h-100"
                     style="object-fit: contain;">
            </div>

            <!-- Right Login Section -->
            <div class="col-md-6 bg-white p-4 p-lg-5 right-login">
                <div class="login-content">
                    <!-- Login Options -->
                    <div class="login-options d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0">Log In</h3>
                        <button class="btn btn-qr btn-outline-warning py-2 px-3">
                            Login with QR
                        </button>
                    </div>

                    <!-- Login Form -->
                    <form class="login-form" id="login-form" method="POST" action="../controllers/login-register.php">
                        <div class="form-group mb-3">
                            <input type="email" 
                                   name="email" 
                                   class="form-control form-control-lg" 
                                   placeholder="Email" 
                                   required>
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" 
                                   name="pass" 
                                   class="form-control form-control-lg" 
                                   placeholder="Password" 
                                   required>
                        </div>
                        <button type="submit" 
                                class="btn btn-primary w-100 py-2" 
                                name="login_button">
                            LOG IN
                        </button>
                    </form>

                    <!-- Footer Links -->
                    <div class="footer-links mt-4">
                        <a href="./reset_password/confirm_email.php" 
                           class="forgot-password d-block text-decoration-none text-primary mb-3">
                            Forgot Password?
                        </a>

                        <!-- OR Divider -->
                        <div class="or-divider position-relative text-center my-4">
                            <hr class="my-4">
                            <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted">
                                OR
                            </span>
                        </div>

                        <!-- Social Login -->
                        <div class="social-login d-flex gap-3 justify-content-center mb-4">

                            <button class="btn-social btn btn-outline-dark d-flex align-items-center">
                                <i class="icon-fb me-2"></i>Facebook
                            </button>
                            <button class="btn-social btn btn-outline-dark d-flex align-items-center">
                                <i class="icon-google me-2"></i>Google
                            </button>
                        </div>

                        <p class="signup-link text-center text-muted">
                            New to Shopee? 
                            <a href="signup.php" id="signup-href" class="text-decoration-none text-danger">
                                Sign Up
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/assets/js/login-register.js"></script>
</body>
</html>