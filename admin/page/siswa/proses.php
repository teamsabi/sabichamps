<?php
require_once '../../helper/config.php';

// Mendapatkan aksi dari form
$aksi = $_POST['aksi'] ?? null;

if ($aksi === "edit") {
    // Edit Data Siswa
    $id_user = $_POST['id_user'];
    $nama_siswa = $_POST['nama_siswa'];
    $email = $_POST['email_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon_siswa'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelas = $_POST['kelas'];  // Input kelas baru
    $ortu = $_POST['ortu_wali'];
    $alamat = $_POST['alamat_siswa'];

    // Update data di tabel user
    $query_user = "UPDATE user SET 
              nama_lengkap  = '$nama_siswa', 
              email = '$email', 
              jenis_kelamin = '$jenis_kelamin', 
              telepon = '$telepon', 
              tanggal_lahir = '$tanggal_lahir', 
              nama_ortu_wali = '$ortu', 
              alamat = '$alamat'
              WHERE id_user = '$id_user'";

    // Ambil kode_kelas berdasarkan nama_kelas yang dipilih
    $kelas_query = "SELECT kode_kelas FROM kelas WHERE nama_kelas = '$kelas'";
    $result_kelas = mysqli_query($conn, $kelas_query);

    if ($result_kelas && mysqli_num_rows($result_kelas) > 0) {
        $kelas_data = mysqli_fetch_assoc($result_kelas);
        $kode_kelas = $kelas_data['kode_kelas'];

        $cek_kelas_user = "SELECT * FROM kelas_user WHERE id_user = '$id_user'";
        $result_kelas_user = mysqli_query($conn, $cek_kelas_user);

        if (mysqli_num_rows($result_kelas_user) > 0) {
            $query_kelas_user = "UPDATE kelas_user SET kode_kelas = '$kode_kelas' WHERE id_user = '$id_user'";
        } else {
            $query_kelas_user = "INSERT INTO kelas_user (id_user, kode_kelas) VALUES ('$id_user', '$kode_kelas')";
        }

        $conn->begin_transaction();
        try {
            if (mysqli_query($conn, $query_user) && mysqli_query($conn, $query_kelas_user)) {
                $conn->commit();
                header("Location: ManajemenAkun-Siswa.php?status=sukses&aksi=edit");
            } else {
                throw new Exception('Gagal memperbarui data');
            }
        } catch (Exception $e) {
            $conn->rollback();
            header("Location: ManajemenAkun-Siswa.php?status=gagal&aksi=edit&error=" . $e->getMessage());
        }
    } else {
        header("Location: ManajemenAkun-Siswa.php?status=gagal&aksi=edit&error=Kelas tidak ditemukan");
    }
} elseif ($aksi === "add") {
    // Tambah Data Siswa
    $nama_siswa = $_POST['nama_siswa'];
    $email = $_POST['email_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon_siswa'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelas = $_POST['kelas'];
    $ortu = $_POST['ortu_wali'];
    $alamat = $_POST['alamat_siswa'];

    $kelas_query = "SELECT kode_kelas FROM kelas WHERE nama_kelas = '$kelas'";
    $result_kelas = mysqli_query($conn, $kelas_query);

    if ($result_kelas && mysqli_num_rows($result_kelas) > 0) {
        $kelas_data = mysqli_fetch_assoc($result_kelas);
        $kode_kelas = $kelas_data['kode_kelas'];
    } else {
        header("Location: ManajemenAkun-Siswa.php?status=gagal&aksi=tambah&error=Kelas tidak ditemukan");
        exit;
    }

    $query_user = "INSERT INTO user (nama_lengkap, email, jenis_kelamin, telepon, tanggal_lahir, nama_ortu_wali, alamat)
                   VALUES ('$nama_siswa', '$email', '$jenis_kelamin', '$telepon', '$tanggal_lahir', '$ortu', '$alamat')";

    $conn->begin_transaction();
    try {
        if (mysqli_query($conn, $query_user)) {
            $last_id = mysqli_insert_id($conn);
            $query_kelas_user = "INSERT INTO kelas_user (id_user, kode_kelas) VALUES ('$last_id', '$kode_kelas')";

            if (mysqli_query($conn, $query_kelas_user)) {
                $conn->commit();
                header("Location: ManajemenAkun-Siswa.php?status=sukses&aksi=tambah");
            } else {
                throw new Exception('Gagal menambahkan data kelas_user');
            }
        } else {
            throw new Exception('Gagal menambahkan data siswa');
        }
    } catch (Exception $e) {
        $conn->rollback();
        header("Location: ManajemenAkun-Siswa.php?status=gagal&aksi=tambah&error=" . $e->getMessage());
    }
} elseif ($aksi === "delete") {
    // Hapus Data Siswa
    $id_user = $_POST['id_user'];

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
} else {
    header("Location: ManajemenAkun-Siswa.php");
}
?>
