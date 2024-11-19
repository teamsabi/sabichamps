<?php
require_once 'fungsi.php'; 
session_start();

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){

            $berhasil = tambah_data($_POST, $_FILES);

            if($berhasil){
                $_SESSION['status'] = "Data Berhasil Ditambahkan";
                header("location: ManajemenAkun-Guru.php");
            }else{
                echo $berhasil;
            }
        }else if($_POST['aksi'] == "edit"){
            
            $berhasil = ubah_data($_POST, $_FILES);

             
            if($berhasil){
                $_SESSION['status'] = "Data Berhasil Diubah";
                header("location: ManajemenAkun-Guru.php");
            }else{
                echo $berhasil;
            }


        }
    }

    if(isset($_GET['hapus'])){   
        
        $berhasil = hapus_data($_GET);

        if($berhasil){
            $_SESSION['status'] = "Data Telah Dihapus";
            header("location: ManajemenAkun-Guru.php");
        }else{
            echo $berhasil;
        }
    }
 ?>