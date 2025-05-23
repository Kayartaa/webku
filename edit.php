<?php
include '../config/db.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM tb_inventory WHERE id_barang = $id");
$row = mysqli_fetch_assoc($data);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah_barang'];
    $satuan = $_POST['satuan_barang'];
    $harga = $_POST['harga_beli'];
    $status = $_POST['status_barang'];

    $query = "UPDATE tb_inventory SET 
              kode_barang='$kode', nama_barang='$nama', jumlah_barang=$jumlah,
              satuan_barang='$satuan', harga_beli=$harga, status_barang=$status 
              WHERE id_barang = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Gagal mengupdate: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Barang</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" class="form-control" value="<?= $row['kode_barang'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="<?= $row['nama_barang'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah_barang" class="form-control" value="<?= $row['jumlah_barang'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Satuan</label>
            <input type="text" name="satuan_barang" class="form-control" value="<?= $row['satuan_barang'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Harga Beli</label>
            <input type="number" step="0.01" name="harga_beli" class="form-control" value="<?= $row['harga_beli'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Status</label><br>
            <input type="radio" name="status_barang" value="1" <?= $row['status_barang'] == 1 ? 'checked' : '' ?>> Available
            <input type="radio" name="status_barang" value="0" <?= $row['status_barang'] == 0 ? 'checked' : '' ?>> Not Available
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>