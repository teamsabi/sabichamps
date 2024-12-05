<?php
require_once '../../helper/conek.php';

if (isset($_POST['aksi'])) {
    $id_mapel = $_POST['id_mapel'] ?? null;
    $kode_mapel = $_POST['kode_mapel'];
    $nama_mapel = $_POST['nama_mapel'];

    if ($_POST['aksi'] == "add") {
        $query = "INSERT INTO mapel (kode_mapel, nama_mapel) VALUES ('$kode_mapel', '$nama_mapel')";
        $status = 'tambah';
    } elseif ($_POST['aksi'] == "edit") {
        $query = "UPDATE mapel SET kode_mapel='$kode_mapel', nama_mapel='$nama_mapel' WHERE id_mapel ='$id_mapel'";
        $status = 'edit';
    }

    if (mysqli_query($conn, $query)) {
        header("Location: Mapel.php?status=sukses&aksi=$status");
    } else {
        header("Location: Mapel.php?status=gagal&aksi=$status");
    }
    exit();
}

if (isset($_GET['hapus'])) {
    $id_mapel = $_GET['hapus'];

    $query = "DELETE FROM mapel WHERE id_mapel = '$id_mapel'";
    $status = 'hapus';
    if (mysqli_query($conn, $query)) {
        header("Location: Mapel.php?status=sukses&aksi=$status");
    } else {
        header("Location: Mapel.php?status=gagal&aksi=hapus");
    }
    exit();
} else {
    header("Location: Mapel.php");
    exit();
}
?>