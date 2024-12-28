<?php
header('Content-Type: application/json');

// Koneksi ke database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "sab_baru";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi database
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Koneksi gagal: " . $conn->connect_error]);
    exit;
}

// Ambil data input dari request POST
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Validasi input
if (empty($email) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "Harap isi semua kolom yang dibutuhkan."]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Format email tidak valid."]);
    exit;
}

// Cek user berdasarkan email
$sql_check_user = "SELECT id_user, password FROM user WHERE email = ?";
$stmt_check = $conn->prepare($sql_check_user);
if (!$stmt_check) {
    echo json_encode(["status" => "error", "message" => "Terjadi kesalahan pada query."]);
    exit;
}
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "Email tidak ditemukan."]);
    $stmt_check->close();
    $conn->close();
    exit;
}

// Ambil hashed password dari database
$stmt_check->bind_result($user_id, $hashed_password);
$stmt_check->fetch();

// Verifikasi password
if (password_verify($password, $hashed_password)) {
    // Ambil kelas pengguna berdasarkan `id_user`
    $sql_classes = "SELECT k.kode_kelas, k.nama_kelas 
                    FROM kelas_user ku 
                    INNER JOIN kelas k ON ku.kode_kelas = k.kode_kelas 
                    WHERE ku.id_user = ?";
    $stmt_classes = $conn->prepare($sql_classes);
    if (!$stmt_classes) {
        echo json_encode(["status" => "error", "message" => "Terjadi kesalahan pada query kelas."]);
        exit;
    }
    $stmt_classes->bind_param("i", $user_id);
    $stmt_classes->execute();
    $result_classes = $stmt_classes->get_result();

    $classes = [];
    while ($row = $result_classes->fetch_assoc()) {
        $classes[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "server_response" => "login berhasil",
        "user_id" => $user_id,
        "classes" => $classes
    ]);
    $stmt_classes->close();
} else {
    echo json_encode([
        "status" => "error",
        "server_response" => "Password salah."
    ]);
}

$stmt_check->close();
$conn->close();
