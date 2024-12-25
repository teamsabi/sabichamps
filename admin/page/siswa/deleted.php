<?php
require_once '../../helper/config.php';

if (isset($_GET['hapus'])) {
    $id_user = $_GET['hapus'];

    $conn->begin_transaction();
    try {
        // Hapus data dari tabel kelas_user
        $query_kelas_user = "DELETE FROM kelas_user WHERE id_user = '$id_user'";
        mysqli_query($conn, $query_kelas_user);

        // Hapus data dari tabel user
        $query_user = "DELETE FROM user WHERE id_user = '$id_user'";
        mysqli_query($conn, $query_user);

        $conn->commit();
        header("Location: ManajemenAkun-Siswa.php?status=sukses&aksi=hapus");
    } catch (Exception $e) {
        $conn->rollback();
        header("Location: ManajemenAkun-Siswa.php?status=gagal&aksi=hapus&error=" . $e->getMessage());
    }
}
?>
