<?php
require_once '../../helper/config.php';

if (isset($_GET['kelas'])) {
    $kelas = $_GET['kelas'];
    
    // Pastikan kelas tidak kosong
    if (!empty($kelas)) {
        // Query untuk mendapatkan mata pelajaran berdasarkan kelas
        $query = "SELECT kode_mapel, nama_mapel FROM mapel WHERE kode_kelas = (SELECT kode_kelas FROM kelas WHERE nama_kelas = '$kelas')";
        $result = mysqli_query($conn, $query);
        
        // Menyusun data dalam format JSON
        $mapel = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $mapel[] = $row;
        }
        
        // Mengirimkan data dalam format JSON
        echo json_encode($mapel);
    } else {
        echo json_encode([]);  // Mengembalikan array kosong jika kelas tidak ada
    }
}
?>
