<?php
session_start();

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

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// SQL injection prevention
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Prepare SQL statement
$sql = "SELECT * FROM users_godwin WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Verify hashed password
    if (password_verify($password, $row['password'])) {
        // Check if the role matches
        if ($row['role'] === $role) {
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            // Redirect user based on role
            if ($role === 'admin') {
                header("Location: pages/admin.php");
            } elseif ($role === 'student') {
                header("Location: index.php");
            } elseif ($role === 'teacher') {
                header("Location: pages/lecturer.php");
            }
            exit();
        } else {
            // Invalid role selected
            header("Location: pages/login.php?error=invalid_role");
            exit();
        }
    }
}

// Invalid credentials
header("Location: pages/login.php?error=invalid_credentials");
exit();

$conn->close();
?>