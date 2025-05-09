$(document).ready(function() {
    // Load categories
    loadCategories();

    // Handle checkbox changes
    $('#category-filters').on('change', 'input[type="checkbox"]', function() {
        let selectedCategories = [];
        // Get all checked checkboxes
        $('#category-filters input[type="checkbox"]:checked').each(function() {
            selectedCategories.push($(this).val());
        });
        filterProducts(selectedCategories);
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
function filterProducts(selectedCategories) {
    $.ajax({
        url: '/CS_Sentiment_Analysis_Project/app/models/user-models/fetch-products.php',
        method: 'GET',
        data: { categories: selectedCategories.join(',') },
        success: function(data) {
            $('#products-container').html(data);
        },
        error: function() {
            $('#products-container').html('<p class="text-danger">Failed to load products.</p>');
        }
    });
}
