<?php
require_once '../../helper/conek.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {

        // Mengambil nilai dari input form
        $judulMateri = $_POST['judul_materi'];
        $mapel = $_POST['mapel'];
        $namaKelas = $_POST['nama_kelas'];
        $fileMateri = $_FILES ['file_materi']['name'];

        $dir = "C:/laragon/www/sabiwebsite/guru/file/";
        $file_name = $_FILES['file_materi']['name'];
        move_uploaded_file($_FILES['file_materi']['tmp_name'], $dir.$file_name);

        // Query untuk menambahkan data ke database
        $query = "INSERT INTO materi (judul_materi, mapel, nama_kelas, file_materi) 
                  VALUES ('$judulMateri', '$mapel', '$namaKelas', '$fileMateri')";

        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: Materi.php");
        }else{
            echo $query;
        }
    }

        if ($_POST['aksi'] == "edit") {
            $judulMateri = $_POST['judul_materi'];
            $mapel = $_POST['mapel'];
            $namaKelas = $_POST['nama_kelas'];

            $queryShow = "SELECT file_materi FROM materi WHERE kode_materi = '$kodeMateri'";
            $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);

            if (mysqli_num_rows($sqlShow) > 0) {
                $data = mysqli_fetch_assoc($sqlShow);
                $fileLama = $data['file_materi'];

            if ($_FILES['file_materi']['name'] != "") {
            // Jika ada file baru, proses penggantian file
            $split = explode('.', $_FILES['file_materi']['name']);
            $ekstensi = $split[count($split) - 1];
            $fileMateri = uniqid() . '.' . $ekstensi; // Nama file baru unik
            $filePathLama = "C:/laragon/www/sabiwebsite/guru/file/" . $fileLama;
    
            if (file_exists($filePathLama)) {
                unlink($filePathLama);
            }

            // Simpan file baru
            move_uploaded_file($_FILES['file_materi']['tmp_name'], "C:/laragon/www/sabiwebsite/guru/file/" . $fileMateri);
            } else {
            // Jika tidak ada file baru, gunakan file lama
            $fileMateri = $fileLama;
            }

            $query = "UPDATE materi 
                  SET judul_materi = '$judulMateri', mapel = '$mapel', nama_kelas = '$namaKelas', file_materi = '$fileMateri' 
                  WHERE kode_materi = '$kodeMateri'";
            $sql = mysqli_query($conn, $query);

    
            if ($sql) {
                header("location: Materi.php"); // Redirect ke halaman materi
            } else {
                echo "Error: " . mysqli_error($conn); // Tampilkan error jika query gagal
            }
        } else {
            echo "Data tidak ditemukan!";
        }
    }
}

        if (isset($_GET['hapus'])) {   
            $kodeMateri = $_GET['hapus'];  // Mengambil ID dari URL
            
            // Ambil informasi file materi berdasarkan kode_materi
            $queryShow = "SELECT * FROM materi WHERE kode_materi = '$kodeMateri'";
            $sqlShow = mysqli_query($conn, $queryShow);
        
            if (mysqli_num_rows($sqlShow) > 0) { // Pastikan data ditemukan
                $row = mysqli_fetch_assoc($sqlShow); // Ambil data sebagai array asosiatif
        
                // Hapus file dari folder jika ada
                $filePath = "C:/laragon/www/sabiwebsite/guru/file/" . $row['file_materi'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file dari folder
                }
        
                // Query untuk menghapus data dari database
                $query = "DELETE FROM materi WHERE kode_materi = '$kodeMateri'";
                $sql = mysqli_query($conn, $query);
                
                if ($sql) {
                    header("location: materi.php"); // Redirect ke halaman materi
                } else {
                    echo "Error: " . $query; // Tampilkan error jika query gagal
                }
            } else {
                echo "Data tidak ditemukan!"; // Tampilkan pesan jika data tidak ditemukan
            }
        }
        
        ?>