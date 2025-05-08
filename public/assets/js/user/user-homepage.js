$(function () {
    const $filters = $('#category-filters');

    const fetchCategories = () => {
        $.ajax({
            url: '/CS_Sentiment_Analysis_Project/app/models/user-models/get-categories.php',
            method: 'GET',
            success: data => $filters.html(data),
            error: () => $filters.html('<p class="text-danger">Failed to load categories.</p>')
        });
    };

    fetchCategories();
    $filters.on('change', '.category-checkbox', fetchProducts);
});