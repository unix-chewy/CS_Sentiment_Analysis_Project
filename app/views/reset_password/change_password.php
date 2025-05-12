<?php
    session_start();
    $email = $_SESSION['email'];
    $user_role = $_SESSION['role'];
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
    <link rel="stylesheet" href="../../../public/assets/css/reset-password.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <!-- Header -->
    <header class="promo-header">
      <div class="promo-header-links">
        <a href="#" class="shopee-login">
          <img src="../../../public/assets/images/splash-arts/shopee-header.png" alt="icon" class="shopee-header-image">
          <span class="shopee-login-text">Change Password</span>
        </a>
        <a href="#" class="help-link">Need Help?</a>
      </div>
    </header>

<!-- Main Content -->
<div class="wrapper">
  <div class="center-background-bar">
    <div class="login-page container">
      <div class="row g-0 justify-content-center">
        <!-- Right Change Password Section -->
        <div class="col-md-6 bg-white p-4 p-lg-5 right-login">
          <div class="login-content">
            <form class="form-group" id="change-password-form">
              <h3 class="mb-4">Change Password</h3>

              <!-- Current Password -->
              <div class="form-group mb-3">
                <label for="current-password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password" required>
                <a href="confirm_email.php" class="forgot-password">Forgot Password?</a>
              </div>

              <!-- Email (Hidden) -->
              <input type="hidden" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

              <!-- New Password -->
              <div class="form-group mb-3">
                <label for="new-password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Password" required>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary w-100 py-2 mt-2" id="change-password" name="change-password">
                Change Password
              </button>

              <!-- Back Button -->
                <div class="mt-4">
                    <input type="hidden" id="user-role" name="user-role" value="<?php echo htmlspecialchars($user_role); ?>">
                    <a href="#" id="back-button">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="../../../public/assets/js/password-management.js"></script>
  </body>
</html>