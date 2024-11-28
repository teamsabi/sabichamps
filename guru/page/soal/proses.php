<?php
require_once '../../helper/conek.php';

if(isset($_POST['aksi'])){
    $id_soal = $_POST['id_soal'];
    $judul_soal = $_POST['judul_soal'];
    $mapel = $_POST['mapel'];
    $nama_kelas = $_POST['nama_kelas'];
    $waktu_pengerjaan = $_POST['waktu_pengerjaan'];
    $info_soal = $_POST['info_soal'];

    if($_POST['aksi'] == "add"){
        $query = "INSERT INTO soal (judul_soal, mapel, nama_kelas, waktu_pengerjaan, info_soal) VALUES ('$judul_soal', '$mapel', '$nama_kelas', '$waktu_pengerjaan', '$info_soal');";
    } elseif($_POST['aksi'] == "edit"){
        $query = "UPDATE soal SET judul_soal='$judul_soal', mapel='$mapel', nama_kelas='$nama_kelas', waktu_pengerjaan='$waktu_pengerjaan', info_kuliah='$info_soal' WHERE id_soal='$id_soal';";
    }

    if(mysqli_query($conn, $query)){
        header("Location: BankSoal.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['hapus'])) {
    $id_soal = $_GET['hapus'];

    // Query untuk menghapus data
    $query = "DELETE FROM soal WHERE id_soal = '$id_soal'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        // Redirect jika berhasil
        header("Location: BankSoal.php?pesan=hapus_sukses");
    } else {
        echo $sql;
    }
} else {
    header("Location: BankSoal.php");
}

?>