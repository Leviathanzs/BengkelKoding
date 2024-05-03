<?php
include 'koneksi.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $id_pasien = $_POST["id_pasien"];
    $id_dokter = $_POST["id_dokter"];
    $tgl_periksa = $_POST["tgl_periksa"];
    $catatan = $_POST["catatan"];
    $obat = $_POST["obat"];

    // Validate and sanitize the data if needed (you may add more validation as per your requirements)

    // Insert data into the database
    $insert_query = "INSERT INTO periksa (id_pasien, id_dokter, tgl_periksa, catatan, obat) VALUES ('$id_pasien', '$id_dokter', '$tgl_periksa', '$catatan', '$obat')";
    if (mysqli_query($mysqli, $insert_query)) {
        // Redirect to periksa.php
        header("Location: index.php?page=periksa");
        exit(); // Make sure no other output is sent
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($mysqli);
    }
}

