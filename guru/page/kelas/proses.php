<?php
session_start();
require_once '../../helper/conek.php';

if (isset($_POST['aksi'])) {
    $id_kelas = $_POST['id_kelas'] ?? null;
    $kode_kelas = $_POST['kode_kelas'];
    $nama_kelas = $_POST['nama_kelas'];

    if ($_POST['aksi'] == "add") {
        $query = "INSERT INTO kelas (kode_kelas, nama_kelas) VALUES ('$kode_kelas', '$nama_kelas');";
        $status = 'tambah';
    } elseif ($_POST['aksi'] == "edit") {
        $query = "UPDATE kelas SET kode_kelas='$kode_kelas', nama_kelas='$nama_kelas' WHERE id_kelas='$id_kelas';";
        $status = 'edit';
    }

    if (mysqli_query($conn, $query)) {
        $_SESSION['status'] = 'sukses';
        $_SESSION['aksi'] = $status;
    } else {
        $_SESSION['status'] = 'gagal';
        $_SESSION['aksi'] = $status;
    }
    header("Location: Kelas.php");
}

if (isset($_GET['hapus'])) {
    $id_kelas = $_GET['hapus'];

    $query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['status'] = 'sukses';
        $_SESSION['aksi'] = 'hapus';
    } else {
        $_SESSION['status'] = 'gagal';
        $_SESSION['aksi'] = 'hapus';
    }
    header("Location: Kelas.php");
}
?>