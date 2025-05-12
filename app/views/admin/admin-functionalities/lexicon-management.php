<?php  include '../../../config/login-config.php';
include '../../../controllers/admin/admin-session.php';
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
      <link rel="stylesheet" href="../../../../public/assets/css/admin/admin-functionalities/account-management.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
      <title>Lexicon File Management</title>
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
                  <a class="nav-link" href="../admin_homepage.php">
                  <i class="bi bi-house"></i> Home
                  </a>
               </li>
               <!-- Product Management -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="product-management.php">
                  <i class="bi bi-box-seam"></i> Product Management </i>
                  </a>
               </li>

               <!-- Account Management -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="account-management.php">
                  <i class="bi bi-person-gear"></i> Account Management 
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="view-analytics.php">
                  <i class="bi bi-bar-chart"></i> View Analytics
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="lexicon-management.php">
                  <i class="bi bi-book"></i> Lexicon Management
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="../../../controllers/admin/export-csv.php">
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
                        <a class="nav-link" href="../../reset_password/change_password.php">
                        <i class="bi bi-person-gear"></i> Change Password
                        </a>
                     </li>
                     <li class="nav-item">
                        <form action="../../../controllers/admin/admin-session.php" method="POST">
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
         <h1 class="mb-4">Lexicon Management</h1>

         <!-- Add Word Form -->
         <div class="card mb-4">
            <div class="card-header">
               <h4>Add New Word</h4>
            </div>
            <div class="card-body">
               <form action="../../../../app/controllers/admin/add-lexicon-word.php" method="POST">
                  <div class="row">
                     <div class="col-md-6 mb-3">
                        <label for="word" class="form-label">Word</label>
                        <input type="text" class="form-control" id="word" name="word" required>
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Word Type</label>
                        <select class="form-select" id="type" name="type" required>
                           <option value="positive">Positive</option>
                           <option value="negative">Negative</option>
                        </select>
                     </div>
                  </div>
                  <div class="d-flex gap-2">
                     <button type="submit" class="btn btn-primary" name="action" value="add">Add Word</button>
                     <button type="submit" class="btn btn-danger" name="action" value="delete">Delete Word</button>
                  </div>
               </form>
            </div>
         </div>
      <script src="../../../../public/assets/js/admin/lexicon-management.js"></script>
   </body>
</html> 