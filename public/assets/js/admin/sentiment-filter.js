$(document).ready(function() {
    let currentPage = 1;

    // Function to load reviews with pagination
    function loadReviews(page = 1) {
        const product = $('.search-form input[type="search"]').val();
        const sentiments = getCheckedSentiments();

        $.ajax({
            url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/fetch-filtered-reviews.php',
            method: 'GET',
            data: { 
                page: page,
                product: product,
                sentiments: sentiments
            },
            success: function(response) {
                const data = JSON.parse(response);
                $('#reviews-table').html(data.html);
                updatePagination(data.pagination);
            },
            error: function() {
                $('#reviews-table').html('<tr><td colspan="5" class="text-danger">Failed to load reviews.</td></tr>');
            }
        });
    }

    // Function to update pagination controls
    function updatePagination(pagination) {
        const { current_page, total_pages } = pagination;
        currentPage = current_page;

        let paginationHtml = `
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item ${current_page === 1 ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${current_page - 1}">Previous</a>
                    </li>`;

        // Add page numbers
        for (let i = 1; i <= total_pages; i++) {
            paginationHtml += `
                <li class="page-item ${current_page === i ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>`;
        }

        paginationHtml += `
                    <li class="page-item ${current_page === total_pages ? 'disabled' : ''}">
                        <a class="page-link" href="#" data-page="${current_page + 1}">Next</a>
                    </li>
                </ul>
            </nav>`;
        
        $('#pagination-container').html(paginationHtml);
    }

    // Function to get checked sentiments
    function getCheckedSentiments() {
        return $('#sentiment-filters input[type="checkbox"]:checked').map(function() {
            return $(this).val();
        }).get().join(',');
    }

    // Load initial reviews
    loadReviews();

    // Handle pagination clicks
    $('#pagination-container').on('click', '.page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        if (page && page !== currentPage) {
            loadReviews(page);
        }
    });

    // Handle search form submission
    $('.search-form').on('submit', function(e) {
        e.preventDefault();
        loadReviews(1); // Reset to first page when searching
    });

    // Handle sentiment checkbox changes
    $('#sentiment-filters input[type="checkbox"]').on('change', function() {
        loadReviews(1); // Reset to first page when filtering
    });

    // Reset button click
    $('#reset-table').on('click', function() {
        // Clear search
        $('.search-form input[type="search"]').val('');
        // Reset checkboxes
        $('#sentiment-filters input[type="checkbox"]').prop('checked', true);
        // Load all reviews
        loadReviews(1);
    });
}); 