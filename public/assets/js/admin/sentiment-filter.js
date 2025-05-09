$(document).ready(function() {
    // Reused code from category-filter.js
    // basically load all reviews on page
    loadReviews();
    
    // Store current product reviews
    let currentProductReviews = [];
    
    // Reused code from category-filter.js
    $('#sentiment-filters').on('change', 'input[type="checkbox"]', function() {
        let selectedSentiments = [];
        // Get all checked checkboxes
        $('#sentiment-filters input[type="checkbox"]:checked').each(function() {
            selectedSentiments.push($(this).val());
        });
        // Filter the current product reviews by sentiment
        filterBySentiment(selectedSentiments);
    });

    // Search box code
    $('.search-form').on('submit', function(e) {
        e.preventDefault(); // Stop form from refreshing page
        let searchText = $(this).find('input[type="search"]').val();
        searchText = searchText.toLowerCase(); // Make search not case sensitive
        
        // Get all reviews for the searched product
        $.ajax({
            url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/fetch-filtered-reviews.php',
            method: 'GET',
            data: { product: searchText },
            success: function(data) {
                $('#reviews-table').html(data);
                // Store current product reviews
                currentProductReviews = $('#reviews-table tr').toArray();
                // Apply current sentiment filters
                let selectedSentiments = [];
                $('#sentiment-filters input[type="checkbox"]:checked').each(function() {
                    selectedSentiments.push($(this).val());
                });
                filterBySentiment(selectedSentiments);
            },
        });
    });
    
    // Reset button click
    $('#reset-table').on('click', function() {
        // Clear search
        $('.search-form input[type="search"]').val('');
        // Reset checkboxes
        $('#sentiment-filters input[type="checkbox"]').prop('checked', true);
        // Load all reviews
        loadReviews();
    });
});

// Function to filter by sentiment
function filterBySentiment(selectedSentiments) {
    // Look at each row in table
    $('#reviews-table tr').each(function() {
        let sentimentCell = $(this).find('td:nth-child(4)');
        let sentiment = sentimentCell.text().toLowerCase();
        
        // Show row if sentiment is selected
        if (selectedSentiments.includes(sentiment)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

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