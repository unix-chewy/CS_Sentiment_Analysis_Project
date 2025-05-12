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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Links -->
    <link rel="stylesheet" href="../../../public/assets/css/reset-password.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        <div class="center-background-bar py-5">
            <div class="login-page container">
                <div class="row g-0 justify-content-center">
                    <!-- Reset Password Section -->
                    <div class="col-md-10 bg-white p-4 p-lg-5 right-login">
                        <div class="login-content">
                            <!-- Back Button -->

                            <!-- Reset Password Form -->
                            <form method="POST" id="reset-password-form">
                                <input type="hidden" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                <div class="form-group">
                                    <label for="new-password">Enter New Password</label>
                                    <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Password" required>   <!--PLEASE ADD VIEW TOGGLE ON PASSWORD FIELD -->
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 mt-3" name="reset-password">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../public/assets/js/password-management.js"></script>
</body>
</html>