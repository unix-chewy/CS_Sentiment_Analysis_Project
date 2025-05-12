<?php include '../../controllers/user/user-session.php'; ?>
<?php  include '../../config/login-config.php'; 

// To get current user login ID
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- CSS Link -->
    <link rel="stylesheet" href="../../../public/assets/css/user/user-review-list.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <title>User Homepage</title>
</head>

   <body>
      
   <!-- Header -->
    <header class="sticky-top bg-white shadow-sm">
      <div class="container-fluid py-2">
        <!-- Header First Part -->
        <nav class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center gap-3">
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
               <a href="../reset_password/change_password.php" class="nav-link">
               <i class="bi bi-key"></i> Change Password
               </a>
            </li>
            <li class="nav-item">
               <form action="../../controllers/user/user-session.php" method="POST">
                <button type="submit" class="nav-link" name="logout">
                  <i class="bi bi-box-arrow-right"></i> Logout 
                </button>
               </form>
            </li>
          </ul>
        </nav>
        <!-- Header Second Part -->
        <div class="d-flex align-items-center justify-content-between mt-3">
          <a href="user_homepage.php">
            <div class="logo"></div>
          </a>
          <form class="d-flex flex-grow-1 mx-3" method="get" id="search-product-form">
            <input class="form-control" type="search" placeholder="Search..." aria-label="Search" id="search-product" name="search-product">
            <button class="btn btn-outline-primary" type="submit" id="search-product-button" name="search-product-button">
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
    
      <!-- Main Content  -->
      <div class="main-content">
         <h1 class="mb-4">Ratings</h1>
         <div class="row justify-content-center my-4">
         <form class="d-flex flex-grow-1 mx-3" method = "get" id = "search-review-form">
            <input class="form-control" type="search" placeholder="Search by product name..." aria-label="Search" id="search-review" name="search-review">
            <button class="btn btn-outline-primary" type="submit" id="search-review-button" name="search-review-button">
            <i class="bi bi-search"></i>
            </button>
         </form>
         </div>
         <!-- Form for editing and deleting products -->
            <div class="main-content">
               <div class="review-wrapper">
                  <div class="review-profile">
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
                  
                  <!-- MODAL -->
                  <div class="modal fade" id="edit-review-modal" tabindex="-1" aria-labelledby="edit-review-modal-label" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="wrapper">
                              <h3 id="item-name"></h3>
                              <p>Description: <i id="item-description"></i> </p>
                              <form action= "../../controllers/product-getreview.php" method = "POST" id = "updateReviewForm" >
                                 <input name="prc_id" id="prc-id" hidden>
                                 <input name="user_id" id="user-id" hidden>
                                 <input name="product_id" id="product-id" hidden>
                                 <input name="prv_id" id="prv-id" hidden>
                                 <div class="rating">
                                    <input type="number" name="rating" hidden>
                                    <i class='bx bx-star star' style="--i: 0;"></i>
                                    <i class='bx bx-star star' style="--i: 1;"></i>
                                    <i class='bx bx-star star' style="--i: 2;"></i>
                                    <i class='bx bx-star star' style="--i: 3;"></i>
                                    <i class='bx bx-star star' style="--i: 4;"></i>
                                 </div>
                                 <textarea id="review-text" name="review" cols="30" rows="5" placeholder="Your opinion..."></textarea>
                                 <div class="btn-group">
                                    <button type="submit" class="btn submit" name="update-review">Submit</button>
                                    <button type="button" class="btn cancel" data-bs-dismiss="modal">Cancel</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
      </div>
      <script src = "../../../public/assets/js/user/review-crud.js"> </script>
      <script src = "../../../public/assets/js/user/product-review-star.js"> </script>
   </body>
</html>