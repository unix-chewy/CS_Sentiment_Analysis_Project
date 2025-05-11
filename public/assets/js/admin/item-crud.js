$(document).ready(function(){
    
    // MAIN
    $("#item-category").change(function() {
        if ($("#item-category").val() === "-1") {
            $("#new-cat-div").show();
            $("#new-category").prop("required", true);
        } else {
            $("#new-cat-div").hide();
            $("#new-category").prop("required", false);
        }
    });
    
    // This code block only runs for view-item.php
    if (window.location.pathname.includes("product-management.php")) {
        
        let currentPage = 1;

        // Function to load products with pagination and search
        function loadProducts(page = 1, searchQuery = '') {
            $.ajax({
                url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/view-fetchProducts.php',
                method: 'GET',
                data: { 
                    page: page,
                    search: searchQuery
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    $('#viewItem-Table').html(data.html);
                    updatePagination(data.pagination);
                },
                error: function() {
                    $('#viewItem-Table').html('<tr><td colspan="7" class="text-center">Error loading products</td></tr>');
                }
            });
        }

        // Function to update pagination controls
        function updatePagination(pagination) {
            const { current_page, total_pages } = pagination;
            currentPage = current_page;

            let paginationHtml = `
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item ${current_page === 1 ? 'disabled' : ''}">
                            <a class="page-link btn btn-outline-secondary" href="#" data-page="${current_page - 1}">Previous</a>
                        </li>`;

            // Add page numbers
            for (let i = 1; i <= total_pages; i++) {
                paginationHtml += `
                    <li class="page-item ${current_page === i ? 'active' : ''}">
                        <a class="page-link ${current_page === i ? 'btn btn-secondary' : 'btn btn-outline-secondary'}" href="#" data-page="${i}">${i}</a>
                    </li>`;
            }

            paginationHtml += `
                        <li class="page-item ${current_page === total_pages ? 'disabled' : ''}">
                            <a class="page-link btn btn-outline-secondary" href="#" data-page="${current_page + 1}">Next</a>
                        </li>
                    </ul>
                </nav>`;
            
            // Update pagination container
            $('#pagination-container').html(paginationHtml);
        }

        // Load initial products
        loadProducts();

        // Handle pagination clicks - using event delegation
        $('#pagination-container').on('click', '.page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            if (page && page !== currentPage) {
                loadProducts(page);
            }
        });

        // Handle search
        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            const searchQuery = $('#search-product').val().trim();
            loadProducts(1, searchQuery); // Reset to first page when searching
        });

        // Handle search input changes
        let searchTimeout;
        $('#search-product').on('input', function() {
            clearTimeout(searchTimeout);
            const searchQuery = $(this).val().trim();
            
            // Add a small delay to prevent too many requests
            searchTimeout = setTimeout(() => {
                loadProducts(1, searchQuery);
            }, 500);
        });

        // Handle add item form submission
        $('#add-item-form').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/add-item.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#add-item-modal').modal('hide');
                    loadProducts(currentPage); // Reload current page
                    $('#add-item-form')[0].reset();
                },
                error: function() {
                    alert('Error adding item');
                }
            });
        });

        // Handle edit item form submission
        $('#edit-item-Form').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/edit-item.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#editModal').modal('hide');
                    loadProducts(currentPage); // Reload current page
                },
                error: function() {
                    alert('Error updating item');
                }
            });
        });

        // Handle delete item
        $(document).on('click', '#btn-delete', function() {
            if (confirm('Are you sure you want to delete this item?')) {
                const id = $(this).data('id');
                $.ajax({
                    url: '/CS_Sentiment_Analysis_Project/app/models/admin-models/delete-item.php',
                    method: 'POST',
                    data: { id: id },
                    success: function(response) {
                        loadProducts(currentPage); // Reload current page
                    },
                    error: function() {
                        alert('Error deleting item');
                    }
                });
            }
        });

        // Handle edit button click
        $(document).on('click', '.btn-edit', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const photo = $(this).data('photo');
            const description = $(this).data('description');
            const price = $(this).data('price');
            const category = $(this).data('category');

            $('#product-id').val(id);
            $('#edit-item-Form #item-name').val(name);
            $('#edit-item-Form #item-description').val(description);
            $('#edit-item-Form #item-price').val(price);
            $('#edit-item-Form #old-image').val(photo);
            $('#edit-item-Form #item-category').val(category);
        });

    }

    // Alert box
    $("#add-item-form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            url: "/CS_Sentiment_Analysis_Project/app/controllers/add-item-controller.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                $("#new-cat-div").hide();
                $("#new-category").prop("required", false);
                $("#add-item-modal").modal("hide");
                loadProducts(); // Refresh the product list
                $("#add-item-form")[0].reset(); 
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });

  });

