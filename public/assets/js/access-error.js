$(document).ready(function() {
    $('#home-button').click(function(e) {
        e.preventDefault();
        const role = $('#role').val();
        
        if (role === '1') {
            window.location.href = '/CS_Sentiment_Analysis_Project/app/views/admin/admin_homepage.php';
        } else if (role === '2') {
            window.location.href = '/CS_Sentiment_Analysis_Project/app/views/user/user_homepage.php';
        } else {
            window.location.href = '/CS_Sentiment_Analysis_Project/app/views/login.php';
        }
    });
});