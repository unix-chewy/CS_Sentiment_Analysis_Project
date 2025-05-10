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
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <title>View Analytics</title>
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
            <h4><?php echo $first_name; ?></h4>
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
         <h1 class="mb-4">Analytics Dashboard</h1>   

         <!-- Sentiment Filters -->
         <div class="row mb-4">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h4>Filter by Sentiment</h4>
                  </div>
                  <div class="card-body">
                     <div id="sentiment-filters" class="d-flex gap-3">
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" value="positive" id="positive-filter" checked>
                           <label class="form-check-label" for="positive-filter">
                              Positive
                           </label>
                        </div>
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" value="negative" id="negative-filter" checked>
                           <label class="form-check-label" for="negative-filter">
                              Negative
                           </label>
                        </div>
                        <div class="form-check">
                           <input class="form-check-input" type="checkbox" value="neutral" id="neutral-filter" checked>
                           <label class="form-check-label" for="neutral-filter">
                              Neutral
                           </label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <!-- Reviews Table -->
         <div class="row mb-4">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h4>Product Sentiment Analysis</h4>
                  </div>
                  <br>
                     <form class="d-flex flex-grow-1 search-form">
                        <input class="form-control" type="search" placeholder="Search a Product..." aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">
                        <i class="bi bi-search"></i>
                        </button>
                        <button type="button" class="btn btn-secondary ms-2" id="reset-table">Reset</button>
                     </form>
                  <div class="card-body">
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-bordered align-middle text-center">
                         <thead class="table-dark">
                              <tr>
                                 <th>User</th>
                                 <th>Product</th>
                                 <th>Review</th>
                                 <th>Sentiment</th>
                                 <th>Score</th>
                              </tr>
                           </thead>
                           <tbody id="reviews-table">
                            <!-- AJAX content goes here -->
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>

<!-- Charts Section -->
<div class="row">
    <!-- Sentiment Distribution Pie Chart -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sentiment Distribution</h5>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="sentimentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Sentiment Trend Chart -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sentiment Trends Report</h5>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Distribution Chart -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Category Distribution</h5>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Count Chart -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Review Count by Product</h5>
                <div class="chart-container" style="height: 300px;">
                    <canvas id="reviewChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

         <script src="../../../../public/assets/js/admin/sentiment-filter.js"></script>
         <script src="../../../../public/assets/js/admin/sentiment-charts.js"></script>
      </body>
</html> 