<?php
@session_start();

// Function to check if the user is logged in
function check_login() {
    if (!isset($_SESSION['username'])) {
        // User is not logged in, redirect to login page
        header("Location: index.php?page=login");
        exit();
    }
}
?>
