<?php  include '../../config/login-config.php';


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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
      <link rel="stylesheet" href="../../../public/assets/css/admin/admin-homepage.css">
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
            <!-- Logo + Search -->
            <div class="d-flex align-items-center justify-content-between mt-3">
               <div class="logo">
               </div>
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
                  <a class="nav-link collapsed" href="admin-functionalities/product-management.php">
                  <i class="bi bi-box-seam"></i> Product Management </i>
                  </a>
               </li>

               <!-- Account Management -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="admin-functionalities/account-management.php">
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
                        <a class="nav-link" href="../login.php">
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
         <h1 class="mb-4">Welcome Admin Placeholder</h1>
         <div class="admin-card">
            <div class="admin-profile">
               <img src="placeholder" alt="Admin 2">
               <div>
                  <h6 class="mb-0">Admin Placeholder</h6>
                  <small class="text-muted">Last logged</small>
               </div>
            </div>
            <div class="admin-profile">
               <img src="placeholder" alt="Admin 3">
               <div>
                  <h6 class="mb-0">Admin Placeholder</h6>
                  <small class="text-muted">Last logged</small>
               </div>
            </div>
         </div>
      </div>
      <div class="main-content">
   <h2>Statistics Summary</h2>
   <canvas id="ratings-by-user-chart" height="100"></canvas>
</div>
    <script src="../../../public/assets/js/admin/admin-homepage-chart.js"></script>
   </body>
</html>
