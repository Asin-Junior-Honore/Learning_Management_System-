<?php
session_start();

// Ensure user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myfirstdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST requests
$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['operation'])) {
        switch ($_POST['operation']) {
            case 'add_course':
                // Add a new course
                $course_title = mysqli_real_escape_string($conn, $_POST['course_title']);
                $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);

                $sql = "INSERT INTO courses (title, description) VALUES ('$course_title', '$course_description')";

                if ($conn->query($sql) === TRUE) {
                    $success_message = "Course added successfully!";
                    header("Location: admin.php?success=course_added");
                    exit();
                } else {
                    $error_message = "Error adding course.";
                }
                break;

            case 'add_announcement':
                // Add a new announcement
                $announcement_title = mysqli_real_escape_string($conn, $_POST['announcement_title']);
                $announcement_description = mysqli_real_escape_string($conn, $_POST['announcement_description']);

                $sql = "INSERT INTO announcements (title, description) VALUES ('$announcement_title', '$announcement_description')";

                if ($conn->query($sql) === TRUE) {
                    $success_message = "Announcement added successfully!";
                    header("Location: admin.php?success=announcement_added");
                    exit();
                } else {
                    $error_message = "Error adding announcement.";
                }
                break;

            case 'upload_result':
                // Upload a result
                $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
                $result = mysqli_real_escape_string($conn, $_POST['result']);

                $sql = "INSERT INTO results (student_name, result) VALUES ('$student_name', '$result')";

                if ($conn->query($sql) === TRUE) {
                    $success_message = "Result uploaded successfully!";
                    header("Location: admin.php?success=result_uploaded");
                    exit();
                } else {
                    $error_message = "Error uploading result.";
                }
                break;

            case 'delete_course':
                // Delete a course
                $course_id = $_POST['course_id'];
                $sql = "DELETE FROM courses WHERE id = $course_id";

                if ($conn->query($sql) === TRUE) {
                    $success_message = "Course deleted successfully!";
                    header("Location: admin.php?success=course_deleted");
                    exit();
                } else {
                    $error_message = "Error deleting course.";
                }
                break;

            case 'delete_announcement':
                // Delete an announcement
                $announcement_id = $_POST['announcement_id'];
                $sql = "DELETE FROM announcements WHERE id = $announcement_id";

                if ($conn->query($sql) === TRUE) {
                    $success_message = "Announcement deleted successfully!";
                    header("Location: admin.php?success=announcement_deleted");
                    exit();
                } else {
                    $error_message = "Error deleting announcement.";
                }
                break;

            case 'delete_result':
                // Delete a result
                $result_id = $_POST['result_id'];
                $sql = "DELETE FROM results WHERE id = $result_id";

                if ($conn->query($sql) === TRUE) {
                    $success_message = "Result deleted successfully!";
                    header("Location: admin.php?success=result_deleted");
                    exit();
                } else {
                    $error_message = "Error deleting result.";
                }
                break;
        }
    }
}

// Display success or error messages based on GET parameters
if (isset($_GET['success'])) {
    switch ($_GET['success']) {
        case 'course_added':
            $success_message = "Course added successfully!";
            break;
        case 'announcement_added':
            $success_message = "Announcement added successfully!";
            break;
        case 'result_uploaded':
            $success_message = "Result uploaded successfully!";
            break;
        case 'course_deleted':
            $success_message = "Course deleted successfully!";
            break;
        case 'announcement_deleted':
            $success_message = "Announcement deleted successfully!";
            break;
        case 'result_deleted':
            $success_message = "Result deleted successfully!";
            break;
    }
}

// Fetch courses, announcements, and results
$sql_courses = "SELECT * FROM courses";
$courses_result = $conn->query($sql_courses);

$sql_announcements = "SELECT * FROM announcements";
$announcements_result = $conn->query($sql_announcements);

$sql_results = "SELECT * FROM results";
$results_result = $conn->query($sql_results);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Admin Panel</h1>

        <!-- Display success or error messages -->
        <?php if (!empty($success_message)) { ?>
            <div class="alert alert-success"><?= $success_message ?></div>
        <?php } elseif (!empty($error_message)) { ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php } ?>

        <!-- Form to Add a Course -->
        <h2>Add Course</h2>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <input type="hidden" name="operation" value="add_course">
            <div class="mb-3">
                <label for="course_title" class="form-label">Course Title:</label>
                <input type="text" id="course_title" name="course_title" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="course_description" class="form-label">Description:</label>
                <textarea id="course_description" name="course_description" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Course</button>
        </form>

        <!-- Form to Add an Announcement -->
        <h2>Add Announcement</h2>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <input type="hidden" name="operation" value="add_announcement">
            <div class="mb-3">
                <label for="announcement_title" class="form-label">Announcement Title:</label>
                <input type="text" id="announcement_title" name="announcement_title" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="announcement_description" class="form-label">Description:</label>
                <textarea id="announcement_description" name="announcement_description" class="form-control"
                    required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Announcement</button>
        </form>

        <!-- Form to Upload a Result -->
        <h2>Upload Result</h2>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <input type="hidden" name="operation" value="upload_result">
            <div class="mb-3">
                <label for="student_name" class="form-label">Student Name:</label>
                <input type="text" id="student_name" name="student_name" class="form-control required />
            </div>
            <div class=" mb-3">
                <label for="result" class="form-label">Result:</label>
                <input type="text" id="result" name="result" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-primary">Upload Result</button>
        </form>

        <!-- Display existing courses, announcements, and results with delete option -->
        <h2>Existing Courses</h2>
        <?php if ($courses_result->num_rows > 0): ?>
            <?php while ($course = $courses_result->fetch_assoc()): ?>
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <h5 class="card-title"><?= htmlspecialchars($course['title']) ?></h5>
                            <p><?= htmlspecialchars($course['description']) ?></p>
                        </div>
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                            <input type="hidden" name="operation" value="delete_course">
                            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No courses available.</p>
        <?php endif; ?>

        <!-- Display existing announcements -->
        <h2>Existing Announcements</h2>
        <?php if ($announcements_result->num_rows > 0): ?>
            <?php while ($announcement = $announcements_result->fetch_assoc()): ?>
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <h5><?= htmlspecialchars($announcement['title']) ?></h5>
                            <p><?= htmlspecialchars($announcement['description']) ?></p>
                        </div>
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                            <input type="hidden" name="operation" value="delete_announcement">
                            <input type="hidden" name="announcement_id" value="<?= $announcement['id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No announcements available.</p>
        <?php endif; ?>

        <!-- Display existing results -->
        <h2>Existing Results</h2>
        <?php if ($results_result->num_rows > 0): ?>
            <?php while ($result = $results_result->fetch_assoc()): ?>
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <h5><?= htmlspecialchars($result['student_name']) ?></h5>
                            <p><?= htmlspecialchars($result['result']) ?></p>
                        </div>
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                            <input type="hidden" name="operation" value="delete_result">
                            <input type="hidden" name="result_id" value="<?= $result['id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No results available.</p>
        <?php endif; ?>

        <!-- Logout -->
        <div class="mt-4">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>

</html>