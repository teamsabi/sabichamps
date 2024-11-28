<?php
require_once '../../helper/conek.php';

if(isset($_POST['aksi'])){
    $id_mapel = $_POST['id_mapel'];
    $kode_mapel = $_POST['kode_mapel'];
    $nama_mapel = $_POST['nama_mapel'];

    if($_POST['aksi'] == "add"){
        $query = "INSERT INTO mapel (kode_mapel, nama_mapel) VALUES ('$kode_mapel', '$nama_mapel');";
    } elseif($_POST['aksi'] == "edit"){
        $query = "UPDATE mapel SET kode_mapel='$kode_mapel', nama_mapel='$nama_mapel' WHERE id_mapel='$id_mapel';";
    }

    if(mysqli_query($conn, $query)){
        header("Location: Mapel.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['hapus'])) {
    $id_mapel = $_GET['hapus'];

    // Query untuk menghapus data
    $query = "DELETE FROM mapel WHERE id_mapel = '$id_mapel'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        // Redirect jika berhasil
        header("Location: Mapel.php?pesan=hapus_sukses");
    } else {
        echo $sql;
    }
} else {
    header("Location: Mapel.php");
}

?>