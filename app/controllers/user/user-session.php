<?php
include_once '../../config/login-config.php';
session_start();

if ($_SESSION['role'] != 2) {
    session_destroy();
    header("Location: /CS_Sentiment_Analysis_Project/app/views/login.php");
    exit();
}