<?php
include 'koneksi.php';
include 'index.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    // Update query
    $update_query = "UPDATE dokter SET nama='$nama', alamat='$alamat', no_hp='$no_hp' WHERE id=$id";

    // Execute the update query
    if(mysqli_query($mysqli, $update_query)) {
        // If the update is successful, redirect back to the dokter.php page
        header("Location: index.php?page=dokter");
        exit();
    } else {
        // If an error occurs during update, display an error message
        echo "Error updating record: " . mysqli_error($mysqli);
    }
}

// Fetch the current record to pre-fill the update form
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($mysqli, "SELECT * FROM dokter WHERE id=$id");

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $no_hp = $row['no_hp'];
    } else {
        // If no record found, display an error message or handle it accordingly
        echo "Record not found";
        exit();
    }
} else {
    // If no ID parameter is provided, display an error message or handle it accordingly
    echo "Invalid request";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update Dokter</title>
</head>
<body>
    <div class="container">
        <br>
        <h2>Update Dokter</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?php echo $alamat; ?>" required>
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="<?php echo $no_hp; ?>">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Ubah</button>
            <a href="index.php?page=dokter" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <br>
</body>
</html>
