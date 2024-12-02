<?php
require_once '../../helper/conek.php';

if(isset($_POST['aksi'])){
    $id_essay = $_POST['id_essay'];
    $pertanyaan = $_POST['pertanyaan'];
    $tanggal_buat = date('Y-m-d'); // Tanggal otomatis hari ini

    if($_POST['aksi'] == "add"){
        $query = "INSERT INTO essay (pertanyaan, tanggal_buat) VALUES ('$pertanyaan', '$tanggal_buat');";
    } elseif($_POST['aksi'] == "edit"){
        $query = "UPDATE essay SET pertanyaan='$pertanyaan', tanggal_buat='$tanggal_buat' WHERE id_essay='$id_essay';";
    }

    if(mysqli_query($conn, $query)){
        header("Location: SoalEssay.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['hapus'])) {
    $id_soal = $_GET['hapus'];

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