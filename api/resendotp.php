<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Set header untuk respons JSON
header('Content-Type: application/json');

// Fungsi untuk mengirim OTP
function sendOtp($email)
{
    // Koneksi ke database
    $con = new mysqli("127.0.0.1", "root", "", "sabi_db");
    if ($con->connect_error) {
        return ['status' => 'error', 'message' => 'Koneksi ke database gagal'];
    }

    // Bersihkan email untuk menghindari SQL Injection
    $email = $con->real_escape_string($email);

    // Cek apakah email ada di database
    $query = "SELECT id_user FROM user WHERE email = '$email'";
    $result = $con->query($query);

    if ($result->num_rows == 0) {
        return ['status' => 'error', 'message' => 'Email tidak ditemukan di database'];
    }

    // Generate OTP
    $otp = rand(10000, 99999);
    $expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes')); // OTP valid selama 5 menit
    $id_user = $result->fetch_assoc()['id_user'];

    // Simpan OTP ke database
    $stmt = $con->prepare("INSERT INTO password_reset (id_user, otp_code, expires_at, status) VALUES (?, ?, ?, 'pending') 
            ON DUPLICATE KEY UPDATE otp_code = VALUES(otp_code), expires_at = VALUES(expires_at), status = 'pending'");
    $stmt->bind_param("iss", $id_user, $otp, $expires_at);
    $stmt->execute();

    // Kirim OTP ke email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sabiteam23@gmail.com';      // Ganti dengan email Anda
        $mail->Password   = 'rrry yitu mhpl krui';      // Ganti dengan app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('sabiteam23@gmail.com', 'Team Sabi');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Kode OTP untuk Reset Password';
        $mail->Body    = 'Kode OTP Anda adalah: ' . $otp;

        $mail->send();
        return ['status' => 'success', 'message' => 'OTP berhasil dikirim'];
    } catch (Exception $e) {
        return ['status' => 'error', 'message' => 'Pengiriman email gagal: ' . $mail->ErrorInfo];
    } finally {
        // Menutup koneksi database jika sudah selesai
        if ($con) {
            $con->close();
        }
    }
}

// Ambil email dari sesi atau input POST
$email = !empty($_SESSION['email']) ? $_SESSION['email'] : (!empty($_POST['email']) ? $_POST['email'] : null);

// Cek apakah email ditemukan
if ($email) {
    $response = sendOtp($email);
    echo json_encode($response);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Email tidak ditemukan di sesi atau input']);
}
