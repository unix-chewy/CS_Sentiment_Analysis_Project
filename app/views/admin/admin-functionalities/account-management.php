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
               <!-- Home -->
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

      <!-- Account Table -->
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

      <!-- Buttons for add -->
      <div class="text-center my-4">
         <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User/Admin</button>
      </div>

      <!-- The Modals -->

      <!-- Add User Modal -->
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

      <!-- Edit User Modal -->
      <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="editUserForm">
                <input type="hidden" id="editUserId" name="user_id">
                <div class="mb-3">
                  <label for="editFirstName" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="editFirstName" name="first_name" required>
                </div>
                <div class="mb-3">
                  <label for="editLastName" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="editLastName" name="last_name" required>
                </div>
                <div class="mb-3">
                  <label for="editEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" id="editEmail" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="editRole" class="form-label">Role</label>
                  <select class="form-select" id="editRole" name="role_id" required>
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="saveUserChanges">Save changes</button>
            </div>
          </div>
        </div>
      </div>

<script src="../../../../public/assets/js/login-register.js"></script>
<script src="../../../../public/assets/js/admin/account-management.js"></script>
   </body>
</html>