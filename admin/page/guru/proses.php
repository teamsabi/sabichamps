<?php
require_once '../../helper/conek.php'; 

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){
            
            $nama_guru = $_POST['nama_guru'];
            $email = $_POST['email_guru'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $foto = "Syaiful.png";
            $telepon = $_POST['telepon_guru'];
            $alamat = $_POST['alamat_guru'];

            $query = "INSERT INTO guru (nama_guru, email, jenis_kelamin, foto_guru, telepon, alamat) 
            VALUES ('$nama_guru', '$email', '$jenis_kelamin', '$foto', '$telepon', '$alamat')";

            $sql = mysqli_query($conn, $query);

            if($sql){
                header("location: ManajemenAkun-Guru.php");
            }else{
                echo $query;
            }

            // echo $nama_guru." | ".$email." | ".$jenis_kelamin." | ".$foto." | ".$telepon." | ".$alamat;
            echo "<br>tambah data";
        }else if($_POST['aksi'] == "edit"){
            echo "edit data";

        }
    }

    if(isset($_GET['hapus'])){   
        //echo "hapus data";
        $kode_guru = $_GET['hapus'];
        $query = "DELETE FROM guru WHERE kode_guru = '$kode_guru'";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: ManajemenAkun-Guru.php");
        }else{
            echo $query;
        }
    }
 ?>