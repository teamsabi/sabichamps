<?php
// Mulai sesi untuk mengambil email yang disimpan sebelumnya
session_start();

// Periksa apakah email ada di sesi
if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'Email tidak ditemukan dalam sesi']);
    exit;
}

$email = $_SESSION['email'];  // Ambil email yang sudah disimpan dalam sesi

// Ambil OTP dari request
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah OTP ada di request
if (!isset($data['otp'])) {
    echo json_encode(['status' => 'error', 'message' => 'OTP tidak disertakan']);
    exit;
}

$otp = $data['otp']; // Ambil OTP yang dikirimkan dari request

// Fungsi untuk verifikasi OTP berdasarkan email
function verifyOtpByEmail($email, $otp)
{
    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "sabi");

    if ($conn->connect_error) {
        return ['status' => 'error', 'message' => 'Koneksi ke database gagal'];
    }

    // Cari ID user berdasarkan email
    $query = "SELECT id_user FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email); // Binding email sebagai parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        return ['status' => 'error', 'message' => 'Email tidak ditemukan'];
    }

    $id_user = $result->fetch_assoc()['id_user'];

    // Cek OTP yang sesuai di tabel password_reset
    $stmt = $conn->prepare("SELECT otp_code, expires_at, status FROM password_reset WHERE id_user = ? AND status = 'pending' ORDER BY id_reset DESC LIMIT 1");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        return ['status' => 'error', 'message' => 'OTP tidak ditemukan atau sudah diverifikasi'];
    }

    $row = $result->fetch_assoc();
    if ($row['otp_code'] == $otp && strtotime($row['expires_at']) > time()) {
        // OTP valid, perbarui status menjadi 'verified'
        $stmt = $conn->prepare("UPDATE password_reset SET status = 'verified' WHERE id_user = ? AND otp_code = ?");
        $stmt->bind_param("is", $id_user, $otp);
        $stmt->execute();

        return ['status' => 'success', 'message' => 'OTP valid'];
    } else {
        return ['status' => 'error', 'message' => 'OTP tidak valid atau sudah kedaluwarsa'];
    }
}

// Panggil fungsi untuk memverifikasi OTP
$response = verifyOtpByEmail($email, $otp);

// Kirimkan respons ke client
echo json_encode($response);
