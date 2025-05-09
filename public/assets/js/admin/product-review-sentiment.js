$(document).ready(function() {
    function loadProductReviewSentiments() {
        $.ajax({
            url: '/CS_Sentiment_Analysis_Project/app/controllers/admin/get-product-reviews-sentiment.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var rows = [];
                if (response.reviews && response.reviews.length) {
                    for (var i = 0; i < response.reviews.length; i++) {
                        var review = response.reviews[i];
                        var row = '<tr>' +
                            '<td>' + review.username + '</td>' +
                            '<td>' + review.product_name + '</td>' +
                            '<td>' + review.review_text + '</td>' +
                            '<td>' + review.sentiment_label + '</td>' +
                            '<td>' + review.sentiment_score + '</td>' +
                            '</tr>';
                        rows.push(row); // push function to add rows (function of javascript)
                    }
                    $('#reviews-table').html(rows.join('')); // join function to join the rows (function of javascript) 
                } else {
                    $('#reviews-table').html('<tr><td colspan="5">No reviews found or error occurred.</td></tr>');
                }
            },
            error: function() {
                $('#reviews-table').html('<tr><td colspan="5">Failed to fetch data.</td></tr>');
            }
        });
    }
    loadProductReviewSentiments();
});