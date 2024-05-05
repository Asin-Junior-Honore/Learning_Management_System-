<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>🎉🧑‍💻👨‍💻</title>

    <style>
        .error {
            color: red;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <?php
    // Display error message if login failed or invalid role
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error === 'invalid_credentials') {
            echo "<p class='error'>Invalid username or password.</p>";
        } elseif ($error === 'invalid_role') {
            echo "<p class='error'>Invalid role selected.</p>";
        }
    }
    ?>
    <div class="container mt-4">
        <h2>Login</h2>
        <form action="../login_process.php" method="post">
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

            <!-- Role Selection -->
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                    <option value="teacher">lecturer</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <!-- Signup Link -->
        <p class="mt-3">
            Don't have an account?
            <a href="signup.php" class="text-primary">Sign up here</a>
        </p>
    </div>
</body>

</html>