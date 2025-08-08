<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "miniproject";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $content = $_POST['lname']; // Get content from textarea
    $announcement_date = date("Y-m-d H:i:s"); // Current timestamp

    // Handling brochure upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    // Insert data into database
    $sql = "INSERT INTO announcement (upload_brochure, Content, announcement_date) 
            VALUES ('$target_file', '$content', '$announcement_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Announcement uploaded successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>