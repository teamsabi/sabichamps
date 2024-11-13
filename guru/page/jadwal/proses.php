<?php
require_once '../../helper/conek.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {
        
        // Mengambil nilai dari input form
        $hari = $_POST['hari'];
        $namaKelas = $_POST['nama_kelas'];
        $mapel = $_POST['mapel'];
        $jamMulai = $_POST['jamMulai'];
        $jamSelesai = $_POST['jamSelesai'];
        $namaGuru = $_POST['namaGuru'];

        // Query untuk menambahkan data ke database
        $query = "INSERT INTO jadwal (hari, nama_kelas, mapel, jam_mulai, jam_selesai, nama_guru) 
                  VALUES ('$hari', '$namaKelas', '$mapel', '$jamMulai', '$jamSelesai', '$namaGuru')";

        // Eksekusi query
        $sql = mysqli_query($conn, $query);

        // Cek apakah query berhasil
        if ($sql) {
            header("Location: jadwal.php"); // Redirect ke halaman jadwal jika berhasil
            exit;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn); // Tampilkan error jika query gagal
        }
        
    } elseif ($_POST['aksi'] == "edit") {
        echo "edit data";
    }
}

if (isset($_GET['hapus'])) {   
    $idjadwal = $_GET['hapus'];
    $query = "DELETE FROM jadwal WHERE id_jadwal = '$idjadwal'";
    $sql = mysqli_query($conn, $query);

    // Cek apakah query berhasil
    if ($sql) {
        header("Location: jadwal.php"); // Redirect ke halaman jadwal jika berhasil
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn); // Tampilkan error jika query gagal
    }
}
?>
