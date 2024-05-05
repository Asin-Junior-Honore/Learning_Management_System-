<?php
// data_fetcher.php - Centralized data-fetching script
include 'db.php'; // Include the database connection

// Fetch announcements from the database
$query_announcements = "SELECT * FROM announcements";
$stmt_announcements = $pdo->prepare($query_announcements);
$stmt_announcements->execute();
$announcements = $stmt_announcements->fetchAll(PDO::FETCH_ASSOC);

// Fetch results from the database
$query_results = "SELECT * FROM results";
$stmt_results = $pdo->prepare($query_results);
$stmt_results->execute();
$results = $stmt_results->fetchAll(PDO::FETCH_ASSOC);

// Fetch courses from the database
$query_courses = "SELECT * FROM courses";
$stmt_courses = $pdo->prepare($query_courses);
$stmt_courses->execute();
$courses = $stmt_courses->fetchAll(PDO::FETCH_ASSOC);

// Fetch assignments from the database
$query_assignments = "SELECT * FROM assignments";
$stmt_assignments = $pdo->prepare($query_assignments);
$stmt_assignments->execute();
$assignments = $stmt_assignments->fetchAll(PDO::FETCH_ASSOC);

return [
    'announcements' => $announcements,
    'results' => $results,
    'courses' => $courses,
    'assignments' => $assignments,
];
