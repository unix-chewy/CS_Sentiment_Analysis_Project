<?php
// Fetch products and their ratings from the database
include "../../config/login-config.php";

    $query = "SELECT
                products.id,
                products.name,
            FROM products
            LEFT JOIN product_votes ON products.id = products.id
            ORDER BY products.name ASC;";
    $result = $conn->query($query);
    $output = "";

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
                    <button class='btn btn-secondary' data-bs-dismiss= 'modal' id = 'btn-edit' data-id='{$row['id']}' data-name='{$row['name']}' data-photo='{$row['photo']}' 
                    data-description='{$row['description']}' data-price='{$row['price']}' data-name='{$row['product_category']}'> Edit </button>
                    <button class='btn btn-primary' id='btn-delete' data-id='{$row['id']}'>Delete</button>
                </td>
            </tr>";
    }

    echo $output;
?>
