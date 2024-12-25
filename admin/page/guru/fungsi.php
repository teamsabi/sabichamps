<?php
    require_once '../../helper/config.php';

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

        $query = "INSERT INTO user (nama_lengkap, email, jenis_kelamin, foto_guru, telepon, alamat) 
        VALUES ('$nama_guru', '$email', '$jenis_kelamin', '$foto', '$telepon', '$alamat')";

        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;
    }

    function ubah_data($data, $files){
        $id_user = $data['id_user'];
        $nama_guru = $data['nama_guru'];
        $email = $data['email_guru'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $telepon = $data['telepon_guru'];
        $alamat = $data['alamat_guru'];
    
        // Query untuk mencari data pengguna
        $queryshow = "SELECT * FROM user WHERE id_user = '$id_user';";
        $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);
    
        // Cek apakah data pengguna ditemukan
        if (!$sqlshow || mysqli_num_rows($sqlshow) == 0) {
            // Jika tidak ada data pengguna, lakukan insert data baru
            $foto = $files['foto_guru']['name'] == "" ? "" : $files['foto_guru']['name']; // Jika tidak ada foto, biarkan kosong
            
            // Jika ada foto baru, upload
            if($foto != "") {
                $split = explode('.', $foto);
                $ekstensi = $split[count($split)-1];
                $foto = $nama_guru . '.' . $ekstensi;  // Gunakan nama guru sebagai nama foto
    
                move_uploaded_file($files['foto_guru']['tmp_name'], '../../images/foto_guru/'.$foto);
            }
    
            // Query untuk insert data baru
            $query = "INSERT INTO user (id_user, nama_lengkap, email, jenis_kelamin, foto_guru, telepon, alamat) 
                      VALUES ('$id_user', '$nama_guru', '$email', '$jenis_kelamin', '$foto', '$telepon', '$alamat');";
            $sql = mysqli_query($GLOBALS['conn'], $query);
    
            return true;
        } else {
            // Jika data pengguna sudah ada, lakukan update
            $result = mysqli_fetch_assoc($sqlshow);
    
            // Jika tidak ada file foto baru, gunakan foto lama
            if($files['foto_guru']['name'] == "") {
                $foto = $result['foto_guru'];
            } else {
                $split = explode('.', $files['foto_guru']['name']);
                $ekstensi = $split[count($split)-1];
                $foto = $nama_guru . '.' . $ekstensi;
    
                // Hapus foto lama dan unggah foto baru
                unlink("../../images/foto_guru/".$result['foto_guru']);
                move_uploaded_file($files['foto_guru']['tmp_name'], '../../images/foto_guru/'.$foto);
            }
    
            // Query untuk memperbarui data pengguna
            $query = "UPDATE user SET nama_lengkap = '$nama_guru', email = '$email', jenis_kelamin = '$jenis_kelamin', foto_guru = '$foto', telepon = '$telepon', alamat = '$alamat' WHERE id_user = '$id_user';";
            $sql = mysqli_query($GLOBALS['conn'], $query);
    
            return true;
        }
    }
    
    
    

    function hapus_data($data) {
        $id_user = $data['hapus'];
    
        // Query untuk mengambil data pengguna
        $queryshow = "SELECT * FROM user WHERE id_user = '$id_user';";
        $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);
        
        if (!$sqlshow || mysqli_num_rows($sqlshow) == 0) {
            die("Pengguna tidak ditemukan.");
        }
    
        $result = mysqli_fetch_assoc($sqlshow);
    
        // Menghapus foto pengguna jika ada
        unlink("../../images/foto_guru/".$result['foto_guru']);
    
        // Menghapus data terkait di tabel kelas_user
        $query_delete_kelas_user = "DELETE FROM kelas_user WHERE id_user = '$id_user';";
        mysqli_query($GLOBALS['conn'], $query_delete_kelas_user);
    
        // Menghapus data pengguna dari tabel user
        $query = "DELETE FROM user WHERE id_user = '$id_user';";
        $sql = mysqli_query($GLOBALS['conn'], $query);
    
        return true;
    }
    


?>