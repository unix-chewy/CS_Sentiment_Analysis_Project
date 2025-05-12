<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Error</title>
    <style>
        :root {
        --primary-color: #ff6633;
        --secondary-color: #f53d2d;
        --button-hover-color: #f53d2d;
        --background-color: white;
        --text-color: #fff;
        --shadow-color: rgba(0, 0, 0, 0.1);
        --price-color: #ff6633;
        --modal-bg: #fff;
        --rating-color: #FFBD13;
        --hover-scale: 1.1;
        }

        body {
        font-family: Arial, sans-serif;
        background-color: var(--background-color);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        }

        .error-container {
        text-align: center;
        padding: 2rem;
        background-color: var(--background-color);
        border-radius: 8px;
        box-shadow: 0 2px 4px var(--shadow-color);
        max-width: 500px;
        }

        .error-icon {
        font-size: 4rem;
        color: var(--secondary-color);
        margin-bottom: 1rem;
        }

        h1 {
        color: var(--text-color);
        margin-bottom: 1rem;
        }

        p {
        color: #6c757d; 
        margin-bottom: 2rem;
        }

        .home-button {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background-color: var(--primary-color);
        color: var(--text-color);
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.2s;
        }

        .home-button:hover {
        background-color: var(--button-hover-color);
        }

    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">⚠️</div>
        <h1>Access Error</h1>
        <p>Sorry, an error occurred while trying to access this page. Please try again or return to the homepage.</p>
        <a href="/" class="home-button">Return to Homepage</a>
    </div>
</body>
</html> 