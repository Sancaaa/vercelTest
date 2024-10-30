<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pegawai - Toko Kue Sanca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://static.vecteezy.com/system/resources/thumbnails/000/149/782/small_2x/outline-tiramisu-cake-pattern-free-vector.jpg');
            background-size: cover; 
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-box {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="register-box col-md-6">
        <h2 class="text-center">Register Pegawai - Toko Kue Sanca</h2>
        <form action="prosesRegister.php" method="POST">
            <div class="form-group mb-3">
                <label for="nama_pegawai">Nama:</label>
                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" required>
            </div>
            <div class="form-group mb-3">
                <label for="email_pegawai">Email:</label>
                <input type="email" class="form-control" id="email_pegawai" name="email_pegawai" required>
            </div>
            <div class="form-group mb-3">
                <label for="noTelp_pegawai">No. Telepon:</label>
                <input type="text" class="form-control" id="noTelp_pegawai" name="noTelp_pegawai" required>
            </div>
            <div class="form-group mb-3">
                <label for="alamat_pegawai">Alamat:</label>
                <textarea class="form-control" id="alamat_pegawai" name="alamat_pegawai" required></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="username_pegawai">Username:</label>
                <input type="text" class="form-control" id="username_pegawai" name="username_pegawai" required>
            </div>
            <div class="form-group mb-3">
                <label for="password_pegawai">Password:</label>
                <input type="password" class="form-control" id="password_pegawai" name="password_pegawai" required>
            </div>
            <div class="form-group mb-3">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn w-100" style="background-color: #E2725B">Register</button>
            <div class="text-center mt-3">
                <a href="halamanLogin.php" style="color: #000000">Sudah punya akun? Login di sini</a>
            </div>
        </form>
    </div>
</body>
</html>