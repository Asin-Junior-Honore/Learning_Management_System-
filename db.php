<?php
// db.php - Database connection file
$host = 'localhost'; // Change to your database host
$db = 'myfirstdatabase'; // Change to your database name
$user = 'root'; // Change to your database username
$pass = ''; // Change to your database password
$charset = 'utf8mb4'; // Ensure correct charset

// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    error_log('Database connection error: ' . $e->getMessage());
    die('Database connection failed. Please try again later.');
}
?>