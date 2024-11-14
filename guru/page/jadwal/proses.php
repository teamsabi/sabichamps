<?php
require_once '../../helper/conek.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {
        
        // Mengambil nilai dari input form
        $hari = $_POST['hari'];
        $namaKelas = $_POST['nama_kelas'];
        $mapel = $_POST['mapel'];
        $jamMulai = $_POST['jam_mulai'];
        $jamSelesai = $_POST['jam_selesai'];
        $namaGuru = $_POST['nama_guru'];
        
        // Query untuk menambahkan data ke database
        $query = "INSERT INTO jadwal (hari, nama_kelas, mapel, jam_mulai, jam_selesai, nama_guru) 
                  VALUES ('$hari', '$namaKelas', '$mapel', '$jamMulai', '$jamSelesai', '$namaGuru')";

        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: Jadwal.php");
        }else{
            echo $query;
        }
        }else if($_POST['aksi'] == "edit"){
        // echo "edit data <a href='Jadwal.php'>[Home]</a>";

        $id_jadwal = $_POST['id_jadwal'];
        $hari = $_POST['hari'];
        $namaKelas = $_POST['nama_kelas'];
        $mapel = $_POST['mapel'];
        $jamMulai = $_POST['jam_mulai'];
        $jamSelesai = $_POST['jam_selesai'];
        $namaGuru = $_POST['nama_guru'];

        $query = "UPDATE jadwal SET hari = '$hari', nama_kelas = '$namaKelas',
        mapel = '$mapel', jam_mulai = '$jamMulai', jam_selesai = '$jamSelesai', nama_guru = '$namaGuru'  WHERE id_jadwal = '$id_jadwal';";
        $sql = mysqli_query($conn, $query); 
        header("location: Jadwal.php");
        }
        }

        if (isset($_GET['hapus'])) {   
            $id_jadwal = $_GET['hapus'];  // Mengambil ID dari URL
            
            // Query untuk menghapus data
            $query = "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal';";
            $sql = mysqli_query($conn, $query);
        
            if ($sql) {
                header("location: Jadwal.php");
            } else {
                echo $query;
            }
        }
        ?>