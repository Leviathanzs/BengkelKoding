<?php
include 'koneksi.php';

// Check if ID parameter is set in the URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    // Sanitize the ID parameter to prevent SQL injection
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Construct DELETE query
    $delete_query = "DELETE FROM periksa WHERE id = '$id'";

    // Execute DELETE query
    if (mysqli_query($mysqli, $delete_query)) {
        // Redirect back to periksa.php after successful deletion
        header("Location: index.php?page=periksa");
        exit(); // Make sure no other output is sent
    } else {
        echo "Error deleting record: " . mysqli_error($mysqli);
    }
} else {
    echo "ID parameter is missing or invalid.";
}

