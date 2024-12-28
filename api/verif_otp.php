<?php
// Koneksi ke database
require_once 'connection.php';

// Mendapatkan email dan OTP yang dikirimkan oleh aplikasi
$email = $_POST['email'];
$otp = $_POST['otp'];

// Validasi email dan OTP
if (empty($email) || empty($otp)) {
    echo json_encode(["server_response" => "Email dan OTP harus diisi"]);
    exit;
}

// Cek apakah OTP yang dimasukkan cocok dengan yang ada di database
$query = "SELECT * FROM otp_verification WHERE email = ? AND otp = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $email, $otp);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["server_response" => "OTP berhasil diverifikasi"]);
} else {
    echo json_encode(["server_response" => "OTP salah atau tidak valid"]);
}

$stmt->close();
$conn->close();
