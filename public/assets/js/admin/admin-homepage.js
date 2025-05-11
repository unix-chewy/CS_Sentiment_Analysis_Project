$(document).ready(function() {
    let currentPage = 1;

    // Function to load users with pagination
    function loadUsers(page = 1) {
        $.ajax({
            url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/fetch-accounts.php',
            method: 'GET',
            data: { page: page },
            success: function(response) {
                const data = JSON.parse(response);
                $('#accounts-table').html(data.html);
                updatePagination(data.pagination);
            },
            error: function() {
                $('#accounts-table').html('<tr><td colspan="6" class="text-center">Error loading users</td></tr>');
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
        
        // Update pagination container
        $('#pagination-container').html(paginationHtml);
    }

    // Load initial users
    loadUsers();

    // Handle pagination clicks - using event delegation
    $('#pagination-container').on('click', '.page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        if (page && page !== currentPage) {
            loadUsers(page);
        }
    });
}); 