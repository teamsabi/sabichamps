<?php
require_once '../../helper/conek.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {
        
        // Mengambil nilai dari input form
        $hari = $_POST['hari'];
        $tanggal = $_POST['tanggal'];
        $tempat = $_POST['tempat'];
        $namaKelas = $_POST['nama_kelas'];
        $mapel = $_POST['mapel'];
        $jamMulai = $_POST['jam_mulai'];
        $jamSelesai = $_POST['jam_selesai'];
        $namaGuru = $_POST['nama_guru'];
        
        // Query untuk menambahkan data ke database
        $query = "INSERT INTO jadwal (hari, tanggal, tempat, nama_kelas, mapel, jam_mulai, jam_selesai, nama_guru) 
                  VALUES ('$hari', '$tanggal', '$tempat', '$namaKelas', '$mapel', '$jamMulai', '$jamSelesai', '$namaGuru')";

        $sql = mysqli_query($conn, $query);
        $status = 'tambah';

        if($sql){
            header("location: Jadwal.php?status=sukses&aksi=$status");
        }else{
            header("location: Jadwal.php?status=gagal&aksi=$status");
        }
        }else if($_POST['aksi'] == "edit"){
            $id_jadwal = $_POST['id_jadwal'];
            $hari = $_POST['hari'];
            $tanggal = $_POST['tanggal'];
            $tempat = $_POST['tempat'];
            $namaKelas = $_POST['nama_kelas'];
            $mapel = $_POST['mapel'];
            $jamMulai = $_POST['jam_mulai'];
            $jamSelesai = $_POST['jam_selesai'];
            $namaGuru = $_POST['nama_guru'];

            $query = "UPDATE jadwal SET hari = '$hari', tanggal = '$tanggal', tempat = '$tempat', nama_kelas = '$namaKelas',
            mapel = '$mapel', jam_mulai = '$jamMulai', jam_selesai = '$jamSelesai', nama_guru = '$namaGuru'  WHERE id_jadwal = '$id_jadwal';";

            $status = 'edit';

            $sql = mysqli_query($conn, $query); 
            header("location: Jadwal.php?status=sukses&aksi=$status");
        }
}

        if (isset($_GET['hapus'])) {   
            $id_jadwal = $_GET['hapus'];

            $query = "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal';";
            $sql = mysqli_query($conn, $query);
            $status = 'hapus';
        
            if ($sql) {
                header("location: Jadwal.php?status=sukses&aksi=$status");
            } else {
                echo $query;
            }
        }
?>