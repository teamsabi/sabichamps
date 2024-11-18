<?php
    require_once '../../helper/conek.php';

    function tambah_data($data, $files){
        $nama_guru = $data['nama_guru'];
        $email = $data['email_guru'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $split = explode('.', $files['foto_guru']['name']);
        $ekstensi = $split[count($split)-1];
        $foto = $nama_guru.'.'.$ekstensi;
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
        $kode_guru = $data['kode_guru'];
        $nama_guru = $data['nama_guru'];
        $email = $data['email_guru'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $telepon = $data['telepon_guru'];
        $alamat = $data['alamat_guru'];

        $queryshow = "SELECT * FROM guru WHERE kode_guru = '$kode_guru';";
        $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);
        $result = mysqli_fetch_assoc($sqlshow);

        if($files['foto_guru']['name'] == ""){
            $foto = $result['foto_guru'];
        }else {

            $split = explode('.', $files['foto_guru']['name']);
            $ekstensi = $split[count($split)-1];
            $foto = $result['nama_guru'].'.'.$ekstensi;
            unlink("../../images/foto_guru/".$result['foto_guru']);
            move_uploaded_file($files['foto_guru']['tmp_name'], '../../images/foto_guru/'.$foto);
        }

        $query = "UPDATE guru SET nama_guru = '$nama_guru', email = '$email',
        jenis_kelamin = '$jenis_kelamin', foto_guru = '$foto', telepon = '$telepon', alamat = '$alamat' WHERE kode_guru = '$kode_guru';";
        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;
    }

    function hapus_data($data){
        $kode_guru = $data['hapus'];

        $queryshow = "SELECT * FROM guru WHERE kode_guru = '$kode_guru';";
        $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);
        $result = mysqli_fetch_assoc($sqlshow);

        unlink("../../images/foto_guru/".$result['foto_guru']);

        $query = "DELETE FROM guru WHERE kode_guru = '$kode_guru';";
        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;

    }


?>