<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
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
        .register-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }
        .register-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: block;
            margin: 0 auto;
        }
        .register-card h2 {
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
        .form-control::placeholder {
            font-size: 14px;
        }
        .show-password {
            position: absolute;
            right: 10px;
            top: 74%;
            transform: translateY(-74%);
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

<?php
// Mulai sesi PHP dan sertakan file koneksi dan Auth
session_start();
require_once 'koneksi.php'; // File koneksi database
require_once 'Auth.php'; // File kelas Auth

$auth = new Auth($koneksi); // Inisialisasi kelas Auth
$error = '';
$success = '';

// Proses registrasi ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Coba registrasi dengan kelas Auth
    if ($auth->register($username, $email, $password)) {
        // Jika berhasil, simpan pesan sukses dan arahkan ke login
        $success = "Registrasi berhasil. Silakan login.";
        header("Location: login.php"); // Arahkan ke halaman login
        exit();
    } else {
        // Jika gagal, simpan pesan error
        $error = $auth->getLastError();
    }
}
?>

    <div class="register-card">
        <img src="assets/img/user.png" alt="User Icon">
        <h2>Register</h2>
        
        <!-- Menampilkan pesan error jika registrasi gagal -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- Menampilkan pesan sukses jika registrasi berhasil -->
        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Masukkan Username anda" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Masukkan Email anda" required>
            </div>
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="passwordField" name="password" placeholder="Masukkan Kata Sandi" required>
                <span class="show-password" id="togglePassword">Show</span>
            </div>
            <button type="submit" class="btn btn-custom">Daftar</button>
            <p class="text-center text-small mt-3">Sudah Punya Akun? <a href="login.php">Masuk</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('passwordField');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.textContent = this.textContent === 'Show' ? 'Hide' : 'Show';
        });
    </script>
</body>
</html>
