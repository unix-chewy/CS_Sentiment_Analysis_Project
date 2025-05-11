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

        // Update loadProducts to accept a page parameter
        function loadProducts(page = 1) {
            currentPage = page;
            $.get("/CS_Sentiment_Analysis_Project/app/models/admin-models/view-fetchProducts.php", { page: page }, function(data) {
                // If backend returns JSON with html and pagination
                try {
                    let parsed = JSON.parse(data);
                    $("#viewItem-Table").html(parsed.html);
                    updatePagination(parsed.pagination);
                } catch (e) {
                    // fallback for old HTML-only response
                    $("#viewItem-Table").html(data);
                    $("#pagination-container").empty();
                }
            });
        }

        // Add a function to update pagination controls
        function updatePagination(pagination) {
            const { current_page, total_pages } = pagination;
            currentPage = current_page;
            if (total_pages <= 1) {
                $('#pagination-container').empty();
                return;
            }
            let paginationHtml = `<nav aria-label="Page navigation"><ul class="pagination mb-0">`;
            paginationHtml += `<li class="page-item ${current_page === 1 ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${current_page - 1}">Previous</a></li>`;
            for (let i = 1; i <= total_pages; i++) {
                paginationHtml += `<li class="page-item ${current_page === i ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
            }
            paginationHtml += `<li class="page-item ${current_page === total_pages ? 'disabled' : ''}"><a class="page-link" href="#" data-page="${current_page + 1}">Next</a></li>`;
            paginationHtml += `</ul></nav>`;
            $('#pagination-container').html(paginationHtml);
        }

        // Initial load
        loadProducts();

        // Pagination click handler
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            if (page && page !== currentPage) {
                loadProducts(page);
            }
        });

        $("#edit-item-Form").submit(function(e) { 
            e.preventDefault();
            var formData = new FormData(this);    
            $.ajax({
                url: "/CS_Sentiment_Analysis_Project/app/controllers/edit-products.php",
                type: "POST",
                data: formData,
                contentType: false, 
                processData: false, 
                success: function(response) {
                    alert(response);
                    $("#edit-item-Form")[0].reset();        
                    $("#product-id").val("");               
                    $("#old-image").val("");
                    $("#new-cat-div").hide();
                    $("#new-category").prop("required", false);
                    $("#editModal").modal("hide");   
                    loadProducts();                        
                }
            });
        });

        // search-product.php
        $("#search-form").submit(function(e) {
            e.preventDefault();
            var searchProductAdmin = $("#search-product").val();
            $.post("/CS_Sentiment_Analysis_Project/app/controllers/admin/search-product.php", { searchProductAdmin: searchProductAdmin }, function(displayData) {
                $("#viewItem-Table").empty();
                $("#viewItem-Table").html(displayData);
            });
        });
        
        // (delete-products.php) 
        $(document).on("click", "#btn-delete", function() {
            if (confirm("Are you sure?")) {
                $.post("/CS_Sentiment_Analysis_Project/app/controllers/delete-products.php", { id: $(this).data("id") }, function(response) {
                    alert(response);
                    loadProducts(currentPage);
                });
            }
        });

        $(document).on("click", ".btn-edit", function () { // stop it from inserting and updates the row  
            var btn = $(this);
            $("#product-id").val(btn.data("id"));
            $("#item-name").val(btn.data("name"));
            $("#item-description").val(btn.data("description"));
            $("#item-price").val(btn.data("price"));
            $("#item-category").val(btn.data("category"));
            $("#old-image").val(btn.data("photo"));
            $("#item-image").val(""); 
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
                loadProducts(currentPage); // Refresh the product list
                $("#add-item-form")[0].reset(); 
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });

  });