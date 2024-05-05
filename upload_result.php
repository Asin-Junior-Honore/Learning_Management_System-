<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Include database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_result'])) {
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

$conn->close();
?>