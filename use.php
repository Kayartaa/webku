<?php
include '../config/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $data = mysqli_query($conn, "SELECT * FROM tb_inventory WHERE id_barang = $id");
    $row = mysqli_fetch_assoc($data);

    if ($row['jumlah_barang'] > 0) {
        $jumlah_baru = $row['jumlah_barang'] - 1;
        $status = ($jumlah_baru == 0) ? 0 : 1;

        mysqli_query($conn, "UPDATE tb_inventory SET jumlah_barang = $jumlah_baru, status_barang = $status WHERE id_barang = $id");
        header("Location: index.php");
    } else {
        echo "<script>alert('Stok habis!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid'); window.location.href='index.php';</script>";
}
?>