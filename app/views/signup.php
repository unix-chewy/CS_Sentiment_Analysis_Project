<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/css/signup.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <header class="promo-header">
        <div class="container-fluid">
            <div class="promo-header-links row align-items-center">
                <div class="col-auto">
                    <a href="#" class="shopee-login">
                        <img src="../../public/assets/images/splash-arts/shopee-header.png" alt="icon" class="shopee-header-image img-fluid">
                        <span class="shopee-login-text">Sign Up</span>
                    </a>
                </div>
                <div class="col-auto ms-auto">
                    <a href="#" class="help-link">Need Help?</a>
                </div>
            </div>
        </div>
    </header>

    <div class="wrapper">
        <div class="center-background-bar"></div>
        <div class="login-page container">
            <div class="row g-0" style="min-height: 550px;">
                <!-- Left Image Section -->
                <div class="col-md-6 d-none d-md-flex image-section align-items-center justify-content-center">
                    <img src="../../public/assets/images/splash-arts/shopee-1.png" 
                         alt="Shopee" 
                         class="image-left img-fluid h-100"
                         style="object-fit: contain;">
                </div>

                <!-- Right Signup Section -->
                <div class="col-md-6 bg-white p-4 p-lg-5">
                    <div class="signup-content">
                        <h2 class="signup-title text-center mb-4">Sign Up</h2>
                        
                        <form class="signup-form" id="signup-form" method="POST" action="../controllers/login-register.php">
                            <div class="form-group">
                                <input type="text" name="fname" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="lname" placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="pass" placeholder="Password" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" name="confirm_pass" placeholder="Confirm Password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-submit" name="signup_button">
                                SIGN UP
                            </button>
                        </form>

                        <div class="footer-links mt-4">
                            <div class="or-divider text-center my-4">
                                <span>────────── OR ──────────</span>
                            </div>

                            <div class="social-login d-flex gap-3 justify-content-center mb-4">
                                <button class="btn-social">
                                    <i class="icon-fb"></i>Facebook
                                </button>
                                <button class="btn-social">
                                    <i class="icon-google"></i>Google
                                </button>
                            </div>

                            <p class="signup-link text-center">
                                Have an account? <a href="login.php" id="signup-href">Log in</a>
                            </p>
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