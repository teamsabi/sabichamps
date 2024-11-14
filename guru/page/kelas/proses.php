<?php
require_once '../../helper/conek.php';

if (isset($_POST['aksi'])) {
    // Mengambil nilai dari form dan melakukan sanitasi
    $nama_kelas = isset($_POST['namaKelas']) ? mysqli_real_escape_string($conn, $_POST['namaKelas']) : '';
    $aksi = $_POST['aksi'];

    if ($aksi == 'add') {
        // Menambahkan data kelas ke database menggunakan query biasa
        // Menambahkan nilai default untuk jumlah_siswa (misalnya 0)
        $query = "INSERT INTO kelas (nama_kelas, jumlah_siswa) VALUES ('$nama_kelas', 0)";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data kelas berhasil ditambahkan.'); window.location.href='Kelas.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data kelas: " . mysqli_error($conn) . "');</script>";
        }
    } elseif ($aksi == 'edit') {
        // Mengambil kode_kelas dari form untuk update data
        $kode_kelas = isset($_POST['kode_kelas']) ? mysqli_real_escape_string($conn, $_POST['kode_kelas']) : '';
        
        // Update data kelas yang sudah ada menggunakan query biasa
        $query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE kode_kelas = '$kode_kelas'";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data kelas berhasil diperbarui.'); window.location.href='Kelas.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data kelas: " . mysqli_error($conn) . "');</script>";
        }
    }
} else {
    echo "<script>alert('Aksi tidak valid!'); window.location.href='Kelas.php';</script>";
}
?>
