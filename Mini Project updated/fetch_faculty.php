<?php
session_start();
include 'db_connection.php'; // Database connection file

if (!isset($_SESSION['fac_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$fac_id = $_SESSION['fac_id']; // Get logged-in faculty ID

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch only required fields
$stmt = $conn->prepare("SELECT fac_id, faculty_id, name, email, phone FROM faculty WHERE fac_id = ?");
$stmt->bind_param("s", $fac_id);
$stmt->execute();
$result = $stmt->get_result();

// Set header to ensure proper JSON output
header("Content-Type: application/json");

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "No faculty data found"]);
}

$stmt->close();
$conn->close();
?>