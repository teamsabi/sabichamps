<?php
header('Content-Type: application/json');

// Cek apakah sesi sudah dimulai, jika belum, mulai sesi
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa jika pengguna sudah login (misalnya, cek jika ada user_id di dalam sesi)
if (!isset($_SESSION['id_user'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Pengguna belum login."
    ]);
    exit;
}

// Hapus sesi yang terkait dengan pengguna
session_unset();  // Menghapus semua variabel sesi
session_destroy();  // Menghancurkan sesi

// Tanggapan sukses logout
echo json_encode([
    "status" => "success",
    "message" => "Logout berhasil."
]);
