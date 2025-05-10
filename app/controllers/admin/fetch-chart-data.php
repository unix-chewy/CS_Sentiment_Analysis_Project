<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db = "shopee_db";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only output JSON if this is an AJAX request
    header('Content-Type: application/json');
    
    // For Charts
    $sql = "SELECT * FROM sentiments";
    $res = $conn->query($sql);
    $data = [];
    while ($row = $res->fetch_assoc()) {
        array_push($data, $row);
    }
    
    echo json_encode($data);
    exit;
?> 