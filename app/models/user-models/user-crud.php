<?php
// Fetch products and their ratings from the database
include "../../config/login-config.php";


// Below uses Inner Join to return rows that match both data entries (product reviews exists within a product). 
$query = "SELECT
            products.id,
            products.name,
            product_review_comments.review_text,
            product_votes.votes
        FROM product_review_comments
        INNER JOIN products ON product_review_comments.product_id = products.id 
        LEFT JOIN product_votes ON product_votes.product_id = products.id
        ORDER BY products.name ASC;";
    $result = $conn->query($query);
    $output = "";

    while ($row = $result->fetch_assoc()) {
        $output .= "
            <tr>
                <td>{$row['name']}</td>
                <td>{$row['review_text']}</td>
                <td>{$row['votes']}</td>
                 <td>
                    <button class='btn btn-secondary' data-bs-dismiss= 'modal' id = 'btn-edit' data-id='{$row['id']}' data-name='{$row['name']}' 
                    data-review='{$row['review_text']}' data-votes='{$row['votes']}'> Edit </button>
                    <button class='btn btn-primary' id='btn-delete' data-id='{$row['id']}'>Delete</button>
                </td>
            </tr>";
    }

    echo $output;
?>
