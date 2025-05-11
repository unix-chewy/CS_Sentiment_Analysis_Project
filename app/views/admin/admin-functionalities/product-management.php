<?php  include '../../../config/login-config.php';
       include '../../../controllers/admin/admin-session.php';
       
   // Get admin's first name from database
   $admin_id = $_SESSION['user_id'];
   $sql = "SELECT first_name FROM users WHERE id = $admin_id";
   $result = $conn->query($sql);
   $row = $result->fetch_assoc();
   $first_name = $row['first_name'];

   // Get categories
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
      <link rel="stylesheet" href="../../../../public/assets/css/admin/admin-functionalities/view-item.css">
      <title>Admin Homepage </title>
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
            <!-- insert php logic here for admin name -->
         </div>
         <div class="sidebar-menu">
            <ul class="nav flex-column">
               <li class="nav-item">
                  <a class="nav-link" href="../admin_homepage.php">
                  <i class="bi bi-house"></i> Home
                  </a>
               </li>
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
         <h1 class="mb-4">Products</h1>

         <!-- Search Bar -->
         <div class="row justify-content-center my-4">
            <div class="col-md-8 col-lg-6">
               <form class="d-flex flex-grow-1 mx-3" method="post" id="search-form">
                  <input class="form-control" type="search" placeholder="Search Products..." aria-label="Search" id="search-product" name="search-product">
                  <button class="btn btn-outline-primary ms-2" type="submit" id="search-button" name="search-button">
                  <i class="bi bi-search"></i>
                  </button>
               </form>
            </div>
         </div>
         
         <!-- Table -->
         <div class="row justify-content-center">
            <div class="col-lg-10">
               <div class="card shadow-sm">
                  <div class="card-body table-responsive">
                     <table class="table table-striped table-bordered align-middle text-center">
                        <thead class="table-dark">
                           <tr>
                              <th>ID</th>
                              <th>Product Name</th>
                              <th>Image</th>
                              <th>Description</th>
                              <th>Price</th>
                              <th>Category</th>
                              <th>ACCESS</th>
                           </tr>
                        </thead>
                        <tbody id="viewItem-Table">
                           <!-- AJAX content goes here -->
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a class='nav-link' data-bs-toggle='modal' data-bs-target='#add-item-modal'>
            <button type="submit" class="btn btn-primary">Add Item</button>
            </a>
         </div>
      </div>
      
      <!-- The Modals -->

      <!-- Add Item -->
      <div class="modal fade" id="add-item-modal" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <form id="add-item-form" method="post" enctype="multipart/form-data">
                  <!-- Connect PHP here -->
                  <div class="modal-header">
                     <h5 class="modal-title" id="add-item-modal-label">Add New Item</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="mb-3">
                        <label for="item-name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="item-name" name="item-name" placeholder="Enter item name" required>
                     </div>
                     <div class="mb-3">
                        <label for="item-description" class="form-label">Description</label>
                        <textarea class="form-control" id="item-description" name="item-description" rows="3"></textarea>
                     </div>
                     <div class="mb-3">
                        <label for="item-image" class="form-label">Item Image</label>
                        <input class="form-control" type="file" id="item-image" name="item-image" accept="image/*">
                     </div>
                     <div class="mb-3">
                        <label for="item-price" class="form-label">Item Price</label>
                        <input class="form-control" type="number" id="item-price" name="item-price" required>
                     </div>
                     <div class="mb-3">
                        <label for="item-category" class="form-label">Item Category</label>
                        <select class="form-select" id="item-category" name="item-category">
                           <?php foreach ($result_category as $row): ?>
                           <option value="<?php echo ($row['id']) ?>">
                              <?php echo ($row['product_category']) ?>
                           </option>
                           <?php endforeach; ?>
                           <option value="-1">Enter New Category</option>
                        </select>
                     </div>
                     <div class="mb-3" id="new-cat-div" style="display:none;">
                        <label for="new-category" class="form-label">New Category</label>
                        <input type="text" class="form-control" id="new-category" name="new-category" placeholder="Other Category">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary">Add Item</button>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <!-- Edit Item -->
      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal-label" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <form id = "edit-item-Form" action="#" method="post" enctype="multipart/form-data">
                  <!-- Connect PHP here -->
                  <input type="hidden" id="product-id" name="id">  <!-- hidden id to get the current row product -->
                  <div class="modal-header">
                     <h5 class="modal-title" id="add-item-modal-label">Edit Product</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="mb-3">
                        <label for="item-name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="item-name" name="item-name" placeholder="Enter item name" required>
                     </div>
                     <div class="mb-3">
                        <label for="item-description" class="form-label">Description</label>
                        <textarea class="form-control" id="item-description" name="item-description" rows="3"></textarea>
                     </div>
                     <div class="mb-3">
                        <label for="item-image" class="form-label">Item Image</label>
                        <input class="form-control" type="file" id="item-image" name="item-image" accept="image/*">
                        <input type="hidden" id="old-image" name="old-image"> <!-- hidden image to get the old image in editing 
                           (in any case the person doesnt wnna edit the product's image) -->
                     </div>
                     <div class="mb-3">
                        <label for="item-price" class="form-label">Item Price</label>
                        <input class="form-control" type="number" id="item-price" name="item-price" required>
                     </div>
                     <div class="mb-3">
                        <label for="item-category" class="form-label">Item Category</label>
                        <select class="form-select" id="item-category" name="item-category">
                           <!-- inline php for populating list -->
                           <?php foreach ($result_category as $row): ?>
                           <option value="<?php echo ($row['id']) ?>">
                              <?php echo ($row['product_category']) ?>
                           </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary">Edit Item</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <script src="../../../../public/assets/js/admin/item-crud.js"> </script>
   </body>
</html>