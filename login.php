<?php
// Mulai sesi PHP dan sertakan file koneksi dan Auth
session_start();
require_once 'koneksi.php'; // File koneksi database
require_once 'Auth.php'; // File kelas Auth

$auth = new Auth($koneksi); // Inisialisasi kelas Auth
$error = '';

// Proses login ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Coba login dengan kelas Auth
    if ($auth->login($email, $password)) {
        // Jika berhasil, arahkan ke dashboard
        header("Location: admin/dashboard.php");
        exit();
    } else {
        // Jika gagal, simpan pesan error
        $error = $auth->getLastError();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #229799;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }
        .login-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }
        .login-card h2 {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 24px;
        }
        .form-control {
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .btn-custom {
            background-color: #229799;
            color: white;
            width: 100%;
            border-radius: 25px;
            padding: 10px;
        }
        .btn-custom:hover {
            background-color: #229799;
        }
        .text-small {
            font-size: 14px;
            color: #6c757d;
        }
        .text-small a {
            color: #229799;
            text-decoration: none;
        }
        .text-small a:hover {
            text-decoration: underline;
        }
        .form-text-right {
            text-align: right;
        }
        .form-control::placeholder {
            font-size: 14px;
        }
        .show-password {
            position: absolute;
            right: 10px;
            top: 45%;
            transform: translateY(-45%);
            cursor: pointer;
            font-size: 14px;
            color: #229799;
            line-height: 1;
        }
        .position-relative {
            position: relative;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <img src="assets2/img/user.png" alt="User Icon">
        <h2>Login</h2>
        <!-- Menampilkan pesan error jika login gagal -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Masukkan Email anda" required>
    </div>
    <div class="mb-3 position-relative">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi" required>
        <span class="show-password" id="togglePassword">Show</span>
        <div class="form-text form-text-right">
            <a href="lupa_password.php">Lupa Kata Sandi</a>
        </div>
    </div>
    <button type="submit" class="btn btn-custom" id="submit">Masuk</button>
    <p class="text-center text-small mt-3">Belum Punya Akun? <a href="register.php">Daftar</a></p>
</form>

    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Show' : 'Hide';
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
