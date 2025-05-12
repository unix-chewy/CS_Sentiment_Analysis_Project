<?php  include '../../config/login-config.php';
include '../../controllers/admin/admin-session.php';
   // Get admin's first name from database
   $admin_id = $_SESSION['user_id'];
   $sql = "SELECT first_name FROM users WHERE id = $admin_id";
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   $first_name = $row['first_name'];

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
      <title>Admin Homepage</title>

      <!-- Bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

      <!-- jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

      <!-- Chart.js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <!-- Icons -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

      <!-- CSS Links -->
      <link rel="stylesheet" href="../../../public/assets/css/admin/admin-homepage.css">

      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
   </head>

   <body>
      <!-- Header -->
      <header class="sticky-top bg-white shadow-sm">
         <div class="container-fluid py-2">
            <!-- Logo -->
            <div class="d-flex align-items-center justify-content-between">
               <div class="logo"></div>
               <span class="admin-text"> Admin Center </span>
            </div>
         </div>
      </header>

      <div class="sidebar">
         <div class="sidebar-header">
            <h4><?php echo $first_name; ?></h4>
         </div>
         <div class="sidebar-menu">
            <ul class="nav flex-column">
               <!-- Home -->
               <li class="nav-item">
                  <a class="nav-link" href="admin_homepage.php">
                  <i class="bi bi-house"></i> Home
                  </a>
               </li>
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
                  <a class="nav-link" href="admin-functionalities/view-analytics.php">
                  <i class="bi bi-bar-chart"></i> View Analytics
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="admin-functionalities/lexicon-management.php">
                  <i class="bi bi-book"></i> Lexicon Management
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="../../controllers/admin/export-csv.php">
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
                        <a class="nav-link" href="../reset_password/change_password.php">
                        <i class="bi bi-person-gear"></i> Change Password
                        </a>
                     </li>
                     <li class="nav-item">
                        <form action="../../controllers/admin/admin-session.php" method="POST">
                           <button type="submit" class="nav-link" name="logout">
                              <i class="bi bi-box-arrow-right"></i> Sign Out
                           </button>
                        </form>
                     </li>
                  </ul>
               </div>
            </li>
         </ul>
      </div>
      </div>

      <!-- Main Content  -->
      <div class="main-content">
         <h1 class="mb-4">Welcome <?php echo $first_name; ?></h1>
               <!-- Account Table -->
         <h2>Users Summary</h2>
         <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped table-bordered align-middle text-center">
                     <thead class="table-dark">
                        <tr>
                           <th>User ID</th>
                           <th>First Name</th>
                           <th>Last Name</th>
                           <th>Email</th>
                           <th>Role</th>
                           <th>Last Login</th>
                           <!--<th>Actions</th>-->
                        </tr>
                     </thead>
                     <tbody id="accounts-table">
                        <!-- AJAX content goes here -->
                     </tbody>
                  </table>
               </div>
               <!-- Pagination Container -->
               <div class="d-flex justify-content-between align-items-center px-3 py-2">
                  <div id="pagination-container"></div>
               </div>
            </div>
         </div>
      </div>

      <!-- Statistics Table  -->

      <div class="main-content" style="height: 400px">
         <h2>Statistics Summary</h2>
         <canvas id="mostRatedProducts" height="100"></canvas>
      </div>
    <script src="../../../public/assets/js/admin/admin-homepage-chart.js"></script>
    <script src="../../../public/assets/js/admin/admin-homepage.js"></script>
   </body>
</html>
