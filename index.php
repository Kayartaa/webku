<?php
include '../config/db.php';
$data = mysqli_query($conn, "SELECT * FROM tb_inventory");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventory Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-3">Data Inventory Barang</h2>
    <a href="add.php" class="btn btn-success mb-3">+ Tambah Barang</a>
    <table class="table table-bordered" id="dataTable">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $row['kode_barang'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td><?= $row['jumlah_barang'] ?></td>
                <td><?= $row['satuan_barang'] ?></td>
                <td>Rp <?= number_format($row['harga_beli'], 0, ',', '.') ?></td>
                <td><?= $row['status_barang'] ? 'Available' : 'Not Available' ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_barang'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['id_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    <a href="use.php?id=<?= $row['id_barang'] ?>" class="btn btn-primary btn-sm">Gunakan</a>
                    <a href="increase.php?id=<?= $row['id_barang'] ?>" class="btn btn-info btn-sm">Tambah Stok</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
    $('#dataTable').DataTable();
});
</script>
</body>
</html>