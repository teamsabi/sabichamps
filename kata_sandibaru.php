<?php
require './admin/helper/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'], $_POST['confirm_password'], $_POST['id_user'])) {
    try {
        $id_user = $_POST['id_user'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($new_password) || empty($confirm_password)) {
            die("<script>alert('Kata sandi tidak boleh kosong.');</script>");
        }

        if ($new_password !== $confirm_password) {
            die("<script>alert('Kata sandi dan konfirmasi kata sandi tidak cocok.');</script>");
        }

        if (strlen($new_password) < 6) {
            die("<script>alert('Kata sandi harus minimal 6 karakter.');</script>");
        }

        $updateQuery = $koneksi->prepare("UPDATE user SET password = :password WHERE id_user = :id_user");
        $updateQuery->bindParam(':password', $new_password);
        $updateQuery->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $updateQuery->execute();

        echo "<script>alert('Kata sandi berhasil diubah.'); window.location.href = 'login.php';</script>";
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kata Sandi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #239D9F;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .password-container {
            background-color: white;
            padding: 38px;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
        }
        h2 {
            font-weight: 600;
            margin-bottom: 15px;
        }
        p {
            color: gray;
            margin-top: 5px;
            margin-bottom: 25px;
            font-size: 15px;
            line-height: 1.5;
        }
        .form-control {
            border-radius: 12px;
            height: 50px;
            font-size: 16px;
            margin-bottom: 25px;
        }
        .password-field {
            position: relative;
        }
        .password-field input {
            padding-right: 45px;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .btn-primary {
            background-color: #229799;
            border: none;
            width: 100%;
            height: 50px;
            border-radius: 12px;
            margin-top: 20px;
            font-size: 18px;
        }
        .btn-primary:hover {
            background-color: #1e8888;
        }
    </style>
</head>
<body>
    <div class="password-container text-justify">
        <h2>Kata Sandi Baru</h2>
        <p>Masukkan kata sandi baru Anda</p>

        <!-- Form untuk mengubah kata sandi -->
        <form method="POST" action="">
            <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($id_user); ?>">
            
            <!-- Input Kata Sandi Baru -->
            <div class="mb-4">
                <label for="newPassword">Kata Sandi Baru</label>
                <div class="password-field">
                    <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="Kata Sandi Baru" required>
                    <span class="toggle-password" onclick="togglePassword('newPassword')">
                        <img src="https://img.icons8.com/ios-filled/24/000000/visible.png" alt="Toggle Password">
                    </span>
                </div>
            </div>

            <!-- Input Konfirmasi Kata Sandi -->
            <div class="mb-4">
                <label for="confirmPassword">Konfirmasi Kata Sandi</label>
                <div class="password-field">
                    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Konfirmasi Kata Sandi" required>
                    <span class="toggle-password" onclick="togglePassword('confirmPassword')">
                        <img src="https://img.icons8.com/ios-filled/24/000000/visible.png" alt="Toggle Password">
                    </span>
                </div>
            </div>

            <p class="text-justify">Kata sandi harus berisi minimal 6 karakter dengan kombinasi huruf dan angka.</p>

            <button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const passwordInput = document.getElementById(id);
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }
    </script>
</body>
</html>
