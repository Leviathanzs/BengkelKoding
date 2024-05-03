<?php
    include 'koneksi.php';

    // Check if the ID parameter is provided and is a valid integer
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        // Prepare the SQL statement to delete the record
        $id = $_GET['id'];
        $delete_query = "DELETE FROM pasien WHERE id = $id";

        // Execute the delete query
        if(mysqli_query($mysqli, $delete_query)) {
            // If the deletion is successful, redirect back to the dokter.php page
            header("Location: index.php?page=pasien");
            exit();
        } else {
            // If an error occurs during deletion, display an error message
            echo "Error deleting record: " . mysqli_error($mysqli);
        }

        // Close the database connection
        mysqli_close($mysqli);
    } else {
        // If the ID parameter is missing or invalid, redirect back to the dokter.php page
        header("Location: index.php?page=pasien");
        exit();
    }
