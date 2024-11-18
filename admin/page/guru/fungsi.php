<?php
    require_once '../../helper/conek.php';

    function tambah_data($data, $files){
        $nama_guru = $data['nama_guru'];
        $email = $data['email_guru'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $foto = $files['foto_guru']['name'];
        $telepon = $data['telepon_guru'];
        $alamat = $data['alamat_guru'];

        $dir = "../../images/foto_guru/";
        $tmpfile = $files['foto_guru']['tmp_name'];

        move_uploaded_file($tmpfile, $dir.$foto);

        $query = "INSERT INTO guru (nama_guru, email, jenis_kelamin, foto_guru, telepon, alamat) 
        VALUES ('$nama_guru', '$email', '$jenis_kelamin', '$foto', '$telepon', '$alamat')";

        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;
    }

    function ubah_data($data, $files){
        $kode_guru = $_POST['kode_guru'];
        $nama_guru = $_POST['nama_guru'];
        $email = $_POST['email_guru'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $telepon = $_POST['telepon_guru'];
        $alamat = $_POST['alamat_guru'];

        $queryshow = "SELECT * FROM guru WHERE kode_guru = '$kode_guru';";
        $sqlshow = mysqli_query($conn, $queryshow);
        $result = mysqli_fetch_assoc($sqlshow);

        if($_FILES['foto_guru']['name'] == ""){
            $foto = $result['foto_guru'];
        }else {
            $foto = $_FILES['foto_guru']['name'];
            unlink("../../images/foto_guru/".$result['foto_guru']);
            move_uploaded_file($_FILES['foto_guru']['tmp_name'], '../../images/foto_guru/'.$_FILES['foto_guru']['name']);
        }

        $query = "UPDATE guru SET nama_guru = '$nama_guru', email = '$email',
        jenis_kelamin = '$jenis_kelamin', foto_guru = '$foto', telepon = '$telepon', alamat = '$alamat' WHERE kode_guru = '$kode_guru';";
        $sql = mysqli_query($conn, $query);
    }


?>