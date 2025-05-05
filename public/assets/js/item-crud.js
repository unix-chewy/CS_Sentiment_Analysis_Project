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
    if (window.location.pathname.includes("view-item.php")) {
        
        loadProducts();

        $("#edit-item-Form").submit(function(e) { // ajax form since manipulating of content type and process data is needed for file uploads
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
                    $("#editModal").modal("hide");   
                    loadProducts();                        
                }
            });
        });

        // view-fetchProducts.php
        function loadProducts() {
            $.get("/CS_Sentiment_Analysis_Project/app/models/view-fetchProducts.php", function(data) {
                $("#viewItem-Table").html(data);
            });
        }

        // (delete-products.php) The following code deletes the product from the database
        $(document).on("click", "#btn-delete", function() {
            if (confirm("Are you sure?")) {
                $.post("/CS_Sentiment_Analysis_Project/app/controllers/delete-products.php", { id: $(this).data("id") }, function(response) {
                    alert(response);
                    loadProducts();
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

  });
