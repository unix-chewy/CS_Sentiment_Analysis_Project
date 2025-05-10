<?php
include "../../config/login-config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST['searchQuery'];

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

?>