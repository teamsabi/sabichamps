<?php
// Koneksi ke database
$conn = new mysqli('127.0.0.1', 'username', 'password', 'sab_baru');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Data dari formulir edit profil
    $id_user = intval($_POST['id_user']); // ID user yang diedit
    $nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']);
    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
    $telepon = intval($_POST['telepon']);
    $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
    $nama_ortu_wali = $conn->real_escape_string($_POST['nama_ortu_wali']);
    $alamat = $conn->real_escape_string($_POST['alamat']);

    // Query untuk memperbarui data
    $sql = "UPDATE user SET 
        nama_lengkap = '$nama_lengkap',
        jenis_kelamin = '$jenis_kelamin',
        telepon = '$telepon',
        tanggal_lahir = '$tanggal_lahir',
        nama_ortu_wali = '$nama_ortu_wali',
        alamat = '$alamat'
        WHERE id_user = $id_user";

    if ($conn->query($sql) === TRUE) {
        echo "Profil berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
