$(document).ready(function() {
    // Load accounts on page load
    loadAccounts();

    // Search functionality reused code
    $('.search-form').on('submit', function(e) {
        e.preventDefault();
        let searchText = $(this).find('input[type="search"]').val().toLowerCase();
        
        $.ajax({
            url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/fetch-accounts.php',
            method: 'GET',
            data: { search: searchText },
            success: function(data) {
                $('#accounts-table').html(data);
            },
            error: function() {
                $('#accounts-table').html('<tr><td colspan="6" class="text-danger">Failed to load accounts.</td></tr>');
            }
        });
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
                loadAccounts();
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
                    loadAccounts();
                }
            });
        }
    });
});

// Function to load all accounts
function loadAccounts() {

    var page = window.location.pathname.includes('admin_homepage') ? 'admin_homepage' : 'accounts_management';
    $.ajax({
        url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/fetch-accounts.php',
        method: 'GET',
        data: { page: page },
        success: function(data) {
            $('#accounts-table').html(data);
        },
        error: function() {
            $('#accounts-table').html('<tr><td colspan="6" class="text-danger">Failed to load accounts.</td></tr>');
        }
    });
} 