<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Links -->
    <link rel="stylesheet" href="../../../public/assets/css/reset-password.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header class="promo-header">
        <div class="container-fluid">
            <div class="promo-header-links row align-items-center">
                <div class="col-auto">
                    <a href="#" class="shopee-login">
                        <img src="../../../public/assets/images/splash-arts/shopee-header.png" alt="icon" class="shopee-header-image img-fluid">
                        <span class="shopee-login-text d-none d-md-inline">Reset Password</span>
                    </a>
                </div>
                <div class="col-auto ms-auto">
                    <a href="#" class="help-link">Need Help?</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="wrapper">
        <div class="center-background-bar">
            <div class="login-page container">
                <div class="row g-0 justify-content-center">
                    <!-- Right Reset Password Section -->
                    <div class="col-md-6 bg-white p-4 p-lg-5 right-login">
                        <div class="login-content">
                            <!-- Back Button -->

                            <!-- Reset Password Form -->
                            <form method="POST" action="../../controllers/reset_password.php">
                                <h3 class="mb-4">Reset Your Password</h3>
                                <p class="mb-4">Enter your email to receive a password reset link</p>
                                
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" 
                                           class="form-control form-control-lg" 
                                           id="email" 
                                           name="email" 
                                           placeholder="Enter your email"
                                           required>
                                    
                                    <!-- Error message -->
                                    <?php if (isset($_GET['error']) && $_GET['error'] === 'account_not_found'): ?>    
                                        <div class="text-danger mt-2">Account does not exist.</div>
                                    <?php endif; ?>
                                    
                                    <small id="emailHelp" class="form-text text-muted mt-2">
                                        We'll never share your email with anyone else.
                                    </small>
                                </div>

                                <button type="submit" 
                                        class="btn btn-primary w-100 py-2 mt-3" 
                                        name="confirm-email">
                                    Continue
                                </button>
                            </form>

                            <!-- Footer Links -->
                            <div class="footer-links mt-4">
                                <p class="text-center text-muted">
                                    Remember your password? 
                                    <a href="../login.php" class="text-decoration-none text-danger">
                                        <br>Log In
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>