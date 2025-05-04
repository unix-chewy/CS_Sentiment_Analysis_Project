$(document).ready(function(){
    $("#item-category").change(function() {
        if ($("#item-category").val() === "-1") {
            $("#new-cat-div").show();
            $("#new-category").prop("required", true);
        } else {
            $("#new-cat-div").hide();
            $("#new-category").prop("required", false);
        }
    });

    $("#rate-btn").click(function(e) {
        const productID = $(this).data("product-id");
        $.ajax({
            url: "/CS_Sentiment_Analysis_Project/app/models/check_review.php",
            method: "GET",
            data: { id: productID},
            success: function(response) {
                if (response.status === "exists") {
                    window.location.href = response.redirect;
                } else if (response.status === "new") {
                    alert(response.message); // or show a modal to rate
                } else {
                    console.error("Unexpected response", response);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
       });
  });