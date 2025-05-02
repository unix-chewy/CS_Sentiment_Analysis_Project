$(document).ready(function() {
    loadProducts();

    function loadProducts() {
        $.get("/CS_Sentiment_Analysis_Project/app/models/view-fetchProducts.php", function(data) {
            $("#viewItem-Table").html(data);
        });
    }

    $(document).on("click", "#btn-delete", function() {
        if (confirm("Are you sure?")) {
            $.post("/CS_Sentiment_Analysis_Project/app/controllers/delete-products.php", { id: $(this).data("id") }, function(response) {
                alert(response);
                loadProducts();
            });
        }
    });
});
