<?php
require_once '../../helper/conek.php';

if(isset($_POST['aksi'])){
    $id_essay = $_POST['id_essay'];
    $judul_soal = $_POST['judul_soal'];
    $pertanyaan = $_POST['pertanyaan'];
    $tanggal_buat = date('Y-m-d'); // Tanggal otomatis hari ini

    if($_POST['aksi'] == "add"){
        $query = "INSERT INTO essay (judul_soal, pertanyaan, tanggal_buat) VALUES ('$judul_soal', '$pertanyaan', '$tanggal_buat');";
    } elseif($_POST['aksi'] == "edit"){
        $query = "UPDATE essay SET judul_soal='$judul_soal', pertanyaan='$pertanyaan', tanggal_buat='$tanggal_buat' WHERE id_essay='$id_essay';";
    }

    if(mysqli_query($conn, $query)){
        header("Location: SoalEssay.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['hapus'])) {
    $id_essay = $_GET['hapus'];

    // Query untuk menghapus data
    $query = "DELETE FROM essay WHERE id_essay = '$id_essay'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        // Redirect jika berhasil
        header("Location: SoalEssay.php?pesan=hapus_sukses");
    } else {
        echo $sql;
    }
} else {
    header("Location: SoalEssay.php");
}

?> 