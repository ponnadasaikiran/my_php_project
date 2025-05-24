<?php
$host = "localhost";       // MySQL server
$user = "root";            // Default XAMPP user
$password = "";            // Default is empty for root in XAMPP
$database = "blog";        // Your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>