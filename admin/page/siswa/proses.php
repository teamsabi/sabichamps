<?php
require_once '../../helper/conek.php';

// Mendapatkan aksi dari form
$aksi = $_POST['aksi'] ?? null;

if ($aksi === "add") {
    // Tambah Data Siswa
    $nama_siswa = $_POST['nama_siswa'];
    $email = $_POST['email_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon_siswa'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelas = $_POST['kelas'];
    $ortu = $_POST['ortu_wali'];
    $alamat = $_POST['alamat_guru'];

    $query = "INSERT INTO siswa (nama_siswa, email, jenis_kelamin, telepon, tanggal_lahir, kelas, ortu_wali, alamat) 
              VALUES ('$nama_siswa', '$email', '$jenis_kelamin', '$telepon', '$tanggal_lahir', '$kelas', '$ortu', '$alamat')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: ManajemenAkun-Siswa.php?status=sukses&aksi=tambah");
    } else {
        header("Location: ManajemenAkun-Siswa.php?status=gagal&aksi=tambah");
    }

} elseif ($aksi === "edit") {
    // Edit Data Siswa
    $id_siswa = $_POST['id_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $email = $_POST['email_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon_siswa'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelas = $_POST['kelas'];
    $ortu = $_POST['ortu_wali'];
    $alamat = $_POST['alamat_guru'];

    $query = "UPDATE siswa SET 
              nama_siswa = '$nama_siswa', 
              email = '$email', 
              jenis_kelamin = '$jenis_kelamin', 
              telepon = '$telepon', 
              tanggal_lahir = '$tanggal_lahir', 
              kelas = '$kelas', 
              ortu_wali = '$ortu', 
              alamat = '$alamat'
              WHERE id_siswa = '$id_siswa'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: ManajemenAkun-Siswa.php?status=sukses&aksi=edit");
    } else {
        header("Location: ManajemenAkun-Siswa.php?status=gagal&aksi=edit");
    }

} elseif (isset($_GET['hapus'])) {
    // Hapus Data Siswa
    $id_siswa = $_GET['hapus'];
    $query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($conn, $query)) {
        header("Location: ManajemenAkun-Siswa.php?status=sukses&aksi=hapus");
    } else {
        header("Location: ManajemenAkun-Siswa.php?status=gagal&aksi=hapus");
    }
} else {
    header("Location: ManajemenAkun-Siswa.php");
}
?>
