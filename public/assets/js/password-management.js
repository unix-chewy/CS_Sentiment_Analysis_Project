$(document).ready(function() {
    $("#change-password-form").submit(function(e) {
        e.preventDefault();
        var current_password = $("#current-password").val();
        var new_password = $("#new-password").val();
        var user_role = $("#user-role").val();
        var email = $("#email").val();
        $.ajax({
            url: "/CS_Sentiment_Analysis_Project/app/controllers/reset_password.php",
            type: "POST",
            data: {
                current_password: current_password,
                new_password: new_password,
                user_role: user_role,
                change_password: true,
                email: email
            },
            success: function(response) {
                try {
                    const result = JSON.parse(response);
                    alert(result.message);
                    if (result.success) {
                        var user_role = $("#user-role").val();
                        if (user_role == 1) {
                            window.location.href = "/CS_Sentiment_Analysis_Project/app/views/admin/admin_homepage.php";
                        } else {
                            window.location.href = "/CS_Sentiment_Analysis_Project/app/views/user/user_homepage.php";
                        }
                    }
                } catch (e) {
                    alert("An unexpected error occurred");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });

    $("#reset-password-form").submit(function(e) {
        e.preventDefault();
        var new_password = $("#new-password").val();
        var confirm_password = $("#confirm-password").val();

        if (new_password !== confirm_password) {
            alert("Passwords do not match!");
            return;
        }
        var email = $("#email").val();


        $.ajax({
            url: "/CS_Sentiment_Analysis_Project/app/controllers/reset_password.php",
            type: "POST",
            data: {
                new_password: new_password,
                email: email,
                reset_password: true
            },
            success: function(response) {
                try {
                    const result = JSON.parse(response);
                    alert(result.message);
                    if (result.success) {
                        window.location.href = "/CS_Sentiment_Analysis_Project/app/views/login.php";
                    }
                } catch (e) {
                    alert("An unexpected error occurred");
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });
        
    $("#back-button").click(function() {
        var user_role = $("#user-role").val();
        if (user_role == 1) {
            window.location.href = "/CS_Sentiment_Analysis_Project/app/views/admin/admin_homepage.php";
        } else {
            window.location.href = "/CS_Sentiment_Analysis_Project/app/views/user/user_homepage.php";
        }
    });
});