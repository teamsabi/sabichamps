<?php
require_once '../../helper/config.php';

// Fungsi untuk tambah data materi
function tambah_data($post, $files) {
    global $conn;

    // Ambil data dari form
    $judul_materi = $post['judul_materi'];
    $kode_mapel = $post['mapel'];
    $nama_lengkap = $post['nama_lengkap'];

    // Proses upload file materi
    $file_materi = $files['file_materi']['name'];
    $tmp_file = $files['file_materi']['tmp_name'];
    $path = "../../file/"; // Pastikan ini sesuai dengan path folder upload Anda
    $file_upload = $path . basename($file_materi);

    // Validasi jika file diupload
    if ($file_materi) {
        if (!move_uploaded_file($tmp_file, $file_upload)) {
            return "Gagal mengupload file materi.";
        }
    }

    // Query Insert Materi
    $query = "
        INSERT INTO materi (judul_materi, kode_mapel, file_materi)
        VALUES ('$judul_materi', '$kode_mapel', '$file_materi')
    ";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        // Ambil ID materi yang baru dimasukkan
        $id_materi = mysqli_insert_id($conn);

        // Insert ke tabel materi_siswa
        $insert_siswa = "
            INSERT INTO materi_siswa (id_materi, id_user)
            VALUES ('$id_materi', '$nama_lengkap')
        ";
        mysqli_query($conn, $insert_siswa);
        return true;
    } else {
        return "Gagal menambahkan materi!";
    }
}

function ubah_data($post, $files) {
    global $conn;

    // Ambil data dari form
    $judul_materi = $post['judul_materi'];
    $kode_mapel = $post['mapel'];
    $nama_lengkap = $post['nama_lengkap'];
    $id_materi = $post['kode_materi'];

    // Cek apakah ada file baru yang diupload
    $file_materi = isset($files['file_materi']['name']) ? $files['file_materi']['name'] : '';
    $tmp_file = $files['file_materi']['tmp_name'];
    $path = "../../file/"; // Pastikan path sudah benar
    $file_upload = $path . basename($file_materi);

    // Ambil nama file lama dari database
    $query = "SELECT file_materi FROM materi WHERE id_materi = '$id_materi'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $file_lama = $row['file_materi'];

    if ($file_materi) {
        // Jika ada file baru, hapus file lama dari direktori
        $file_lama_path = $path . $file_lama;
        if (file_exists($file_lama_path)) {
            unlink($file_lama_path); // Hapus file lama
        }

        // Upload file baru
        if (!move_uploaded_file($tmp_file, $file_upload)) {
            return "Gagal mengupload file materi.";
        }
    } else {
        // Jika tidak ada file baru, gunakan file lama
        $file_materi = $file_lama;
    }

    // Query Update Materi
    $query = "
        UPDATE materi 
        SET 
            judul_materi = '$judul_materi', 
            kode_mapel = '$kode_mapel',
            file_materi = '$file_materi'
        WHERE id_materi = '$id_materi'
    ";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        // Update di tabel materi_siswa
        $update_siswa = "
            UPDATE materi_siswa 
            SET id_user = '$nama_lengkap' 
            WHERE id_materi = '$id_materi'
        ";
        mysqli_query($conn, $update_siswa);
        return true;
    } else {
        return "Gagal memperbarui materi!";
    }
}

// Fungsi untuk hapus data materi dari database dan file di direktori
function hapus_data($id_materi) {
    global $conn;

    // Ambil nama file materi yang akan dihapus
    $query = "SELECT file_materi FROM materi WHERE id_materi = '$id_materi'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        $file_materi = $row['file_materi'];
        $path = "../../file/";  // Path direktori file
        $file_path = $path . $file_materi;
        
        // Hapus file dari direktori
        if (file_exists($file_path)) {
            unlink($file_path);  // Menghapus file
        }
        
        // Hapus data dari tabel materi_siswa
        $delete_siswa = "DELETE FROM materi_siswa WHERE id_materi = '$id_materi'";
        mysqli_query($conn, $delete_siswa);

        // Hapus data materi dari tabel materi
        $delete_materi = "DELETE FROM materi WHERE id_materi = '$id_materi'";
        $sql = mysqli_query($conn, $delete_materi);
        
        if ($sql) {
            return true;
        } else {
            return "Gagal menghapus data materi!";
        }
    } else {
        return "Materi tidak ditemukan!";
    }
}
?>
