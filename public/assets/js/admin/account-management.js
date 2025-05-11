$(document).ready(function() {
    let currentPage = 1;

    // Function to load accounts with pagination
    function loadAccounts(page = 1) {
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
                $('#accounts-table').html('<tr><td colspan="6" class="text-danger">Failed to load accounts.</td></tr>');
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

    // Load initial accounts
    loadAccounts();

    // Handle pagination clicks - using event delegation
    $('#pagination-container').on('click', '.page-link', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        if (page && page !== currentPage) {
            loadAccounts(page);
        }
    });

    // Search functionality
    $('.search-form').on('submit', function(e) {
        e.preventDefault();
        let searchText = $(this).find('input[type="search"]').val().toLowerCase();
        loadAccounts(1); // Reset to first page when searching
    });

    // Edit user
    $(document).on('click', '.edit-user', function() {
        var row = $(this).closest('tr');
        $('#editUserId').val(row.find('td:eq(0)').text());
        $('#editFirstName').val(row.find('td:eq(1)').text());
        $('#editLastName').val(row.find('td:eq(2)').text());
        $('#editEmail').val(row.find('td:eq(3)').text());
        $('#editRole').val(row.find('td:eq(4)').text());
        $('#editUserModal').modal('show');
    });

    // Save user changes
    $('#saveUserChanges').click(function() {
        var formData = $('#editUserForm').serialize();
        $.ajax({
            url: '/CS_Sentiment_Analysis_Project/app/controllers/admin/update-account.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert(response);
                $('#editUserModal').modal('hide');
                loadAccounts(currentPage); // Reload current page after update
            }
        });
    });

    // Delete user
    $(document).on('click', '.delete-user', function() {
        var row = $(this).closest('tr');
        var id = row.find('td:eq(0)').text();
        
        if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            $.ajax({
                url: '/CS_Sentiment_Analysis_Project/app/controllers/admin/delete-account.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    alert(response);
                    loadAccounts(currentPage); // Reload current page after delete
                }
            });
        }
    });
}); 