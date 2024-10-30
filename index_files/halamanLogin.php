<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pegawai - Toko Kue Sanca</title>
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
        .login-box {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box col-md-4">
        <h2 class="text-center">Pegawai Toko Kue Sanca</h2>
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']); 
        }
        ?>
        <form action="verifLogin.php" method="POST">
            <div class="form-group mb-3">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn w-100" style="background-color: #E2725B">Login</button>
            <div class="text-center mt-3">
                <a href="halamanRegister.php" style="color: #000000">Belum punya akun? Register di sini</a>
            </div>
        </form>
    </div>
</body>
</html>