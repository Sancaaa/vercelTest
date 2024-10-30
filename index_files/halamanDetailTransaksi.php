<?php
session_start();
if (!isset($_SESSION['id_pegawai'])) {
    header("Location: halamanLogin.php");
    exit;
}

include 'koneksiPHPDB.php';

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];

    // Ambil detail transaksi dari tabel transaksi
    $stmt = $koneksi->prepare("
        SELECT t.*, c.nama_customer, p.nama_pegawai 
        FROM transaksi t
        LEFT JOIN customer c ON t.id_customer = c.id_customer
        LEFT JOIN pegawai p ON t.id_pegawai = p.id_pegawai
        WHERE t.id_transaksi = ?
    ");
    $stmt->bind_param("s", $id_transaksi);
    $stmt->execute();
    $result = $stmt->get_result();
    $transaksi = $result->fetch_assoc();

    if (!$transaksi) {
        echo "Transaksi tidak ditemukan!";
        exit;
    }

    // Ambil detail items dari tabel detailtransaksi
    $stmt = $koneksi->prepare("
        SELECT dt.*, k.nama_kue 
        FROM detailTransaksi dt
        LEFT JOIN kue k ON dt.id_kue = k.id_kue
        WHERE dt.id_transaksi = ?
    ");
    $stmt->bind_param("s", $id_transaksi);
    $stmt->execute();
    $detail_result = $stmt->get_result();
} else {
    echo "ID transaksi tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Detail Transaksi</h2>
        
        <!-- Informasi Transaksi -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Informasi Transaksi</h4>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">ID Transaksi: <?= htmlspecialchars($transaksi['id_transaksi']); ?></li>
                    <li class="list-group-item">Tanggal: <?= htmlspecialchars(date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi']))); ?></li>
                    <li class="list-group-item">Customer: <?= htmlspecialchars($transaksi['nama_customer']); ?></li>
                    <li class="list-group-item">Pegawai: <?= htmlspecialchars($transaksi['nama_pegawai']); ?></li>
                    <li class="list-group-item">Total Transaksi: Rp <?= number_format($transaksi['grandTotal_transaksi'], 2, ',', '.'); ?></li>
                    <li class="list-group-item">Deskripsi: <?= htmlspecialchars($transaksi['deskripsi_transaksi']); ?></li>
                </ul>
            </div>
        </div>

        <!-- Detail Items -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Detail Items</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Kue</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($detail = $detail_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($detail['nama_kue']); ?></td>
                            <td>Rp <?= number_format($detail['harga_kue'], 2, ',', '.'); ?></td>
                            <td><?= $detail['jumlah']; ?></td>
                            <td>Rp <?= number_format($detail['subTotal_transaksi'], 2, ',', '.'); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <a href="halamanTransaksi.php" class="btn" style="background-color: #E2725B">Kembali ke Daftar Transaksi</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>