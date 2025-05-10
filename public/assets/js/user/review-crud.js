$(document).ready(function() {

    // The following code stores data to respective input fields when edit button is clicked.
    $(document).on("click", ".btn-edit", function () { // stop it from inserting and updates the row  
        var btn = $(this);
        $("#prc-id").val(btn.data("prc-id"));
        $("#user-id").val(btn.data("user-id"));
        $("#product-id").val(btn.data("product-id"));
        $("#prv-id").val(btn.data("prv-id"));
        $("#item-name").text(btn.data("name"));
        $("#item-description").text(btn.data("description"));
        $("#review-text").val(btn.data("review"));
        $("#sen-id").val(btn.data("sen-id"));
    });

    // Review submissions alert
    $("#ReviewForm").on("submit", function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        formData += "&add-review=1";
        
        $.ajax({
            url: "/CS_Sentiment_Analysis_Project/app/controllers/product-getreview.php",
            method: "POST",
            data: formData,
            success: function(response) {
                alert("Review Submitted!");
                location.reload();
            }
        });
    });

    // Edit review submissions alert
    $("#updateReviewForm").on("submit", function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        formData += "&update-review=1";
        
        $.ajax({
            url: "/CS_Sentiment_Analysis_Project/app/controllers/product-getreview.php",
            method: "POST",
            data: formData,
            success: function(response) {
                alert("Review Edited Successfully!");
                location.reload();
            }
        });
    });

    // The following code checks whether a product has been rated by the user.
    $("#rate-btn").click(function(e) {
        const productID = $(this).data("product-id");
        $.ajax({
            url: "/CS_Sentiment_Analysis_Project/app/models/user-models/check_review.php",
            method: "GET",
            data: { id: productID},
            success: function(response) {
                if (response.status === "exists") {
                    alert(response.message);
                    $("#rate-item-modal").modal('hide');
                } else if (response.status === "new") {
                    alert(response.message); // or show a modal to rate
                    $("#rate-item-modal").modal('show');
                } else {
                    console.error("Unexpected response", response);

                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });

    // The following code deletes the review from the database.
    $(document).on("click", "#btn-delete", function() {
        if (confirm("Are you sure?")) {
            $.post("/CS_Sentiment_Analysis_Project/app/controllers/delete-reviews.php", 
                { 
                prc_id: $(this).data("prc-id"), 
                prv_id: $(this).data("prv-id"),
                sen_id: $(this).data("sen-id")
                },
                function(response) {
                    alert("Deleted Successfully!");
                    location.reload();
                }
            );
        }
    });

    // Search button
    $("#search-button").click(function(e) {
        e.preventDefault();
        var searchQuery = $("#search-product").val();
        window.location.href = "user_homepage.php?searchQuery=" + searchQuery;
    });
});