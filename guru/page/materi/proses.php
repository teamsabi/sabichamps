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

    if(isset($_GET['hapus'])){   
        
        $berhasil = hapus_data($_GET);

        if($berhasil){
            header("location: Materi.php?status=success&message=Data Materi berhasil dihapus");
        }else{
            header("location: Materi.php?status=error&message=$berhasil");
        }
    }
 ?>