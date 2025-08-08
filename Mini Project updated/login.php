<?php
session_start();
$conn = new mysqli("localhost", "root", "", "miniproject");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role === "admin") {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
    } elseif ($role === "coordinator") {
        $stmt = $conn->prepare("SELECT * FROM coordinator WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
    } elseif ($role === "student") {
        $stmt = $conn->prepare("SELECT * FROM students WHERE reg_no = ?");
        $stmt->bind_param("s", $username);
    } elseif ($role === "faculty") {
        $stmt = $conn->prepare("SELECT fac_id, faculty_id, name, email, phone FROM faculty WHERE faculty_id = ?");
        $stmt->bind_param("s", $username);
    } else {
        echo "<script>alert('Access denied! Only admins, coordinators, and students can log in.');window.location.href='login.html';</script>";
        exit();
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;

        // Store faculty ID (fac_id) for fetching profile details
        if ($role === "faculty") {
            $_SESSION['fac_id'] = $user['fac_id']; // Save fac_id in session
            header("Location: facprofile.html");
        } elseif ($role === "student") {
            $_SESSION['student_data'] = $user;
            header("Location: studentdetails.php");
        } elseif ($role === "admin") {
            header("Location: admin.html");
        } elseif ($role === "coordinator") {
            header("Location: announcements.html");
        }
        exit();
    } else {
        echo "<script>alert('Invalid username');window.location.href='login.html';</script>";
    }
}
$conn->close();
?>