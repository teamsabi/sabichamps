<?php
require 'koneksi.php'; // Koneksi ke database
require 'vendor2/autoload.php'; // Pastikan PHPMailer sudah diinstal dan autoload tersedia

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Cek apakah email terdaftar di database
    $stmt = $koneksi->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
        // Generate OTP dan waktu kedaluwarsa
        $otp_code = rand(10000, 99999);
        $expires_at = date("Y-m-d H:i:s", strtotime('+15 minutes')); // OTP berlaku selama 15 menit

        // Simpan OTP di tabel password_resets
        $stmt = $koneksi->prepare("INSERT INTO password_resets (email, otp_code, expires_at, status) VALUES (:email, :otp_code, :expires_at, 'pending')");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':otp_code', $otp_code);
        $stmt->bindParam(':expires_at', $expires_at);
        $stmt->execute();

        // Konfigurasi PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Konfigurasi server SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP server Anda
            $mail->SMTPAuth = true;
            $mail->Username = 'sabiteam23@gmail.com'; // Ganti dengan email Anda
            $mail->Password = 'rrry yitu mhpl krui'; // Ganti dengan password email Anda
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Pengaturan email
            $mail->setFrom('sabiteam23@gmail.com', 'Team Sabi');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP untuk Reset Kata Sandi Anda';
            $mail->Body = "<p>Hai,</p><p>Gunakan kode OTP berikut untuk mengatur ulang kata sandi Anda:</p><h2>$otp_code</h2><p>Kode ini hanya berlaku selama 15 menit.</p>";

            $mail->send();
            // Tampilkan pesan SweetAlert jika OTP berhasil dikirim
            $response = "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Email Terkirim!',
                                text: 'OTP berhasil dikirim ke email Anda. Silakan cek email Anda.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'inputOTP.php'; // Redirect ke halaman input OTP
                            });
                         </script>";
        } catch (Exception $e) {
            $response = "<script>Swal.fire('Gagal!', 'Pengiriman email gagal: {$mail->ErrorInfo}', 'error');</script>";
        }
    } else {
        $response = "<script>Swal.fire('Gagal!', 'Email tidak terdaftar.', 'error');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2c939e;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 470px;
            width: 100%;
        }
        .btn-custom {
            background-color: #229799;
            color: white;
            border: none;
            border-radius: 30px;
            width: 150px;
        }
        .btn-custom:hover {
            background-color: #257b85;
        }
        .form-control::placeholder {
            color: #999;
        }
        .text-justify {
            text-align: justify;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card p-4">
                <div class="card-body text-center">
                    <h3 class="card-title text-justify fw-bold">Lupa Kata Sandi</h3>
                    <p class="text-muted text-justify">Silahkan masukkan alamat email Anda di bawah ini untuk mengubah kata sandi Anda</p>
                    <form method="POST" action="">
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email Anda" required>
                        </div>
                        <div class="d-flex justify-content-evenly">
                            <button type="button" class="btn btn-custom" onclick="window.history.back()">Kembali</button>
                            <button type="submit" class="btn btn-custom">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
// Tampilkan response setelah pengiriman email
echo $response;
?>
</body>
</html>
