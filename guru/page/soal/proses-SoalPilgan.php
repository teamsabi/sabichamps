<?php
require_once '../../helper/conek.php';

if(isset($_POST['aksi'])){
    $id_pilgan = $_POST['id_pilgan'];
    $judul_soal = $_POST['judul_soal'];
    $pertanyaan = $_POST['pertanyaan'];
    $opsi_a = $_POST['opsi_a'];
    $opsi_b = $_POST['opsi_b'];
    $opsi_c = $_POST['opsi_c'];
    $opsi_d = $_POST['opsi_d'];
    $opsi_e = $_POST['opsi_e'];
    $kunci_jawaban = $_POST['kunci_jawaban'];
    $tanggal_buat = date('Y-m-d'); // Tanggal otomatis hari ini

    if($_POST['aksi'] == "add"){
        $query = "INSERT INTO pilgan (judul_soal, pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, kunci_jawaban, tanggal_buat) 
        VALUES ('$judul_soal', '$pertanyaan', '$opsi_a', '$opsi_b', '$opsi_c', '$opsi_d', '$opsi_e', '$kunci_jawaban', '$tanggal_buat');";

    } elseif($_POST['aksi'] == "edit"){
        $query = "UPDATE pilgan SET judul_soal='$judul_soal', pertanyaan='$pertanyaan', opsi_a='$opsi_a', opsi_b='$opsi_b', opsi_c='$opsi_c', 
        opsi_d='$opsi_d', opsi_e='$opsi_e', kunci_jawaban='$kunci_jawaban', tanggal_buat='$tanggal_buat' WHERE id_pilgan='$id_pilgan';";
    }

    if(mysqli_query($conn, $query)){
        header("Location: SoalPilgan.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['hapus'])) {
    $id_pilgan = $_GET['hapus'];

    // Query untuk menghapus data
    $query = "DELETE FROM pilgan WHERE id_pilgan = '$id_pilgan'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        // Redirect jika berhasil
        header("Location: SoalPilgan.php?pesan=hapus_sukses");
    } else {
        echo $sql;
    }
} else {
    header("Location: SoalPilgan.php");
}

?> 