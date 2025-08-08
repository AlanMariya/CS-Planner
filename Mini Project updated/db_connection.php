<?php
$host = "localhost";  // Change this if using a different server
$username = "root";   // Default username for XAMPP/MAMP
$password = "";       // Leave blank if no password is set
$database = "miniProject";  // Your database name

// Create the connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>