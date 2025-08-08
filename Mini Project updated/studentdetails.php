<?php
// Start the session to fetch the student data
session_start();

// If the student data isn't in the session, redirect to login page
if (!isset($_SESSION['student_data'])) {
    header("Location: login.html");
    exit();
}

// Fetch student data from session
$student = $_SESSION['student_data'];

// Suppress warnings for missing array keys by using isset()
$name = isset($student['name']) ? htmlspecialchars($student['name']) : '';
$reg_no = isset($student['reg_no']) ? htmlspecialchars($student['reg_no']) : '';
$duration = isset($student['duration']) ? htmlspecialchars($student['duration']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="others.css">
    <style>
        .container h2 {
            color: #462B66;
            font-size: 24px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            color: #462B66;
            font-size: 16px;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="date"],
        .form-group input[type="file"] {
            font-size: 16px;
            padding: 10px;
        }
        .form-control {
            width: 100%;
        }
    </style>
</head>
<body>
    <header class="index">
        <img id="logo1" src="vimala logo.jfif" alt="logo" width="23px" height="23px">
        <img id="logo1" src="logo.png.jpeg" alt="logo" width="23px" height="23px">CS DEPARTMENT PLANNER
    </header>

    <div class="navbar" id="indexnav">
        <a href="others.html">Home</a>
        <a href="logout.php">LogOut</a>
    </div>

    <div class="container">
        <h2>STUDENT DETAILS</h2>
        <form method="post">
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="registerNumber">Register Number</label>
                    <input type="text" class="form-control" id="registerNumber" name="registerNumber" value="<?= $reg_no; ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="duration">Duration</label>
                    <input type="text" class="form-control" id="duration" name="duration" value="<?= $duration; ?>" readonly>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <h2>MY PERFORMANCE</h2>
        <form action="stdupload.php" method="post" enctype="multipart/form-data">
            <!-- Row 1 -->
            <div class="row">
                <div class="col-sm-6">
                    <label for="sem1">Semester 1</label>
                    <input type="file" name="sem1" id="sem1">
                    <input type="submit" value="Upload"><br>
                </div>
                <div class="col-sm-6">
                    <label for="sem2">Semester 2</label>
                    <input type="file" name="sem2" id="sem2">
                    <input type="submit" value="Upload"><br>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row">
                <div class="col-sm-6">
                    <label for="sem3">Semester 3</label>
                    <input type="file" name="sem3" id="sem3">
                    <input type="submit" value="Upload"><br>
                </div>
                <div class="col-sm-6">
                    <label for="sem4">Semester 4</label>
                    <input type="file" name="sem4" id="sem4">
                    <input type="submit" value="Upload"><br>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="row">
                <div class="col-sm-6">
                    <label for="sem5">Semester 5</label>
                    <input type="file" name="sem5" id="sem5">
                    <input type="submit" value="Upload"><br>
                </div>
            </div>
        </form>
    </div>

</body>
</html>