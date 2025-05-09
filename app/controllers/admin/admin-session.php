<?php
include_once(__DIR__ . '/../../config/login-config.php');
session_start();

if ($_SESSION['role'] != 1) {
    session_destroy();
    header("Location: /CS_Sentiment_Analysis_Project/app/views/login.php");
    exit();
}
