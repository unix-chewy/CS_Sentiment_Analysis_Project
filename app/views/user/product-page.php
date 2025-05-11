<?php include '../../controllers/user/user-session.php'; ?>
<?php include '../../models/user-models/user-review.php'; ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" href="../../../public/assets/css/user/product-page.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
      <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      
      <title>User Homepage </title>
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
              <a href="../login.php" class="nav-link">
                <i class="bi bi-box-arrow-right"></i> Logout </a>
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
      <div class="container my-5">
         <div class="row g-4">
            <?php include '../../models/user-models/product-controller.php'; ?>
         </div>
         
      <!-- Product Reviews -->
         <div class="product-reviews">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
        <h4>Product Ratings</h4>
    </div>
    <div class="ratings-summary-card mb-4">
        <div class="d-flex flex-column flex-md-row align-items-center gap-4 p-4">
            <div class="d-flex align-items-center gap-2">
            <span class="avg-rating-value"><?php echo $average_rating; ?></span>                <i class="bi bi-star-fill single-star"></i>
                <span class="avg-rating-text">out of 5</span>
            </div>
            <div class="vr d-none d-md-block" style="height: 40px;"></div>
            <div class="d-flex align-items-center gap-2">
                <span class="sentiment-label">Overall Sentiment Score:</span>
                <span class="sentiment-score">
                     <?php echo round($average_sentiment_score, 2); ?>
                  </span>
            </div>
        </div>
    </div>
    
    <?php if (!empty($reviews)): ?>
        <div class="review-list">
        <?php foreach ($reviews as $review): ?>
            <div class="review-card mb-3 p-3">
                <div class="review-header d-flex align-items-center mb-1">
                    <span class="review-username fw-semibold me-2"><?php echo ($review['username']); ?></span>
                    <span class="review-stars">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="bi bi-star<?php echo $i < $review['rating'] ? '-fill' : ''; ?>"></i>
                        <?php endfor; ?>
                    </span>
                </div>
                <div class="review-body">
                    <p class="mb-0"><?php echo ($review['review']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-reviews text-center py-4">
            <i class="bi bi-x" style="font-size: 3rem; color: #ccc;"></i>
            <p class="mt-2 mb-0">No reviews yet. Be the first to review!</p>
        </div>
    <?php endif; ?>
</div>

         <!-- The Modals -->
         <!-- Rate Item -->
         <div class="modal fade" id="rate-item-modal" tabindex="-1" aria-labelledby="rate-item-modal-label" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="wrapper">
                     <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                     <p>Description: <?php echo htmlspecialchars($product['description']); ?></p>
                     <p>Price: <?php echo htmlspecialchars($product['price']); ?></p>
                     <form action= "../../controllers/product-getreview.php" method = "POST" id = "ReviewForm" >
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
                        <div class="rating">
                           <input type="number" name="rating" hidden>
                           <i class='bx bx-star star' style="--i: 0;"></i>
                           <i class='bx bx-star star' style="--i: 1;"></i>
                           <i class='bx bx-star star' style="--i: 2;"></i>
                           <i class='bx bx-star star' style="--i: 3;"></i>
                           <i class='bx bx-star star' style="--i: 4;"></i>
                        </div>
                        <textarea name="review" cols="30" rows="5" placeholder="Your opinion..."></textarea>
                        <div class="btn-group">
                           <button type="submit" class="btn submit" name="add-review">Submit</button>
                           <button type="button" class="btn cancel" data-bs-dismiss="modal">Cancel</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <script src="../../../public/assets/js/user/review-crud.js"> </script>
      <script src="../../../public/assets/js/user/product-review-star.js"> </script>
   </body>
</html>