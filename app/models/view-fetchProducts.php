<?php include "../config/login-config.php";

// This is a model page for fetching products to be put into display within the view item modal
// Reused code just modified 

    $query = "SELECT
                products.id,
                products.name,
                products.photo,
                products.description,
                products.price,
                categories.product_category
            FROM products
            LEFT JOIN categories ON categories.id = products.category_id
            ORDER BY products.id ASC;";
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