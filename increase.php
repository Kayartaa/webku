<?php
include '../config/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $data = mysqli_query($conn, "SELECT * FROM tb_inventory WHERE id_barang = $id");
    $row = mysqli_fetch_assoc($data);

    // Tambahkan jumlah
    $jumlah_baru = $row['jumlah_barang'] + 1;

    // Status otomatis aktif karena barang bertambah
    $status = 1;

    $update = mysqli_query($conn, "UPDATE tb_inventory SET jumlah_barang = $jumlah_baru, status_barang = $status WHERE id_barang = $id");

    if ($update) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal menambah stok'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid'); window.location.href='index.php';</script>";
}
?>