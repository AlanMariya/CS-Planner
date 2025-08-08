<?php
session_start();
$conn = new mysqli("localhost", "root", "", "miniProject");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in as faculty
if (!isset($_SESSION['username']) || $_SESSION['role'] !== "faculty") {
    echo "<script>alert('Unauthorized access! Please log in as a faculty member.'); window.location.href='login.html';</script>";
    exit();
}

// Get department and year from the form
$department = $_POST['department'];
$year = $_POST['year'];

// Fetch students based on department and year
$sql = "SELECT reg_no, name, sem1, sem2, sem3, sem4, sem5 FROM students WHERE dept_id = (SELECT dept_id FROM department WHERE dept_name = ?) AND year = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $department, $year);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Mark List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="others.css">
</head>
<body>
<header class="index">
        <img id="logo" src="vimala logo.jfif" alt="logo" width="23px" height="23px">
        <img id="logo1" src="logo.png.jpeg" alt="vimala" width="23px" height="23px"> CS DEPARTMENT PLANNER
    </header>

    <div class="container">
        <h2>Student Mark List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Register Number</th>
                    <th>Name</th>
                    <th>Semester 1</th>
                    <th>Semester 2</th>
                    <th>Semester 3</th>
                    <th>Semester 4</th>
                    <th>Semester 5</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['reg_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php if ($row['sem1']) echo '<a href="download.php?reg_no=' . $row['reg_no'] . '&sem=1">Download</a>'; ?></td>
                    <td><?php if ($row['sem2']) echo '<a href="download.php?reg_no=' . $row['reg_no'] . '&sem=2">Download</a>'; ?></td>
                    <td><?php if ($row['sem3']) echo '<a href="download.php?reg_no=' . $row['reg_no'] . '&sem=3">Download</a>'; ?></td>
                    <td><?php if ($row['sem4']) echo '<a href="download.php?reg_no=' . $row['reg_no'] . '&sem=4">Download</a>'; ?></td>
                    <td><?php if ($row['sem5']) echo '<a href="download.php?reg_no=' . $row['reg_no'] . '&sem=5">Download</a>'; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="facprofile.html" class="btn btn-primary">Back to Profile</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
