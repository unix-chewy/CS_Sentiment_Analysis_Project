<?php
include_once(__DIR__ . '/../../config/login-config.php');
session_start();

if ($_SESSION['role'] != 2) {
    header("Location: /CS_Sentiment_Analysis_Project/app/views/access_error.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: /CS_Sentiment_Analysis_Project/app/views/login.php");
    exit();
}
?>