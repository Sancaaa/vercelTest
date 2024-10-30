<?php
session_start();
include 'koneksiPHPDB.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_pegawai = $_POST['username'];
    $password_pegawai = $_POST['password'];


    $stmt = $koneksi->prepare("SELECT * FROM pegawai WHERE username_pegawai = ?");
    $stmt->bind_param("s", $username_pegawai);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pegawai = $result->fetch_assoc();

        if (password_verify($password_pegawai, $pegawai['password_pegawai'])) {
            $_SESSION['username_pegawai'] = $pegawai['username_pegawai'];
            $_SESSION['password_pegawai'] = $pegawai['password_pegawai'];
            
            echo "Session berhasil disimpan. Mengarahkan ke halaman transaksi...";
            header("Location: halamanTransaksi.php");
            exit; 
        } else {
            echo "<script>
                alert('Password salah!');
                window.location.href = 'halamanLogin.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Username tidak ditemukan!');
            window.location.href = 'halamanLogin.php';
        </script>";
    }
}

$koneksi->close();
?>
