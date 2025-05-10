<?php
include "../../config/login-config.php";

if (isset($_POST['searchProductAdmin'])) {
    $search_query = $_POST['searchProductAdmin'];

    $sql = "SELECT 
                products.id,
                products.name,
                products.photo,
                products.description,
                products.price,
                categories.product_category
            FROM products
            LEFT JOIN categories ON categories.id = products.category_id
            WHERE products.name LIKE '%$search_query%'
            ORDER BY products.id ASC;";
    $result = $conn->query($sql);
    $output = "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['photo']}</td>
                <td>{$row['description']}</td>
                <td>{$row['price']}</td>
                <td>{$row['product_category']}</td>
                <td>
                    <button class='btn btn-secondary btn-edit' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['id']}' data-name='{$row['name']}' data-photo='{$row['photo']}' 
                    data-description='{$row['description']}' data-price='{$row['price']}' data-category='{$row['product_category']}'> Edit </button>
                    <button class='btn btn-primary' id='btn-delete' data-id='{$row['id']}'>Delete</button>
                </td>
            </tr>";
        }
        echo $output;
    } else {
        echo "<tr><td colspan='7'>No products found</td></tr>";
    }
}

if (isset($_POST['searchProductUser'])) {
    $search_query = $_POST['searchProductUser'];

    $sql = "SELECT p.id, p.name, p.photo, p.price 
        FROM products p
        WHERE p.name LIKE '%$search_query%'
        ORDER BY p.id ASC;";
    $result = $conn->query($sql);
    $output = "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $link = $row["id"];
            $name = $row["name"];
            $photo = $row["photo"];  
            $price = $row["price"];
            
            $output .= "
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
            </div>";
        }
        echo $output;
    } else {
        echo "<div class='col-12'>
                <div class='alert alert-danger' role='alert'>
                    No products found
                </div>
            </div>";
    }
}

// Close the connection
$conn->close();
?>