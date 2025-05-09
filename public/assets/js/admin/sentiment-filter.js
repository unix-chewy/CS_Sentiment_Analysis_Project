$(document).ready(function() {
    // Reused code from category-filter.js
    // basically load all reviews on page
    loadReviews();
    
    // Reused code from category-filter.js
    $('#sentiment-filters').on('change', 'input[type="checkbox"]', function() {
        let selectedSentiments = [];
        // Get all checked checkboxes
        $('#sentiment-filters input[type="checkbox"]:checked').each(function() {
            selectedSentiments.push($(this).val());
        });
        loadReviews(selectedSentiments);
    });
});

// Load reviews with optional sentiment filter
function loadReviews(selectedSentiments = []) {
    $.ajax({
        url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/fetch-filtered-reviews.php',
        method: 'GET',
        data: { sentiments: selectedSentiments.join(',') },
        success: function(data) {
            $('#reviews-table').html(data);
        },
        error: function() {
            $('#reviews-table').html('<tr><td colspan="5" class="text-danger">Failed to load reviews.</td></tr>');
        }
    });
} 