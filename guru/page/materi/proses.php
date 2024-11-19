<?php
require_once '../../helper/conek.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {
        
        // Mengambil nilai dari input form
        $judulMateri = $_POST['judul_materi'];
        $mapel = $_POST['mapel'];
        $namaKelas = $_POST['nama_kelas'];
        $fileMateri = $_POST['file_materi'];
        
        // Query untuk menambahkan data ke database
        $query = "INSERT INTO materi (judul_materi, mapel, nama_kelas, file_materi) 
                  VALUES ('$judulMateri', '$mapel', '$namaKelas', '$fileMateri')";

        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: Materi.php");
        }else{
            echo $query;
        }
        }else if($_POST['aksi'] == "edit"){
        // echo "edit data <a href='Materi.php'>[Home]</a>";

        $kodeMateri = $_POST['kode_materi'];
        $judulMateri = $_POST['judul_materi'];
        $mapel = $_POST['mapel'];
        $namaKelas = $_POST['nama_kelas'];
        $fileMateri = $_POST['file_materi'];

        $query = "UPDATE materi SET judul_materi = '$judulMateri', mapel = '$mapel', nama_kelas = '$namaKelas', file_materi = '$fileMateri'
        WHERE kode_materi = '$kodeMateri';";
        $sql = mysqli_query($conn, $query); 
        header("location: Materi.php");
        }
        }

        if (isset($_GET['hapus'])) {   
            $kodeMateri = $_GET['hapus'];  // Mengambil ID dari URL
            
            // Query untuk menghapus data
            $query = "DELETE FROM materi WHERE kode_materi = '$kodeMateri';";
            $sql = mysqli_query($conn, $query);
        
            if ($sql) {
                header("location: materi.php");
            } else {
                echo $query;
            }
        }
        ?>