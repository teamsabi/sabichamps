<?php
require_once '../../helper/conek.php';

// Proses tambah data
if (isset($_POST['aksi']) && $_POST['aksi'] == "add") {
    $kode_kelas = generateKodeKelas($conn);
    $nama_kelas = $_POST['nama_kelas'];
    $jumlah_siswa = $_POST['jumlah_siswa'];

// Query untuk insert data
    $query = "INSERT INTO kelas (kode_kelas, nama_kelas, jumlah_siswa) 
          VALUES ('$kode_kelas', '$nama_kelas', '$jumlah_siswa')";

    $sql = mysqli_query($conn, $query);

    if($sql){
        header("location: Kelas.php");
    }else{
        echo $query;
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
