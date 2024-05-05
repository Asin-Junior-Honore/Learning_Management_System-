<?php
session_start();

// Check if the user is logged in and is a teacher
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'teacher') {
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

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['operation'])) {
        switch ($_POST['operation']) {
            case 'upload_assignment':
                if (isset($_POST['assignment_title'], $_POST['subject'], $_POST['description'])) {
                    $assignment_title = mysqli_real_escape_string($conn, $_POST['assignment_title']);
                    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $sql = "INSERT INTO assignments (assignment_title, subject, description) 
                            VALUES ('$assignment_title', '$subject', '$description')";

                    if ($conn->query($sql) === TRUE) {
                        header("Location: teacher.php?success=assignment_uploaded");
                        exit();
                    } else {
                        $error_message = "Error uploading assignment: " . $conn->error;
                    }
                } else {
                    $error_message = "Required fields are missing.";
                }
                break;

            case 'delete_assignment':
                if (isset($_POST['assignment_id'])) {
                    $assignment_id = intval($_POST['assignment_id']);
                    $sql = "DELETE FROM assignments WHERE id = $assignment_id";

                    if ($conn->query($sql) === TRUE) {
                        header("Location: teacher.php?success=assignment_deleted");
                        exit();
                    } else {
                        $error_message = "Error deleting assignment: " . $conn->error;
                    }
                }
                break;
        }
    }
}

// Fetch assignments (without filtering by)
$sql_assignments = "SELECT * FROM assignments";
$assignments_result = $conn->query($sql_assignments);

if ($assignments_result === false) {
    $error_message = "Error fetching assignments: " . $conn->error;
    $assignments_result = null; // To prevent property errors
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Teacher Panel</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Lecturer Panel</h1>

        <!-- Display success or error messages -->
        <?php
        if (isset($_GET['success'])) {
            switch ($_GET['success']) {
                case 'assignment_uploaded':
                    echo "<div class='alert alert-success'>Assignment uploaded successfully!</div>";
                    break;
                case 'assignment_deleted':
                    echo "<div class='alert alert-success'>Assignment deleted successfully!</div>";
                    break;
            }
        } elseif (!empty($error_message)) {
            echo "<div class='alert alert-danger'>$error_message</div>";
        }
        ?>

        <!-- Assignment Form -->
        <h2>Upload Assignment</h2>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <input type="hidden" name="operation" value="upload_assignment">
            <div class="mb-3">
                <label for="assignment_title" class="form-label">Assignment Title:</label>
                <input type="text" class="form-control" id="assignment_title" name="assignment_title" required />
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required />
            </div>
            <div class="mb-3">
                <label for "description" class="form-label">Description:</label>
                <textarea id="description" name="description" required rows="4" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Upload Assignment</button>
        </form>

        <!-- Display existing assignments -->
        <h2 class="mt-4">Existing Assignments</h2>
        <?php if ($assignments_result !== null && $assignments_result->num_rows > 0): ?>
            <?php while ($assignment = $assignments_result->fetch_assoc()): ?>
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <h5 class="card-title"><?= htmlspecialchars($assignment['assignment_title']) ?></h5>
                            <p><?= htmlspecialchars($assignment['subject']) ?> -
                                <?= htmlspecialchars($assignment['description']) ?>
                            </p>
                        </div>
                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            <input type="hidden" name="operation" value="delete_assignment">
                            <input type="hidden" name="assignment_id" value="<?= intval($assignment['id']) ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No assignments available.</p>
        <?php endif; ?>

        <!-- Logout -->
        <div class="mt-4">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>

</html>