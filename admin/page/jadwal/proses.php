<?php
require_once '../../helper/config.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {
        
        // Mengambil nilai dari input form
        $hari = $_POST['hari'];
        $tanggal = $_POST['tanggal']; // Menambahkan input tanggal
        $tempat = $_POST['tempat'];
        $namaKelas = $_POST['nama_kelas'];
        $mapel = $_POST['mapel'];
        $jamMulai = $_POST['jam_mulai'];
        $jamSelesai = $_POST['jam_selesai'];
        $namaGuru = $_POST['nama_guru'];

        // Query untuk mengambil kode_kelas, kode_mapel, dan id_user berdasarkan nama
        $kelasQuery = mysqli_query($conn, "SELECT kode_kelas FROM kelas WHERE nama_kelas = '$namaKelas'");
        $kelasData = mysqli_fetch_assoc($kelasQuery);
        $kodeKelas = $kelasData['kode_kelas'];

        $mapelQuery = mysqli_query($conn, "SELECT kode_mapel FROM mapel WHERE nama_mapel = '$mapel'");
        $mapelData = mysqli_fetch_assoc($mapelQuery);
        $kodeMapel = $mapelData['kode_mapel'];

        $guruQuery = mysqli_query($conn, "SELECT id_user FROM user WHERE nama_lengkap = '$namaGuru' AND role = 'guru'");
        $guruData = mysqli_fetch_assoc($guruQuery);
        $idUser = $guruData['id_user'];

        // Query untuk menambahkan data ke database
        $query = "INSERT INTO jadwal (kode_kelas, kode_mapel, id_user, hari, tanggal, tempat, jam_mulai, jam_selesai) 
                  VALUES ('$kodeKelas', '$kodeMapel', '$idUser', '$hari', '$tanggal', '$tempat', '$jamMulai', '$jamSelesai')";

        $status = 'tambah';
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            header("Location: Jadwal.php?status=sukses&aksi=$status");
        } else {
            header("Location: Jadwal.php?status=gagal&aksi=$status");
        }

    } else if ($_POST['aksi'] == "edit") {

        // Mengambil data untuk update
        $id_jadwal = $_POST['id_jadwal'];
        $hari = $_POST['hari'];
        $tanggal = $_POST['tanggal']; // Menambahkan input tanggal
        $tempat = $_POST['tempat'];
        $namaKelas = $_POST['nama_kelas'];
        $mapel = $_POST['mapel'];
        $jamMulai = $_POST['jam_mulai'];
        $jamSelesai = $_POST['jam_selesai'];
        $namaGuru = $_POST['nama_guru'];

        // Query untuk mendapatkan kode_kelas, kode_mapel, dan id_user berdasarkan nama
        $kelasQuery = mysqli_query($conn, "SELECT kode_kelas FROM kelas WHERE nama_kelas = '$namaKelas'");
        $kelasData = mysqli_fetch_assoc($kelasQuery);
        $kodeKelas = $kelasData['kode_kelas'];

        $mapelQuery = mysqli_query($conn, "SELECT kode_mapel FROM mapel WHERE nama_mapel = '$mapel'");
        $mapelData = mysqli_fetch_assoc($mapelQuery);
        $kodeMapel = $mapelData['kode_mapel'];

        $guruQuery = mysqli_query($conn, "SELECT id_user FROM user WHERE nama_lengkap = '$namaGuru' AND role = 'guru'");
        $guruData = mysqli_fetch_assoc($guruQuery);
        $idUser = $guruData['id_user'];

        // Query untuk update jadwal
        $query = "UPDATE jadwal SET 
                    kode_kelas = '$kodeKelas', 
                    kode_mapel = '$kodeMapel', 
                    id_user = '$idUser', 
                    hari = '$hari', 
                    tanggal = '$tanggal', 
                    tempat = '$tempat', 
                    jam_mulai = '$jamMulai', 
                    jam_selesai = '$jamSelesai'  
                  WHERE id_jadwal = '$id_jadwal'";

        $status = 'edit';
        $sql = mysqli_query($conn, $query);

        if ($sql) {
            header("Location: Jadwal.php?status=sukses&aksi=$status");
        } else {
            header("Location: Jadwal.php?status=gagal&aksi=$status");
        }
    }
}

if (isset($_GET['hapus'])) {
    $id_jadwal = $_GET['hapus'];  // Mengambil ID dari URL
    
    // Query untuk menghapus data
    $query = "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal'";
    $sql = mysqli_query($conn, $query);
    $status = 'hapus';

    if ($sql) {
        header("Location: Jadwal.php?status=sukses&aksi=$status");
    } else {
        header("Location: Jadwal.php?status=gagal&aksi=$status");
    }
}
?>
