<?php
header('Content-Type: application/json');

// Koneksi database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "sab_baru";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi database
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Koneksi gagal: " . $conn->connect_error]);
    exit;
}

// Query untuk mengambil data kelas
$sql = "SELECT kode_kelas, nama_kelas FROM kelas";
$result = $conn->query($sql);

// Cek apakah kelas tersedia
if ($result && $result->num_rows > 0) {
    $kelas = [];
    while ($row = $result->fetch_assoc()) {
        $kelas[] = $row; // Menyimpan kode_kelas dan nama_kelas
    }
    echo json_encode(["status" => "success", "kelas" => $kelas]);
} else {
    echo json_encode(["status" => "error", "message" => "Tidak ada data kelas"]);
}

$conn->close();
