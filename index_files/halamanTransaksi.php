<?php
session_start();
if (!isset($_SESSION['id_pegawai'])) { // Cek session id_pegawai
    header("Location: halamanLogin.php");
    exit;
}

include 'koneksiPHPDB.php';

// Ambil semua transaksi
$stmt = $koneksi->prepare("SELECT * FROM transaksi");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Transaksi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal Transaksi</th>
                    <th>Deskripsi</th>
                    <th>Grand Total</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($transaksi = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $transaksi['id_transaksi']; ?></td>
                        <td><?= $transaksi['tanggal_transaksi']; ?></td>
                        <td><?= $transaksi['deskripsi_transaksi']; ?></td>
                        <td>Rp. <?= $transaksi['grandTotal_transaksi']; ?></td>
                        <td><a href="halamanDetailTransaksi.php?id=<?= $transaksi['id_transaksi']; ?>" class="btn" style="background-color: #E2725B">Detail</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
