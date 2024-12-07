<?php
require_once '../../helper/conek.php';
session_start(); // Tambahkan ini untuk menggunakan session

if (isset($_POST['aksi'])) {
    $id_mapel = $_POST['id_mapel'] ?? null;
    $kode_mapel = $_POST['kode_mapel'];
    $nama_mapel = $_POST['nama_mapel'];

    if ($_POST['aksi'] == "add") {
        $query = "INSERT INTO mapel (kode_mapel, nama_mapel) VALUES ('$kode_mapel', '$nama_mapel');";
        $status = 'tambah';
    } elseif ($_POST['aksi'] == "edit") {
        $query = "UPDATE mapel SET kode_mapel='$kode_mapel', nama_mapel='$nama_mapel' WHERE id_mapel='$id_mapel';";
        $status = 'edit';
    }

    if (mysqli_query($conn, $query)) {
        $_SESSION['status'] = 'sukses';
        $_SESSION['aksi'] = $status;
    } else {
        $_SESSION['status'] = 'gagal';
        $_SESSION['aksi'] = $status;
    }
    header("Location: Mapel.php");
    exit();
}

if (isset($_GET['hapus'])) {
    $id_mapel = $_GET['hapus'];

    $query = "DELETE FROM mapel WHERE id_mapel = '$id_mapel'";
    $sql = mysqli_query($conn, $query);
    $status = 'hapus';

    if ($sql) {
        $_SESSION['status'] = 'sukses';
        $_SESSION['aksi'] = $status;
    } else {
        $_SESSION['status'] = 'gagal';
        $_SESSION['aksi'] = $status;
    }
    header("Location: Mapel.php");
    exit();
} else {
    header("Location: Mapel.php");
    exit();
}
?>
