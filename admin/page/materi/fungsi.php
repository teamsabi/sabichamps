<?php
    require_once '../../helper/conek.php';

    function tambah_data($data, $files){
        $judul_materi = $data['judul_materi'];
        $mapel = $data['mapel'];
        $kelas = $data['nama_kelas'];
        $split = explode('.', $files['file_materi']['name']);
        $ekstensi = $split[count($split)-1];
        $file = $judul_materi.'.'.$ekstensi;
        $nama_guru = $data['nama_guru'];

        $dir = "../../images/file_materi/";
        $tmpfile = $files['file_materi']['tmp_name'];

        move_uploaded_file($tmpfile, $dir.$file);

        $query = "INSERT INTO materi (judul_materi, mapel, kelas, file_materi, nama_guru) 
        VALUES ('$judul_materi', '$mapel', '$kelas', '$file', '$nama_guru')";

        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;
    }

    function ubah_data($data, $files){
        $kode_materi = $data['kode_materi'];
        $judul_materi = $data['judul_materi'];
        $mapel = $data['mapel'];
        $kelas = $data['nama_kelas'];
        $nama_guru = $data['nama_guru'];

        $queryshow = "SELECT * FROM materi WHERE kode_materi = '$kode_materi';";
        $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);
        $result = mysqli_fetch_assoc($sqlshow);

        if($files['file_materi']['name'] == ""){
            $file = $result['file_materi'];
        }else {

            $split = explode('.', $files['file_materi']['name']);
            $ekstensi = $split[count($split)-1];
            $file = $result['judul_materi'].'.'.$ekstensi;
            unlink("../../images/file_materi/".$result['file_materi']);
            move_uploaded_file($files['file_materi']['tmp_name'], '../../images/file_materi/'.$file);
        }

        $query = "UPDATE materi SET judul_materi = '$judul_materi', mapel = '$mapel',
        kelas = '$kelas', file_materi = '$file', nama_guru = '$nama_guru' WHERE kode_materi = '$kode_materi';";
        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;
    }

    function hapus_data($data){
        $kode_materi = $data['hapus'];

        $queryshow = "SELECT * FROM materi WHERE kode_materi = '$kode_materi';";
        $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);
        $result = mysqli_fetch_assoc($sqlshow);

        unlink("../../images/file_materi/".$result['file_materi']);

        $query = "DELETE FROM materi WHERE kode_materi = '$kode_materi';";
        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;

    }


?>