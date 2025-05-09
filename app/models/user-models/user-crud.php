<?php include "../../config/login-config.php";

// Below uses Inner Join to return rows that match both data entries (product reviews exists within a product). 
// Where statement to indicate that current user's reviews should only be displayed
$query = "SELECT
            product_review_comments.id,
            product_review_comments.user_id,
            product_review_comments.product_id,
            product_review_comments.prv_id,
            sentiments.id AS sen_id,
            product_review_comments.review_text,
            products.name,
            products.description,
            product_votes.votes
        FROM product_review_comments
        INNER JOIN products ON product_review_comments.product_id = products.id 
        LEFT JOIN product_votes ON product_votes.product_id = products.id AND product_votes.user_id = {$user_id}
        LEFT JOIN sentiments ON sentiments.product_id = products.id AND sentiments.user_id = {$user_id}
        WHERE product_review_comments.user_id = {$user_id}
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
                    <a class='nav-link d-inline-block' data-bs-toggle='modal' data-bs-target='#edit-review-modal'>
                        <button class='btn btn-secondary btn-edit' data-bs-dismiss= 'modal' id = 'btn-edit' data-prc-id='{$row['id']}' 
                        data-user-id='{$row['user_id']}' data-product-id='{$row['product_id']}' data-prv-id='{$row['prv_id']}' 
                        data-sen-id='{$row['sen_id']}' data-review='{$row['review_text']}' data-name='{$row['name']}' 
                        data-description='{$row['description']}' data-votes='{$row['votes']}'> Edit </button>
                    </a>
                    <button class='btn btn-primary' id='btn-delete' data-prc-id='{$row['id']}' data-prv-id='{$row['prv_id']}' 
                    data-sen-id='{$row['sen_id']}'>Delete</button>
                </td>
            </tr>";
    }

    echo $output;
?>