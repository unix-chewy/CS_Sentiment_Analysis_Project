$(document).ready(function() {
    // Login Form
    $("#login-form").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "/CS_Sentiment_Analysis_Project/app/controllers/login-register.php",
            type: "POST",
            data: $(this).serialize() + "&login_button=1",
            success: function(response) {
                var data = JSON.parse(response);  // Parse the JSON response
                alert(data.message);  // Show the message

                if (data.status === "success") {
                    // Redirect based on the role
                    if (data.role == 1) {
                        window.location.href = "/CS_Sentiment_Analysis_Project/app/views/admin/admin_homepage.php";
                    } else {
                        window.location.href = "/CS_Sentiment_Analysis_Project/app/views/user/user_homepage.php";
                    }
                }
            },
        });
    });

    // Register Form
    $("#signup-form").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "/CS_Sentiment_Analysis_Project/app/controllers/login-register.php",
            type: "POST",
            data: $(this).serialize() + "&signup_button=1",
            success: function(response) {
                var data = JSON.parse(response);  // Parse the JSON response
                if (data.status === "success") {
                    window.location.href = "/CS_Sentiment_Analysis_Project/app/views/registration_success.php";
                } else {
                    alert(data.message);  // Show error message if registration fails
                }
            },
        });
    });
});
