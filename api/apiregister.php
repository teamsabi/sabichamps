<?php
header('Content-Type: application/json');
error_reporting(0);
ob_start(); // Memastikan hanya JSON yang dikembalikan

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sab_baru";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi database
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Koneksi database gagal: " . $conn->connect_error]);
    exit;
}

// Ambil data input dari request POST
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$kode_kelas = $_POST['kode_kelas'] ?? '';

// Validasi input
if (empty($email) || empty($password) || empty($kode_kelas)) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Harap isi semua kolom."]);
    exit;
}

// Validasi kode_kelas di database
$sql_check_kelas = "SELECT kode_kelas FROM kelas WHERE kode_kelas = ?";
$stmt_check = $conn->prepare($sql_check_kelas);
$stmt_check->bind_param("s", $kode_kelas);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows == 0) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Kode kelas tidak valid."]);
    $stmt_check->close();
    $conn->close();
    exit;
}

// Masukkan pengguna baru
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO user (email, password, role) VALUES (?, ?, 'siswa')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashed_password);

if ($stmt->execute()) {
    $user_id = $stmt->insert_id;

    // Masukkan data ke tabel kelas_user
    $sql_kelas_user = "INSERT INTO kelas_user (id_user, kode_kelas) VALUES (?, ?)";
    $stmt_kelas_user = $conn->prepare($sql_kelas_user);
    $stmt_kelas_user->bind_param("is", $user_id, $kode_kelas);

    if ($stmt_kelas_user->execute()) {
        echo json_encode(["status" => "success", "message" => "Registrasi berhasil."]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Gagal menghubungkan kelas dengan pengguna."]);
    }
    $stmt_kelas_user->close();
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Gagal mendaftarkan pengguna."]);
}

$stmt->close();
$conn->close();
ob_end_clean();
exit;
