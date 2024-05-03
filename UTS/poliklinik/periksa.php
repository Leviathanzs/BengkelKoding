<?php
include 'koneksi.php';
include_once("sessionCheck.php");

check_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
<form action="createPeriksa.php" method="post">
<div class="form-group mx-sm-3 mb-2">
    <label for="inputPasien" class="sr-only">Pasien</label>
    <select class="form-control" name="id_pasien">
        <?php
        $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
        while ($data = mysqli_fetch_array($pasien)) {
            ?>
            <option value="<?php echo $data['id'] ?>"><?php echo $data['nama'] ?></option>
            <?php
        }
        ?>
    </select>
    <label for="inputDokter" class="sr-only">Dokter</label>
    <select class="form-control" name="id_dokter">
        <?php
        $dokter = mysqli_query($mysqli, "SELECT * FROM dokter");
        while ($data = mysqli_fetch_array($dokter)) {
            ?>
            <option value="<?php echo $data['id'] ?>"><?php echo $data['nama'] ?></option>
            <?php
        }
        ?>
    </select>
    <label for="inputTanggal" class="sr-only">Tanggal Periksa</label>
    <br>
    <input type="datetime-local" name="tgl_periksa" class="form-control">

    <div class="form-group">
        <label>Catatan</label>
        <input type="text" name="catatan" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Obat</label>
        <input type="text" name="obat" class="form-control" required>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    </div>
    <!-- Display existing periksa entries -->
    <h2>Daftar Periksa</h2>
    <table class="table">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Nama Pasien</th>
                <th>Tanggal Periksa</th>
                <th>Catatan</th>
                <th>Obat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($mysqli, "SELECT pr.*, d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
            $counter = 1;
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr class='text-center'>";
                echo "<td>" . $counter++ . "</td>";
                echo "<td>" . $row['nama_dokter'] . "</td>";
                echo "<td>" . $row['nama_pasien'] . "</td>";
                echo "<td>" . $row['tgl_periksa'] . "</td>";
                echo "<td>" . $row['catatan'] . "</td>";
                echo "<td>" . $row['obat'] . "</td>";
                // Add buttons for updating and deleting
                echo "<td class='text-center'>
                <a href='updatePeriksa.php?id=".$row['id']."' class='btn btn-sm btn-primary'>Ubah</a>
                <a href='deletePeriksa.php?id=".$row['id']."' class='btn btn-sm btn-danger'>Hapus</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
