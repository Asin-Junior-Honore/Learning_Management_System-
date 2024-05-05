<?php
// Load data from the centralized data-fetching script
$data = include '../data_fetcher.php';

$announcements = $data['announcements'] ?? []; // Use empty array if data is not set
$results = $data['results'] ?? []; // Handle undefined index errors
$courses = $data['courses'] ?? []; // Handle undefined index errors
$assignments = $data['assignments'] ?? []; // Fetch assignments data
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom CSS for additional styling -->
    <style>
        /* Set a background color for the whole page */
        body {
            background-color: #f5f5f5;
            /* Light gray background */
            padding-top: 20px;
        }

        /* Add some space between sections */
        .section-heading {
            margin-top: 40px;
        }

        /* Change the card styles to add some color */
        .card {
            border: none;
            /* Remove default border */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
            /* Add shadow for depth */
            background-color: #ffffff;
            /* White card background */
            border-radius: 8px;
            /* Rounded corners */
        }

        /* Change the card header style for better visibility */
        .card-title {
            color: #007bff;
            /* Bootstrap primary color */
            font-weight: bold;
        }

        /* Add hover effects on the card */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            /* Increase shadow on hover */
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Display Announcements -->
        <h2 class="section-heading">Latest Announcements</h2>
        <?php if (count($announcements) > 0): ?>
            <?php foreach ($announcements as $announcement): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($announcement['title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($announcement['description']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No announcements available.</p>
        <?php endif; ?>

        <!-- Display Results -->
        <h2 class="section-heading">Results</h2>
        <?php if (count($results) > 0): ?>
            <?php foreach ($results as $result): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5><?= htmlspecialchars($result['student_name']) ?></h5>
                        <p><?= htmlspecialchars($result['result']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No results available.</p>
        <?php endif; ?>

        <!-- Display Courses -->
        <h2 class="section-heading">Courses</h2>
        <?php if (count($courses) > 0): ?>
            <?php foreach ($courses as $course): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5><?= htmlspecialchars($course['title']) ?></h5>
                        <p><?= htmlspecialchars($course['description']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No courses available.</p>
        <?php endif; ?>

        <!-- Display Assignments -->
        <h2 class="section-heading">Assignments</h2>
        <?php if (count($assignments) > 0): ?>
            <?php foreach ($assignments as $assignment): ?>
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <h5 class="card-title"><?= htmlspecialchars($assignment['assignment_title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($assignment['subject']) ?> -
                                <?= htmlspecialchars($assignment['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No assignments available.</p>
        <?php endif; ?>
    </div>

</body>

</html>