<?php include '../../controllers/user/user-session.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../../public/assets/css/user/user-homepage.css">
    <title>User Homepage </title>
  </head>
  <body>
    <header class="sticky-top bg-white shadow-sm">
      <div class="container-fluid py-2">
        <nav class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center gap-3">
            <a class="nav-link p-0" href="#">Seller Centre</a>
            <a class="nav-link p-0" href="user_homepage.php">Start Rating</a>
            <a class="nav-link p-0" href="https://shopee.ph/web">Download</a>
            <span class="text-muted small">Follow us on</span>
            <div class="d-flex gap-2">
              <a href="https://www.facebook.com/ShopeePH" class="text-decoration-none">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="https://www.instagram.com/Shopee_PH/" class="text-decoration-none">
                <i class="bi bi-instagram"></i>
              </a>
            </div>
          </div>
          <ul class="nav">
            <li class="nav-item">
              <a href="https://help.shopee.ph/portal/4/ph/s" class="nav-link">
                <i class="bi bi-question-circle"></i> Help </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="bi bi-globe2"></i> English </a>
            </li>
            <li class="nav-item">
              <a href="../login.php" class="nav-link">
                <i class="bi bi-box-arrow-right"></i> Logout </a>
            </li>
          </ul>
        </nav>
        <div class="d-flex align-items-center justify-content-between mt-3">
          <a href="user_homepage.php">
            <div class="logo"></div>
          </a>
          <form class="d-flex flex-grow-1 mx-3">
            <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </form>
          <div class="ratings-wrapper">
            <div class="star-icon-container">
              <a href="user-review-list.php">
                <i class="bi bi-star"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">
        <h4>
          <i class="bi bi-list-ul"></i> Search Filter
        </h4>
      </div>
      <div class="sidebar-menu">
        <div class="px-3 py-2">
          <h5>Categories</h5>
          <div id="category-filters" class="form-check">
            <!-- Categories will be loaded here via AJAX -->
            <div class="text-center my-3">
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Main Content Wrapper -->
<div class="main-content">
  <div class="container mt-4">
    <div class="daily-discover-tab text-center py-2 mb-3">
      <span>DAILY DISCOVER</span>
    </div>
    <div class="row g-4" id="products-container"> 
       <?php 
          require_once '../../models/user-models/fetch-products.php'; 
       ?> 
    </div>
  </div>
</div>

    <script src="../../../public/assets/js/user/user-homepage.js"></script>
    <script src="../../../public/assets/js/user/category-filter.js"></script>
  </body>
</html>