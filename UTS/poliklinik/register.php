<?php
include_once("koneksi.php");

$success_message = ""; // Initialize success message variable
$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['username']; // Corrected to match input field name
    $password = $_POST['password'];

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $check_query = "SELECT * FROM users WHERE nama = '$nama'";
    $check_result = mysqli_query($mysqli, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        // Username already exists, show error message
        $error_message = "Username already exists. Please choose a different username.";
    } else {
        // Insert the new user into the database
        $insert_query = "INSERT INTO users (nama, password) VALUES ('$nama', '$hashed_password')";
        if (mysqli_query($mysqli, $insert_query)) {
            // Registration successful, set success message
            $success_message = "Account registered successfully.";
        } else {
            // Error occurred while registering user
            $error_message = "Error registering user. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-center">Register</h3>
                </div>
                <div class="card-body">
                    <?php if ($success_message !== ""): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($error_message !== ""): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
