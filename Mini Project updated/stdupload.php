<?php
session_start();
$conn = new mysqli("localhost", "root", "", "miniProject");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== "student") {
    echo "<script>alert('Unauthorized access! Please log in as a student.');window.location.href='login.html';</script>";
    exit();
}

// Get logged-in student's register number
$reg_no = $_SESSION['username'];

$uploadSuccess = false;

foreach ($_FILES as $key => $file) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileData = file_get_contents($file['tmp_name']); // Read file content
        $fileData = $conn->real_escape_string($fileData); // Escape for SQL query

        // Identify which semester is being uploaded
        $semColumn = "";
        if ($key == "sem1") $semColumn = "sem1";
        if ($key == "sem2") $semColumn = "sem2";
        if ($key == "sem3") $semColumn = "sem3";
        if ($key == "sem4") $semColumn = "sem4";
        if ($key == "sem5") $semColumn = "sem5";

        if ($semColumn !== "") {
            // Update the respective semester column in the student table
            $sql = "UPDATE students SET $semColumn = '$fileData' WHERE reg_no = '$reg_no'";
            if ($conn->query($sql) === TRUE) {
                $uploadSuccess = true;
            } else {
                echo "<script>alert('Error uploading $semColumn');window.history.back();</script>";
                exit();
            }
        }
    }
}

if ($uploadSuccess) {
    echo "<script>alert('Files uploaded successfully!');window.location.href='studentdetails.php';</script>";
} else {
    echo "<script>alert('No files uploaded!');window.history.back();</script>";
}

$conn->close();
?>
