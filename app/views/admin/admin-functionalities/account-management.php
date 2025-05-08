<?php  include '../../../config/login-config.php';
   $sql_category = "SELECT id, product_category FROM categories";
   $stmt_category = $conn->prepare($sql_category);
   $stmt_category->execute();
   $result_category = $stmt_category->get_result();
   ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
      <link rel="stylesheet" href="../../../../public/assets/css/admin/admin-functionalities/account-management.css">
      <title>Admin Homepage </title>
   </head>
   <body>
      <header class="sticky-top bg-white shadow-sm">
         <div class="container-fluid py-2">
            <nav class="d-flex justify-content-between align-items-center">
               <!-- Left section -->
               <div class="d-flex align-items-center gap-3">
                  <a class="nav-link p-0" href="#">Seller Centre</a>
                  <a class="nav-link p-0" href="#">Start Selling</a>
                  <a class="nav-link p-0" href="#">Download</a>
                  <span class="text-muted small">Follow us on</span>
                  <div class="d-flex gap-2">
                     <a href="#" class="text-decoration-none"><i class="bi bi-facebook"></i></a>
                     <a href="#" class="text-decoration-none"><i class="bi bi-instagram"></i></a>
                  </div>
               </div>
               <!-- Right section -->
               <ul class="nav">
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                     <i class="bi bi-bell"></i> Notifications
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                     <i class="bi bi-question-circle"></i> Help
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                     <i class="bi bi-globe2"></i> English
                     </a>
                  </li>
               </ul>
            </nav>
            <!-- Logo -->
            <div class="d-flex align-items-center justify-content-between mt-3">
               <a class="logo" href="../admin_homepage.php">
               </a>
               <div class="cart-wrapper">
                  <div class="cart-icon-container">
                     <a href="#" class="cart-icon"></a>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </header>
      <div class="sidebar">
         <div class="sidebar-header">
            <h4>Admin Placeholder</h4>
            <!-- insert php logic here for admin name -->
         </div>
         <div class="sidebar-menu">
            <ul class="nav flex-column">
               <!-- Product Management -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="product-management.php">
                  <i class="bi bi-box-seam"></i> Product Management
                  </a>
               </li>
               <!-- Account Management -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="account-management.php">
                  <i class="bi bi-person-gear"></i> Account Management 
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">
                  <i class="bi bi-bar-chart"></i> View Analytics
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">
                  <i class="bi bi-download"></i> Export CSV
                  </a>
               </li>
            </ul>
         </div>
         <div class="sidebar-header">
         </div>
         <ul class="nav flex-column">
            <!-- Account  -->
            <li class="nav-item">
               <a class="nav-link collapsed" data-bs-toggle="collapse" href="#account-collapse">
               <i class="bi bi-person-circle"></i> Account <i class="bi bi-chevron-down ms-auto"></i>
               </a>
               <div class="collapse" id="account-collapse">
                  <ul class="nav flex-column ps-4">
                     <li class="nav-item">
                        <a class="nav-link" href="#">
                        <i class="bi bi-person-gear"></i> Change Password
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="../../login.php">
                        <i class="bi bi-box-arrow-right"></i> Sign Out
                        </a>
                  </ul>
               </div>
            </li>
         </ul>
      </div>
      </div>

      <!-- Main Content  -->
      <div class="main-content">
      <h1 class="mb-4">Accounts</h1>
      <!-- Search Bar -->
      <div class="d-flex justify-content-center my-4">
         <form class="d-flex flex-grow-1 search-form">
            <input class="form-control" type="search" placeholder="Search accounts..." aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">
            <i class="bi bi-search"></i>
            </button>
         </form>
      </div>
      <div class="row" id="account-cards-container">
         <!-- AJAX content goes here -->
      </div>
      <!-- Buttons for add -->
      <div class="text-center my-4">
         <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User/Admin</button>
      </div>

      <!-- The Modals -->

      <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content p-0">
      <div class="wrapper w-100">
        <div class="login-page d-flex justify-content-center w-100">
          <!-- Right Form Section Only -->
          <div class="login-section no-image w-100">
            <div class="login-content">

              <form class="signup-form" id="signup-form" method="POST" action="../../../controllers/login-register.php">
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
                <div class="form-group">
                  <input type="password" name="confirm_pass" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                  <label for="role" class="form-label">Select Role</label>
                  <select name="role" id="role" class="form-select" required>
                    <option value="">-- Choose Role --</option>
                    <option value="user">User</option>
                    <option value="admin">Administrator</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-submit mt-3" name="signup_button">Create Account</button>
              </form>

            </div>
          </div>
        </div>
      </div>
      <!-- Close Button -->
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
  </div>
</div>

<script src="../../../../public/assets/js/login-register.js"> </script>
   </body>
</html>