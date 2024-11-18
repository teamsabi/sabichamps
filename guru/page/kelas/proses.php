<?php
require_once '../../helper/conek.php';

// Cek koneksi ke database
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Proses Tambah Data (Add)
if (isset($_POST['aksi']) && $_POST['aksi'] == 'add') {
    // Ambil data dari form dan sanitasi input
    $kode_kelas = isset($_POST['kode_kelas']) ? mysqli_real_escape_string($conn, $_POST['kode_kelas']) : null;
    $nama_kelas = isset($_POST['nama_kelas']) ? mysqli_real_escape_string($conn, $_POST['nama_kelas']) : null;
    $jumlah_siswa = isset($_POST['jumlah_siswa']) ? (int)$_POST['jumlah_siswa'] : 0; // Jika jumlah siswa kosong, set ke 0

    // Validasi input
    if (empty($kode_kelas) || empty($nama_kelas)) {
        echo "Kode kelas dan nama kelas tidak boleh kosong!";
        exit;
    }

    // Query untuk insert data kelas baru
    $query = "INSERT INTO kelas (kode_kelas, nama_kelas, jumlah_siswa) 
              VALUES ('$kode_kelas', '$nama_kelas', '$jumlah_siswa')";

    // Eksekusi query dan cek keberhasilan
    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman kelas.php jika berhasil
        header("Location: Kelas.php");
        exit;
    } else {
        // Tampilkan pesan error jika gagal
        echo "Error saat menyimpan data: " . mysqli_error($conn);
        exit;
    }
}

// Proses Edit Data
if (isset($_POST['aksi']) && $_POST['aksi'] == 'edit') {
    // Ambil data dari form dan sanitasi input
    $kode_kelas = isset($_POST['kode_kelas']) ? mysqli_real_escape_string($conn, $_POST['kode_kelas']) : null;
    $nama_kelas = isset($_POST['nama_kelas']) ? mysqli_real_escape_string($conn, $_POST['nama_kelas']) : null;
    $jumlah_siswa = isset($_POST['jumlah_siswa']) ? (int)$_POST['jumlah_siswa'] : 0;

    // Validasi input
    if (empty($kode_kelas) || empty($nama_kelas)) {
        echo "Kode kelas dan nama kelas tidak boleh kosong!";
        exit;
    }

    // Query untuk mengupdate data kelas
    $query = "UPDATE kelas 
              SET nama_kelas = '$nama_kelas', jumlah_siswa = '$jumlah_siswa' 
              WHERE kode_kelas = '$kode_kelas'";

    if (mysqli_query($conn, $query)) {
        header("Location: Kelas.php"); // Redirect ke halaman kelas jika berhasil
        exit;
    } else {
        echo "Error saat mengupdate data: " . mysqli_error($conn);
        exit;
    }
}

// Proses Hapus Data
if (isset($_GET['hapus'])) {
    $kode_kelas = mysqli_real_escape_string($conn, $_GET['hapus']); // Sanitasi input untuk keamanan

    // Query untuk menghapus data kelas
    $query = "DELETE FROM kelas WHERE kode_kelas = '$kode_kelas'";

    if (mysqli_query($conn, $query)) {
        header("Location: Kelas.php"); // Redirect ke halaman kelas jika berhasil
        exit;
    } else {
        echo "Error saat menghapus data: " . mysqli_error($conn);
        exit;
    }
}
?>
