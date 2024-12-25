<?php
require_once 'fungsi.php'; 
session_start();

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){

            $berhasil = tambah_data($_POST, $_FILES);

            if($berhasil){
                header("location: Materi.php?status=success&message=Data Materi berhasil ditambahkan");
            }else{
                header("location: Materi.php?status=error&message=$berhasil");
            }
        }else if($_POST['aksi'] == "edit"){
            
            $berhasil = ubah_data($_POST, $_FILES);

             
            if($berhasil){
                header("location: Materi.php?status=success&message=Data Materi berhasil diubah");
            }else{
                header("location: Materi.php?status=error&message=$berhasil");
            }


        }
    }

    if (isset($_GET['hapus'])) {
        $id_materi = $_GET['hapus'];
        $result = hapus_data($id_materi);
        
        if ($result === true) {
            // Redirect ke halaman dengan status berhasil
            header("Location: materi.php?status=success&message=Data berhasil dihapus.");
        } else {
            // Redirect ke halaman dengan status gagal
            header("Location: materi.php?status=error&message=$result");
        }
    }
    
 ?>