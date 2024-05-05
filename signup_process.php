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
$confirm_password = $_POST['confirm_password'];
$role = $_POST['role'];

// Validate password match
if ($password !== $confirm_password) {
    header("Location: pages/signup.php?error=password_mismatch");
    exit();
}

// SQL injection prevention
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Hash the password (for better security)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement to check if username already exists
$sql = "SELECT * FROM users_godwin WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Username already exists
    header("Location: pages/signup.php?error=username_taken");
    exit();
} else {
    // Insert new user into the database
    $insert_sql = "INSERT INTO users_godwin (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
    if ($conn->query($insert_sql) === TRUE) {
        // Signup successful
        header("Location: pages/login.php");
        exit();
    } else {
        // Error inserting user into the database
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>