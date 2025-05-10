$(document).ready(function() {
    const $filters = $('#category-filters');
    var currentSearchQuery = '';

    // Load categories
    function loadCategories() {
        $.ajax({
            url: '/CS_Sentiment_Analysis_Project/app/models/user-models/get-categories.php',
            method: 'GET',
            success: function(data) {
                $filters.html(data);
            },
            error: function() {
                $filters.html('<p class="text-danger">Failed to load categories.</p>');
            }
        });
    }

    // Filter products by category
    function filterProducts(selectedCategories) {
        $.ajax({
            url: '/CS_Sentiment_Analysis_Project/app/models/user-models/fetch-products.php',
            method: 'GET',
            data: { 
                categories: selectedCategories.join(','), 
                searchQuery: currentSearchQuery
            },
            success: function(data) {
                $('#products-container').html(data);
            },
            error: function() {
                $('#products-container').html('<p class="text-danger">Failed to load products.</p>');
            }
        });
    }

    // Initial load of categories
    loadCategories();

    // Handle checkbox changes
    $filters.on('change', 'input[type="checkbox"]', function() {
        let selectedCategories = [];
        // Get all checked checkboxes
        $('#category-filters input[type="checkbox"]:checked').each(function() {
            selectedCategories.push($(this).val());
        });
        filterProducts(selectedCategories);
    });

    // Search Product
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        currentSearchQuery = $('#search-product').val();
        $.post('/CS_Sentiment_Analysis_Project/app/controllers/admin/search-product.php', 
            { searchProductUser: currentSearchQuery }, 
            function(displayData) {
                $('#products-container').empty();
                $('#products-container').html(displayData);
            }
        );
    });
});