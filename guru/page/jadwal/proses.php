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

        // Validasi: pastikan jam mulai tidak sama dengan jam selesai dan ada jarak minimal 1 menit
        if ($jamMulai == $jamSelesai) {
            header("Location: Jadwal.php?status=gagal&aksi=tambah&error=Jam mulai dan jam selesai tidak boleh sama.");
            exit;
        }

        // Menghitung selisih waktu
        $jamMulaiTimestamp = strtotime($jamMulai);
        $jamSelesaiTimestamp = strtotime($jamSelesai);

        if ($jamSelesaiTimestamp <= $jamMulaiTimestamp) {
            header("Location: Jadwal.php?status=gagal&aksi=tambah&error=Jam selesai harus lebih besar dari jam mulai.");
            exit;
        }

        $selisih = $jamSelesaiTimestamp - $jamMulaiTimestamp;
        if ($selisih < 60) {  // 60 detik = 1 menit
            header("Location: Jadwal.php?status=gagal&aksi=tambah&error=Jam mulai dan jam selesai harus berjarak minimal 1 menit.");
            exit;
        }

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

        // Validasi jam mulai dan jam selesai tidak bertabrakan
        $checkQuery = "
            SELECT * FROM jadwal 
            WHERE kode_kelas = '$kodeKelas' 
            AND kode_mapel = '$kodeMapel' 
            AND id_user = '$idUser' 
            AND hari = '$hari' 
            AND (
                ('$jamMulai' >= jam_mulai AND '$jamMulai' < jam_selesai) OR 
                ('$jamSelesai' > jam_mulai AND '$jamSelesai' <= jam_selesai) OR 
                (jam_mulai >= '$jamMulai' AND jam_mulai < '$jamSelesai') OR 
                (jam_selesai > '$jamMulai' AND jam_selesai <= '$jamSelesai')
            )
        ";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Jika ada jadwal yang bertabrakan
            header("Location: Jadwal.php?status=gagal&aksi=tambah&error=Jam bertabrakan dengan jadwal lainnya.");
            exit;
        }

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

        // Validasi: pastikan jam mulai tidak sama dengan jam selesai dan ada jarak minimal 1 menit
        if ($jamMulai == $jamSelesai) {
            header("Location: Jadwal.php?status=gagal&aksi=edit&error=Jam mulai dan jam selesai tidak boleh sama.");
            exit;
        }

        // Menghitung selisih waktu
        $jamMulaiTimestamp = strtotime($jamMulai);
        $jamSelesaiTimestamp = strtotime($jamSelesai);

        if ($jamSelesaiTimestamp <= $jamMulaiTimestamp) {
            header("Location: Jadwal.php?status=gagal&aksi=edit&error=Jam selesai harus lebih besar dari jam mulai.");
            exit;
        }

        $selisih = $jamSelesaiTimestamp - $jamMulaiTimestamp;
        if ($selisih < 60) {  // 60 detik = 1 menit
            header("Location: Jadwal.php?status=gagal&aksi=edit&error=Jam mulai dan jam selesai harus berjarak minimal 1 menit.");
            exit;
        }

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

        // Validasi jam mulai dan jam selesai tidak bertabrakan
        $checkQuery = "
            SELECT * FROM jadwal 
            WHERE kode_kelas = '$kodeKelas' 
            AND kode_mapel = '$kodeMapel' 
            AND id_user = '$idUser' 
            AND hari = '$hari' 
            AND id_jadwal != '$id_jadwal'  -- Menghindari jadwal yang sedang diedit
            AND (
                ('$jamMulai' >= jam_mulai AND '$jamMulai' < jam_selesai) OR 
                ('$jamSelesai' > jam_mulai AND '$jamSelesai' <= jam_selesai) OR 
                (jam_mulai >= '$jamMulai' AND jam_mulai < '$jamSelesai') OR 
                (jam_selesai > '$jamMulai' AND jam_selesai <= '$jamSelesai')
            )
        ";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Jika ada jadwal yang bertabrakan
            header("Location: Jadwal.php?status=gagal&aksi=edit&error=Jam bertabrakan dengan jadwal lainnya.");
            exit;
        }

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
