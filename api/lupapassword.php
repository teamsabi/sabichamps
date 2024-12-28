<?php
session_start();
// Menggunakan PHPMailer untuk mengirim email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'connection.php';

function sendOtp($email)
{
    // Cek apakah email ada di database
    $conn = new mysqli("localhost", "root", "", "sabi");
    if ($conn->connect_error) {
        return ['status' => 'error', 'message' => 'Koneksi ke database gagal'];
    }

    $query = "SELECT id_user FROM user WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        return ['status' => 'error', 'message' => 'Email tidak ditemukan'];
    }

    // Generate OTP
    $otp = rand(10000, 99999);
    $expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes')); // OTP valid selama 5 menit
    $id_user = $result->fetch_assoc()['id_user'];

    // Simpan OTP dan waktu kadaluarsa ke database
    $stmt = $conn->prepare("INSERT INTO password_reset (id_user, otp_code, expires_at, status) VALUES (?, ?, ?, 'pending')");
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
    }
}

// Cek apakah data dikirim dalam format JSON atau x-www-form-urlencoded
$inputData = json_decode(file_get_contents("php://input"), true); // Untuk JSON

if (!$inputData) {
    // Jika bukan format JSON, coba ambil dari $_POST (x-www-form-urlencoded)
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $response = sendOtp($email);
        echo json_encode($response);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email tidak disertakan']);
    }
} else {
    // Jika format JSON
    if (isset($inputData['email'])) {
        $email = $inputData['email'];
        $response = sendOtp($email);
        echo json_encode($response);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email tidak disertakan']);
    }
}
