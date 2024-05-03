<?php
@session_start();
include_once("koneksi.php");

$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['username']; // Corrected to match input field name
    $password = $_POST['password'];

    // Hash the provided password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Retrieve the hashed password from the database
    $query = "SELECT password FROM users WHERE nama = '$nama'";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        // Verify the hashed password
        if (password_verify($password, $stored_password)) {
            // Password is correct, set session variable
            $_SESSION['username'] = $nama;
            // Redirect to home page with success message
            header("Location: index.php?login=success");
            exit();
        } else {
            // Password is incorrect, set error message
            $error_message = "Invalid username or password";
        }
    } else {
        // User not found, set error message
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z5vIOIqaqoaFjN+6K3gJw9xg21fgmOBGJhGzF" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error_message)): ?>
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
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-sfwn/xR2eZMjsEn9/kkzoybzjIMp7HCCKiKXBfQPTQgjRvKLdMBlCXSm5ZwOE0i+" crossorigin="anonymous"></script>
</body>
</html>
