<?php
session_start();
// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: pages/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Portal</title>
</head>

<style>
    img {
        width: 100px;
        height: 100px;
    }

    .adjust {
        margin: auto;
        margin-left: 10rem;
    }
</style>

<body>
    <div class="container mt-5">

        <div class="d-flex align-items-start">
            <div>
                <img src="assets/promise.jpeg" alt="Welcome Image" class="img-fluid" style="max-width: 200px; margin-right: 20px;">
            </div>
            <!-- Welcome Section -->
            <div class="text-cente adjust mb-4">
                <h1 class="display-5">Welcome to the Portal of <br /> computer science department</h1>
                <p class="lead">Your one-stop platform for all educational resources and information.</p>
            </div>
        </div>


        <!-- Navigation Section -->
        <div class="d-flex justify-content-center mb-4">
            <h2 class="h4 me-3">Navigate to:</h2>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="pages/admin.php" class="btn btn-outline-primary">Admin Panel</a>
                </li>
                <li class="list-inline-item">
                    <a href="pages/lecturer.php" class="btn btn-outline-success">Lecturer Panel</a>
                </li>
                <li class="list-inline-item">
                    <a href="pages/student.php" class="btn btn-outline-info">Student Panel</a>
                </li>
                <li class="list-inline-item">
                    <a href="pages/logout.php" class="btn btn-outline-danger">Logout</a>
                </li>
            </ul>
        </div>

        <!-- Overview Section -->
        <div class="mb-5">
            <h2 class="h4">Overview of the Portal</h2>
            <p>
                Our portal is designed to streamline educational processes and enhance communication within the academic
                community.
                With easy access to important announcements, courses, exam results, and more, we aim to create an
                engaging and
                informative experience for students, teachers, and administrators alike.
            </p>
            <p>
                Explore the different panels to find relevant information and resources.
                Whether you're a student looking for course materials, a teacher managing your classroom,
                or an administrator overseeing operations, our portal has everything you need.
            </p>
        </div>

        <!-- Announcements Section -->
        <div class="mb-5">
            <h2 class="h4">Latest Announcements and News</h2>
            <p>
                Stay updated with the latest happenings in our academic community.
                From important dates to school events, this section provides you with all the latest information.
            </p>
            <p>
                Don't forget to check regularly for new announcements, as we frequently update this section to keep you
                informed
                of everything that's happening in our educational environment.
            </p>
        </div>
    </div>
</body>

</html>