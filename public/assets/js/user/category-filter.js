$(document).ready(function() {
    // Load categories
    loadCategories();

    // Handle checkbox changes
    $('#category-filters').on('change', 'input[type="checkbox"]', function() {
        let categoryId = $(this).val();
        filterProducts(categoryId);
    });
});

// Load categories from database
function loadCategories() {
    $.ajax({
        url: '/CS_Sentiment_Analysis_Project/app/models/user-models/get-categories.php',
        method: 'GET',
        success: function(data) {
            $('#category-filters').html(data);
        },
        error: function() {
            $('#category-filters').html('<p class="text-danger">Failed to load categories.</p>');
        }
    });
}

// Filter products by category
function filterProducts(categoryId) {
    $.ajax({
        url: '/CS_Sentiment_Analysis_Project/app/models/user-models/fetch-products.php',
        method: 'GET',
        data: { categories: categoryId },
        success: function(data) {
            $('#products-container').html(data);
        },
        error: function() {
            $('#products-container').html('<p class="text-danger">Failed to load products.</p>');
        }
    });
}
