<?php
require_once '../../helper/config.php';

if (isset($_POST['aksi'])) {
    $kode_mapel = $_POST['kode_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    $kode_kelas = $_POST['nama_kelas'];

    // Handle add action
    if ($_POST['aksi'] == "add") {
        $query = "INSERT INTO mapel (kode_mapel, nama_mapel, kode_kelas) VALUES ('$kode_mapel', '$nama_mapel', '$kode_kelas')";
        $status = 'tambah';
    }
    // Handle edit action
    elseif ($_POST['aksi'] == "edit") {
        $query = "UPDATE mapel SET nama_mapel='$nama_mapel', kode_kelas='$kode_kelas' WHERE kode_mapel='$kode_mapel'";
        $status = 'edit';
    }

    // Execute query and check the result
    if (mysqli_query($conn, $query)) {
        header("Location: Mapel.php?status=sukses&aksi=$status");
    } else {
        header("Location: Mapel.php?status=gagal&aksi=$status");
    }
    exit();
}

// Handle delete action
if (isset($_GET['hapus'])) {
    $kode_mapel = $_GET['hapus'];

    // Pertama, hapus data terkait di tabel jadwal
    $query_jadwal = "DELETE FROM jadwal WHERE kode_mapel = '$kode_mapel'";
    mysqli_query($conn, $query_jadwal);

    // Sekarang, hapus data mapel
    $query = "DELETE FROM mapel WHERE kode_mapel = '$kode_mapel'";
    if (mysqli_query($conn, $query)) {
        header("Location: Mapel.php?status=sukses&aksi=hapus");
    } else {
        header("Location: Mapel.php?status=gagal&aksi=hapus");
    }
    exit();
}
?>
