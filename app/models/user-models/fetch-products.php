<?php
include "../../config/login-config.php";

// Category filter
$categories = isset($_GET['categories']) ? $_GET['categories'] : '';
$searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';

$sql = "SELECT p.id, p.name, p.photo, p.price 
        FROM products p
        WHERE 1=1"; // This is to indicate the WHERE clause agad sa SQL query

// Add category filter if categories are selected
if ($categories !== '') {
    $category_ids = explode(',', $categories);
    $placeholders = str_repeat('?,', count($category_ids) - 1) . '?';
    $sql .= " AND p.category_id IN ($placeholders)";
}

// Add search filter if search query exists
if ($searchQuery !== '') {
    $sql .= " AND p.name LIKE ?";
}

$stmt = $conn->prepare($sql);

// Initiate bind parameter variables because there are two independent parameters categories and searchQuery.
$paramTypes = '';
$paramValues = array();

// Add category parameters
if ($categories !== '') {
    $paramTypes .= str_repeat('i', count($category_ids));
    $paramValues = array_merge($paramValues, $category_ids);
}

// Add search parameter
if ($searchQuery !== '') {
    $paramTypes .= 's';
    $searchPattern = "%$searchQuery%";
    $paramValues[] = $searchPattern;
}

// Bind all parameters if there are any
if (!empty($paramValues)) {
    $stmt->bind_param($paramTypes, ...$paramValues);
}

$stmt->execute();
$result = $stmt->get_result();

// Display products
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $link = $row["id"];
        $name = $row["name"];
        $photo = $row["photo"];  
        $price = $row["price"];

        // HTML structure
        echo "
        <div class='col-6 col-md-2'>
            <div class='card h-100 border border-secondary-subtle shadow-sm position-relative group overflow-hidden'>
                <a href='../../views/user/product-page.php?id=" . urlencode($link) . "' class='text-decoration-none text-dark d-flex flex-column h-100'>                    
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
    echo "<div class='col-12'>
            <div class='alert alert-danger' role='alert'>
                No products found
            </div>
        </div>";
}
$conn->close();
?>
