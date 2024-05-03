<?php
include 'koneksi.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $id_periksa = $_POST["id_periksa"];
    $id_pasien = $_POST["id_pasien"];
    $id_dokter = $_POST["id_dokter"];
    $tgl_periksa = $_POST["tgl_periksa"];
    $catatan = $_POST["catatan"];
    $obat = $_POST["obat"];

    // Update data in the database
    $update_query = "UPDATE periksa SET id_pasien='$id_pasien', id_dokter='$id_dokter', tgl_periksa='$tgl_periksa', catatan='$catatan', obat='$obat' WHERE id='$id_periksa'";
    if (mysqli_query($mysqli, $update_query)) {
        // Redirect back to periksa.php after successful update
        header("Location: index.php?page=periksa");
        exit(); // Make sure no other output is sent
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }
}

// Fetch current data of the selected periksa entry
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_periksa = $_GET['id'];
    $periksa_query = mysqli_query($mysqli, "SELECT * FROM periksa WHERE id='$id_periksa'");
    if(mysqli_num_rows($periksa_query) == 1) {
        $periksa_data = mysqli_fetch_assoc($periksa_query);
        $id_pasien = $periksa_data['id_pasien'];
        $id_dokter = $periksa_data['id_dokter'];
        $tgl_periksa = $periksa_data['tgl_periksa'];
        $catatan = $periksa_data['catatan'];
        $obat = $periksa_data['obat'];
    } else {
        // No periksa found with the given id, handle this case as needed
    }
} else {
    // No id parameter provided, handle this case as needed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Periksa</title>
    <!-- Link your CSS file here or use inline styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <br>
    <h2>Update Periksa</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group mx-sm-3 mb-2">
            <input type="hidden" name="id_periksa" value="<?php echo $id_periksa; ?>">
            <label for="id_pasien" class="sr-only">Pasien</label>
            <select class="form-control" name="id_pasien">
                <?php
                $pasien_query = mysqli_query($mysqli, "SELECT * FROM pasien");
                while ($data_pasien = mysqli_fetch_array($pasien_query)) {
                    $selected = ($data_pasien['id'] == $id_pasien) ? 'selected' : '';
                    echo "<option value='" . $data_pasien['id'] . "' $selected>" . $data_pasien['nama'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="id_dokter" class="sr-only">Dokter</label>
            <select class="form-control" name="id_dokter">
                <?php
                $dokter_query = mysqli_query($mysqli, "SELECT * FROM dokter");
                while ($data_dokter = mysqli_fetch_array($dokter_query)) {
                    $selected = ($data_dokter['id'] == $id_dokter) ? 'selected' : '';
                    echo "<option value='" . $data_dokter['id'] . "' $selected>" . $data_dokter['nama'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="tgl_periksa" class="sr-only">Tanggal Periksa</label>
            <input type="datetime-local" name="tgl_periksa" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($tgl_periksa)); ?>"><br><br>
            <label for="catatan" class="sr-only">Catatan</label>
            <input type="text" name="catatan" class="form-control" value="<?php echo $catatan; ?>" required><br><br>
            <label for="catatan" class="sr-only">Obat</label>
            <input type="text" name="obat" class="form-control" value="<?php echo $obat; ?>" required><br><br>
            <button type="submit" class="btn btn-primary">Ubah</button>
            <a href="index.php?page=periksa" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    </div>
</body>
</html>
