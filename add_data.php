<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myfirstdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form for adding a course is submitted
    if (isset($_POST['add_course'])) {
        // Retrieve form data
        $course_title = $_POST['course_title'];
        $course_description = $_POST['course_description'];

        // SQL injection prevention
        $course_title = mysqli_real_escape_string($conn, $course_title);
        $course_description = mysqli_real_escape_string($conn, $course_description);

        // Prepare SQL statement to insert course into database
        $sql = "INSERT INTO courses (title, description) VALUES ('$course_title', '$course_description')";

        if ($conn->query($sql) === TRUE) {
            // Course added successfully
            header("Location: pages/admin.php?message=course_added");
        } else {
            // Error adding course
            header("Location: pages/admin.php?error=course_add_error");
        }
    } elseif (isset($_POST['add_announcement'])) {
        // Retrieve form data
        $announcement_title = $_POST['announcement_title'];
        $announcement_description = $_POST['announcement_description'];

        // SQL injection prevention
        $announcement_title = mysqli_real_escape_string($conn, $announcement_title);
        $announcement_description = mysqli_real_escape_string($conn, $announcement_description);

        // Prepare SQL statement to insert announcement into database
        $sql = "INSERT INTO announcements (title, description) VALUES ('$announcement_title', '$announcement_description')";

        if ($conn->query($sql) === TRUE) {
            // Announcement added successfully
            header("Location: pages/admin.php?message=announcement_added");
        } else {
            // Error adding announcement
            header("Location: pages/admin.php?error=announcement_add_error");
        }
    } elseif (isset($_POST['upload_result'])) {
        // Retrieve form data
        $student_name = $_POST['student_name'];
        $result = $_POST['result'];

        // SQL injection prevention
        $student_name = mysqli_real_escape_string($conn, $student_name);
        $result = mysqli_real_escape_string($conn, $result);

        // Prepare SQL statement to upload result into database
        $sql = "INSERT INTO results (student_name, result) VALUES ('$student_name', '$result')";

        if ($conn->query($sql) === TRUE) {
            // Result uploaded successfully
            header("Location: pages/admin.php?message=result_uploaded");
        } else {
            // Error uploading result
            header("Location: pages/admin.php?error=result_upload_error");
        }
    }
}

$conn->close();
?>