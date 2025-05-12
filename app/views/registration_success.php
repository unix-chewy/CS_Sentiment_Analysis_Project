<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        .success-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .success-card {
            padding: 2rem;
            text-align: center;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            background-color: white;
        }
        .success-icon {
            color: #28a745;
            font-size: 4rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">✓</div>
            <h2 class="mb-4">Registration Successful!</h2>
            <p class="mb-4">Your account has been created successfully. You can now login to your account.</p>
            <a href="/CS_Sentiment_Analysis_Project/app/views/login.php" class="btn btn-primary">Continue to Login</a>
        </div>
    </div>
</body>
</html> 