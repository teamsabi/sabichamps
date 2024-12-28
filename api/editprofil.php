<?php
require_once 'connection.php'; // File untuk koneksi database

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = array(); // Array untuk menyimpan respon API

if ($con) {
    // Check if all required POST parameters are set
    if (isset($_POST['id_user'], $_POST['username'], $_POST['jenis_kelamin'], $_POST['tanggal_lahir'], $_POST['telepon'], $_POST['nama_ortu_wali'], $_POST['alamat'])) {
        // Retrieve parameters
        $id_user = $_POST['id_user'];
        $nama = $_POST['username'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $nomor_whatsapp = $_POST['telepon'];
        $nama_ortu = $_POST['nama_ortu_wali'];
        $alamat = $_POST['alamat'];

        // Prepare SQL statement
        $stmt = mysqli_prepare($con, "UPDATE user SET username=?, jenis_kelamin=?, tanggal_lahir=?, telepon=?, nama_ortu_wali=?, alamat=? WHERE id_user=?");

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $nama, $jenis_kelamin, $tanggal_lahir, $nomor_whatsapp, $nama_ortu, $alamat, $id_user);

        // Execute statement and check for success
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "OK", "message" => "Data berhasil disimpan"]);
        } else {
            echo json_encode(["status" => "FAILED", "message" => "Gagal menyimpan data"]);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(["status" => "FAILED", "message" => "Data tidak lengkap"]);
    }
} else {
    echo json_encode(["status" => "FAILED", "message" => "Koneksi ke database gagal"]);
}

// Close the database connection
mysqli_close($con);
