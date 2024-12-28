<?php
// Mulai sesi untuk mengambil email yang disimpan sebelumnya
session_start();

// Fungsi untuk memeriksa apakah OTP sudah diverifikasi
function checkOtpVerified($id_user, $conn)
{
    // Cek status OTP untuk memastikan bahwa OTP sudah diverifikasi
    $stmt = $conn->prepare("SELECT status FROM password_reset WHERE id_user = ? AND status = 'verified' ORDER BY id_reset DESC LIMIT 1");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        return false; // OTP belum diverifikasi
    }

    return true; // OTP sudah diverifikasi
}

// Fungsi untuk mengubah password
function changePassword($new_password)
{
    // Periksa apakah password baru ada dan valid
    if (empty($new_password)) {
        echo json_encode(['status' => 'error', 'message' => 'Password baru tidak boleh kosong']);
        exit;
    }

    // Periksa apakah email ada di sesi
    if (!isset($_SESSION['email'])) {
        echo json_encode(['status' => 'error', 'message' => 'Email tidak ditemukan dalam sesi']);
        exit;
    }

    $email = $_SESSION['email'];  // Ambil email yang sudah disimpan dalam sesi

    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "sabi");

    // Periksa apakah koneksi ke database berhasil
    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Koneksi ke database gagal']);
        exit;
    }

    // Cari ID user berdasarkan email
    $query = "SELECT id_user FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email tidak ditemukan']);
        exit;
    }

    $id_user = $result->fetch_assoc()['id_user'];

    // Panggil fungsi checkOtpVerified untuk memverifikasi OTP
    if (!checkOtpVerified($id_user, $conn)) {
        echo json_encode(['status' => 'error', 'message' => 'OTP belum diverifikasi']);
        exit;
    }

    // Hash password baru
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update password di database
    $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id_user = ?");
    $stmt->bind_param("si", $hashed_password, $id_user);

    if ($stmt->execute()) {
        // Kirimkan respon sukses
        echo json_encode(['status' => 'success', 'message' => 'Password berhasil diubah']);
    } else {
        // Jika terjadi kesalahan dalam eksekusi query
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengubah password']);
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
}

// Menentukan jenis data yang diterima (x-www-form-urlencoded atau raw JSON)
if ($_SERVER['CONTENT_TYPE'] == "application/x-www-form-urlencoded") {
    // Jika data dikirim dengan x-www-form-urlencoded
    if (isset($_POST['new_password'])) {
        changePassword($_POST['new_password']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Password baru tidak disertakan']);
    }
} elseif ($_SERVER['CONTENT_TYPE'] == "application/json" || strpos($_SERVER['CONTENT_TYPE'], "application/json") !== false) {
    // Jika data dikirim dengan raw JSON
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['new_password'])) {
        changePassword($data['new_password']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Password baru tidak disertakan']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Tipe konten tidak didukung']);
}
