$(document).ready(function() {
    $(document).on("click", ".btn-edit", function () { // stop it from inserting and updates the row  
        var btn = $(this);
        $("#product-id").val(btn.data("id"));
        $("#item-name").text(btn.data("name"));
        $("#item-description").text(btn.data("description"));
        $("#review-text").val(btn.data("review"));
        $("#review-votes").val(btn.data("votes"));
    });
});
