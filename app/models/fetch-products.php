<?php
include "../../config/login-config.php";
$sql = "SELECT id, name, photo, price FROM products";
$result = $conn->query($sql);

// Checking for products
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $link = $row["id"]; // next time ko na lang illink sa actual product.
        $name = $row["name"];
        $photo = $row["photo"];  
        $price = $row["price"];

        // HTML structure
        echo "
        <div class='col-6 col-md-2'>
            <div class='card h-100 border border-secondary-subtle shadow-sm position-relative group overflow-hidden'>
                <a href='../../views/user/product-page.php?id=" . $link . "' class='text-decoration-none text-dark d-flex flex-column h-100'>                    
                <!-- Image Container -->
                    <div class='position-relative' style='padding-top: 100%;'>
                        <img src='../../../public/assets/images/products/" . $photo . "' class='position-absolute top-0 start-0 w-100 h-100 object-fit-contain' alt='Product Image'>
                    </div>
                    <!-- Product Info -->
                    <div class='card-body d-flex flex-column justify-content-between p-2'>
                        <div class='mb-2 small text-truncate' style='height: 2.5rem; overflow: hidden;'>
                            $name
                        </div>
                        <div class='d-flex align-items-center justify-content-between'>
                            <div class='text-primary fw-bold price-text'>
                                ₱$price
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    ";
    }
} else {
    echo "No products found.";
}
$conn->close();
?>
