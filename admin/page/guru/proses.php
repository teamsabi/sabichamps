<?php
require_once 'fungsi.php'; 

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){

            $berhasil = tambah_data($_POST, $_FILES);

            if($berhasil){
                header("location: ManajemenAkun-Guru.php");
            }else{
                echo $berhasil;
            }
        }else if($_POST['aksi'] == "edit"){
            // echo "edit data <a href='ManajemenAkun-Guru.php'>[Home]</a>";

             
            header("location: ManajemenAkun-Guru.php");


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