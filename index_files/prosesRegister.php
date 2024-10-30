<?php
include 'koneksiPHPDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_pegawai = $_POST['nama_pegawai'];
    $email_pegawai = $_POST['email_pegawai'];
    $noTelp_pegawai = $_POST['noTelp_pegawai'];
    $alamat_pegawai = $_POST['alamat_pegawai'];
    $username_pegawai = $_POST['username_pegawai'];
    $password_pegawai = $_POST['password_pegawai'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi password
    if ($password_pegawai !== $confirm_password) {
        echo "Password tidak cocok!";
        exit;
    }

    // Cek apakah username sudah ada
    $stmt = $koneksi->prepare("SELECT * FROM pegawai WHERE username_pegawai = ?");
    $stmt->bind_param("s", $username_pegawai);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username sudah digunakan!";
        exit;
    }

    // Generate ID pegawai (format: PGW001, PGW002, dst)
    $query = "SELECT MAX(SUBSTRING(id_pegawai, 4)) as max_id FROM pegawai";
    $result = $koneksi->query($query);
    $row = $result->fetch_assoc();
    $last_id = $row['max_id'];
    $next_id = str_pad(($last_id + 1), 3, '0', STR_PAD_LEFT);
    $id_pegawai = 'PGW' . $next_id;

    // Hash password
    $hashed_password = password_hash($password_pegawai, PASSWORD_DEFAULT);

    // Insert data ke database
    $stmt = $koneksi->prepare("INSERT INTO pegawai (id_pegawai, nama_pegawai, email_pegawai, noTelp_pegawai, alamat_pegawai, username_pegawai, password_pegawai) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $id_pegawai, $nama_pegawai, $email_pegawai, $noTelp_pegawai, $alamat_pegawai, $username_pegawai, $hashed_password);

    if ($stmt->execute()) {
        header("Location: halamanLogin.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$koneksi->close();
?>