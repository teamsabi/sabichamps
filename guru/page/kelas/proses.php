<?php
require_once '../../helper/conek.php';

if(isset($_POST['aksi'])){
    $id_kelas = $_POST['id_kelas'];
    $kode_kelas = $_POST['kode_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $jumlah_siswa = $_POST['jumlah_siswa'];

    if($_POST['aksi'] == "add"){
        $query = "INSERT INTO kelas (kode_kelas, nama_kelas, jumlah_siswa) VALUES ('$kode_kelas', '$nama_kelas', '$jumlah_siswa');";
    } elseif($_POST['aksi'] == "edit"){
        $query = "UPDATE kelas SET kode_kelas='$kode_kelas', nama_kelas='$nama_kelas', jumlah_siswa='$jumlah_siswa' WHERE id_kelas='$id_kelas';";
    }

    if(mysqli_query($conn, $query)){
        header("Location: Kelas.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['hapus'])) {
    $id_kelas = $_GET['hapus'];

    // Query untuk menghapus data
    $query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        // Redirect jika berhasil
        header("Location: Kelas.php?pesan=hapus_sukses");
    } else {
        echo $sql;
    }
} else {
    header("Location: Kelas.php");
}

?>