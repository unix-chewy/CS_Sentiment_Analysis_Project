<?php
include "../../config/login-config.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $sql = "SELECT id, name, photo, price, description FROM products WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $photo = $row["photo"];
        $price = $row["price"];
        $description = $row["description"];

        // Calculate average sentiment score for this product
        $average_sentiment_score = 0;
        $stmt = $conn->prepare("SELECT SUM(sentiment_score) as total_score, COUNT(*) as review_count FROM sentiments WHERE product_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($total_sentiment_score, $review_count);
        $stmt->fetch();
        $stmt->close();

        // Calcuation for sentiment score
        if ($review_count > 0) {
            $average_sentiment_score = $total_sentiment_score / $review_count;
        }   

        // Calculation for average rating
        $average_rating = 0;
        $sql = "SELECT AVG(votes) as avg_rating FROM product_votes WHERE product_id = $id";
        $result = $conn->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
            $average_rating = $row['avg_rating'] !== null ? round($row['avg_rating'], 1) : 0;
        }

        echo "
        <div class='container my-5'>
            <div class='row'>
                <!-- Product Image -->
                <div class='col-md-6'>
                    <img src='../../../public/assets/images/products/$photo' class='img-fluid' alt='$name'>
                </div>
        
                <!-- Product Details -->
                <div class='col-md-6'>
                    <h1>$name</h1>
                    <div class='price-container'>
                        <h3 class='price'>₱" . number_format($price, 2) . "</h3>
                    </div>                    
                    <div class='mt-4'>
                        <p>" . $description . "</p>";
        echo "
                    </div>
                    <button class='btn btn-primary mt-3'
                    id='rate-btn'
                    data-product-id='$id'>
                    Rate Now!
                    </button>
                </div>
            </div>
        </div>";

    } else {
        echo "Product not found.";
    }

    $conn->close();
} else {
    echo "No product ID specified.";
}

//number_format($price, 2) -> convert to two decimal
//$id = intval($_GET['id']); -> to get product id, dun sa fetch-product.php may ?id=, 
//                              basically strinip niya lang yung ?id= and kinuha yung value 

?>

