<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <title>Signup</title>
</head>

<body>

    <?php
    // Check if error parameter is set in the URL
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        // Display corresponding error message
        if ($error == 'password_mismatch') {
            echo "<p>Passwords do not match.</p>";
        } elseif ($error == 'username_taken') {
            echo "<p>Username already taken. Please choose another one.</p>";
        }
    }
    ?>


    <div class="container mt-4">
        <h2>Signup</h2>
        <form action="../signup_process.php" method="post">
            <!-- Username Field -->
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required />
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required />
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required />
            </div>

            <!-- Role Selection -->
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                    <option value="teacher">Lecturer</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>

        <!-- Login Link -->
        <p class="mt-3">
            Already have an account?
            <a href="login.php" class="text-primary">Login here</a>
        </p>
    </div>
</body>

</html>