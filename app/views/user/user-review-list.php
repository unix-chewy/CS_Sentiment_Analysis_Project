<?php  include '../../config/login-config.php';

session_start();

// To get current user login ID
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
      <link rel="stylesheet" href="../../../public/assets/css/user-review-list.css">
      <title>User Homepage </title>
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
                  <li class="nav-item">
                     <a href="../login.php" class="nav-link">
                     <i class="bi bi-box-arrow-right"></i> Logout
                     </a>
                  </li>
               </ul>
            </nav>
            <!-- Logo + Search -->
            <div class="d-flex align-items-center justify-content-between mt-3">
               <a href = "user_homepage.php">
                  <div class="logo">
                  </div>
               </a>
               <form class="d-flex flex-grow-1 mx-3">
                  <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
                  <button class="btn btn-outline-primary" type="submit">
                  <i class="bi bi-search"></i>
                  </button>
               </form>
               <div class="ratings-wrapper">
                  <div class="star-icon-container">
                     <a href = "user-review-list.php">
                     <i class="bi bi-star"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </header>
      <!-- Main Content  -->
      <div class="main-content">
         <h1 class="mb-4">Ratings</h1>
         <form class="d-flex flex-grow-1 mx-3">
            <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">
            <i class="bi bi-search"></i>
            </button>
         </form>
         <!-- Form for editing and deleting products -->
         <form id ="viewItem-Form">
            <div class="main-content">
               <div class="review-wrapper">
                  <div class="admin-profile">
                     <table class = "table">
                        <thead class = "table-dark">
                           <tr>
                              <th>Product Name</th>
                              <th>Review</th>
                              <th>Ratings</th>
                              <th>ACCESS</th>
                           </tr>
                        </thead>
                        <tbody id="viewItem-Table">
                           <!-- Table list will be loaded here via AJAX -->
                           <?php include '../../models/user-models/user-crud.php'; ?>
                        </tbody>
                     </table>
                  </div>
                  <!--<div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
                     <button type="submit" class="btn btn-primary">Delete</button>
                     </div> -->
               </div>
            </div>
         </form>
      </div>
   </body>
</html>
