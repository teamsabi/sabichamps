<?php
// Mengatur header agar respons berformat JSON
header('Content-Type: application/json');

// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "sab_baru"; // Ganti dengan nama database Anda

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil parameter kode_mapel dari query string
$kode_mapel = isset($_GET['kode_mapel']) ? $_GET['kode_mapel'] : '';

// Periksa apakah kode_mapel ada
if ($kode_mapel != '') {
    // Query untuk mengambil materi berdasarkan kode_mapel
    $sql = "SELECT m.id_materi, m.judul_materi, m.kode_mapel, m.file_materi, m.tanggal_upload, mp.nama_mapel
            FROM materi m
            JOIN mapel mp ON m.kode_mapel = mp.kode_mapel
            WHERE m.kode_mapel = '$kode_mapel'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Menyiapkan array untuk menyimpan data
        $materi = array();

        // Menyimpan data ke dalam array
        while ($row = $result->fetch_assoc()) {
            $materi[] = $row;
        }

        // Mengembalikan data dalam format JSON
        echo json_encode(array('status' => 'success', 'materi' => $materi));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Materi tidak ditemukan untuk kode mapel tersebut'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Kode mapel tidak diberikan'));
}

// Tutup koneksi
$conn->close();
