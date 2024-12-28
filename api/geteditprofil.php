<?php
require 'connection.php'; // Include your database connection file

// Ambil data yang dikirim melalui GET (misalnya menggunakan email sebagai parameter)
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Query untuk mendapatkan data profil berdasarkan email
    $query = "SELECT nama_lengkap, jenis_kelamin, telepon, tanggal_lahir, nama_ortu_wali, alamat FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email); // Menggunakan parameter untuk menghindari SQL injection

    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($nama_lengkap, $jenis_kelamin, $telepon, $tanggal_lahir, $nama_ortu_wali, $alamat);

        if ($stmt->fetch()) {
            // Jika data ditemukan, kembalikan data dalam format JSON
            $response = array(
                "success" => true,
                "data" => array(
                    "nama_lengkap" => $nama_lengkap,
                    "jenis_kelamin" => $jenis_kelamin,
                    "telepon" => $telepon,
                    "tanggal_lahir" => $tanggal_lahir,
                    "nama_ortu_wali" => $nama_ortu_wali,
                    "alamat" => $alamat
                )
            );
        } else {
            // Jika data tidak ditemukan
            $response = array("success" => false, "message" => "Profil tidak ditemukan.");
        }
    } else {
        // Jika query gagal
        $response = array("success" => false, "message" => "Terjadi kesalahan saat mengambil data.");
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();

    // Kembalikan respons dalam format JSON
    echo json_encode($response);
} else {
    // Jika parameter email tidak diberikan
    echo json_encode(array("success" => false, "message" => "Email tidak diberikan."));
}
