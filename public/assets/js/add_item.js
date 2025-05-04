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

    $("#rate-btn").click(function() {
        alert("TITE");
    });
  });