<?php  include '../../config/login-config.php';

session_start();

// To get current user login ID
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// To get the product ID ***** THIS IS TO BE REPLACED ONCE THERE IS FRONT END FOR DIFFERENT PRODUCTS. 
// DIFFERENT PAGES WILL GET DIFFERENT PRODUCT IDS. PROCESS BELOW MAY CHANGE!!!
$sql_product = "SELECT * FROM products ORDER by id";
$stmt_product = $conn->prepare($sql_product);
$stmt_product->execute();
$result_product = $stmt_product->get_result();
$product = $result_product->fetch_assoc();
$product_id = $product['id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../../public/assets/css/review(test).css">
	<title>Form Reviews</title>
</head>
<body>

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
				<button type="submit" class="btn submit">Submit</button>
				<button class="btn cancel">Cancel</button>
			</div>
		</form>
	</div>
  
    <script src="../../../public/assets/js/review(test).js"> </script>

</body>
</html>