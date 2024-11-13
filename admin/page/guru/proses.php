<?php
require_once '../../helper/conek.php'; 

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){

            $nama_guru = $_POST['nama_guru'];
            $email = $_POST['email_guru'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $foto = $_FILES['foto_guru']['name'];
            $telepon = $_POST['telepon_guru'];
            $alamat = $_POST['alamat_guru'];

            $dir = "../../images/foto_guru/";
            $tmpfile = $_FILES['foto_guru']['tmp_name'];

            move_uploaded_file($tmpfile, $dir.$foto);
            //die();

            $query = "INSERT INTO guru (nama_guru, email, jenis_kelamin, foto_guru, telepon, alamat) 
            VALUES ('$nama_guru', '$email', '$jenis_kelamin', '$foto', '$telepon', '$alamat')";

            $sql = mysqli_query($conn, $query);

            if($sql){
                header("location: ManajemenAkun-Guru.php");
            }else{
                echo $query;
            }
        }else if($_POST['aksi'] == "edit"){
            echo "edit data";

        }
    }

    if(isset($_GET['hapus'])){   
        $kode_guru = $_GET['hapus'];

        $queryshow = "SELECT * FROM guru WHERE kode_guru = '$kode_guru';";
        $sqlshow = mysqli_query($conn, $queryshow);
        $result = mysqli_fetch_assoc($sqlshow);

        unlink("../../images/foto_guru/".$result['foto_guru']);

        $query = "DELETE FROM guru WHERE kode_guru = '$kode_guru';";
        $sql = mysqli_query($conn, $query);

        if($sql){
            header("location: ManajemenAkun-Guru.php");
        }else{
            echo $query;
        }
    }
 ?>