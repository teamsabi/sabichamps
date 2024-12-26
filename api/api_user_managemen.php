<?php
require_once '../../helper/config.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

$response = ["status" => "error", "message" => "Invalid request"];

if ($method === 'POST' && isset($input['aksi'])) {
    $aksi = $input['aksi'];

    if ($aksi === "edit") {
        $id_user = $input['id_user'];
        $nama_siswa = $input['nama_siswa'];
        $email = $input['email_siswa'];
        $jenis_kelamin = $input['jenis_kelamin'];
        $telepon = $input['telepon_siswa'];
        $tanggal_lahir = $input['tanggal_lahir'];
        $kelas = $input['kelas'];
        $ortu = $input['ortu_wali'];
        $alamat = $input['alamat_siswa'];

        $query_user = "UPDATE user SET 
                      nama_lengkap = '$nama_siswa', 
                      email = '$email', 
                      jenis_kelamin = '$jenis_kelamin', 
                      telepon = '$telepon', 
                      tanggal_lahir = '$tanggal_lahir', 
                      nama_ortu_wali = '$ortu', 
                      alamat = '$alamat'
                      WHERE id_user = '$id_user'";

        $kelas_query = "SELECT kode_kelas FROM kelas WHERE nama_kelas = '$kelas'";
        $result_kelas = mysqli_query($conn, $kelas_query);

        if ($result_kelas && mysqli_num_rows($result_kelas) > 0) {
            $kelas_data = mysqli_fetch_assoc($result_kelas);
            $kode_kelas = $kelas_data['kode_kelas'];

            $cek_kelas_user = "SELECT * FROM kelas_user WHERE id_user = '$id_user'";
            $result_kelas_user = mysqli_query($conn, $cek_kelas_user);

            if (mysqli_num_rows($result_kelas_user) > 0) {
                $query_kelas_user = "UPDATE kelas_user SET kode_kelas = '$kode_kelas' WHERE id_user = '$id_user'";
            } else {
                $query_kelas_user = "INSERT INTO kelas_user (id_user, kode_kelas) VALUES ('$id_user', '$kode_kelas')";
            }

            $conn->begin_transaction();
            try {
                if (mysqli_query($conn, $query_user) && mysqli_query($conn, $query_kelas_user)) {
                    $conn->commit();
                    $response = ["status" => "success", "message" => "Data berhasil diperbarui"];
                } else {
                    throw new Exception('Gagal memperbarui data');
                }
            } catch (Exception $e) {
                $conn->rollback();
                $response = ["status" => "error", "message" => $e->getMessage()];
            }
        } else {
            $response = ["status" => "error", "message" => "Kelas tidak ditemukan"];
        }
    } elseif ($aksi === "add") {
        $nama_siswa = $input['nama_siswa'];
        $email = $input['email_siswa'];
        $jenis_kelamin = $input['jenis_kelamin'];
        $telepon = $input['telepon_siswa'];
        $tanggal_lahir = $input['tanggal_lahir'];
        $kelas = $input['kelas'];
        $ortu = $input['ortu_wali'];
        $alamat = $input['alamat_siswa'];

        $kelas_query = "SELECT kode_kelas FROM kelas WHERE nama_kelas = '$kelas'";
        $result_kelas = mysqli_query($conn, $kelas_query);

        if ($result_kelas && mysqli_num_rows($result_kelas) > 0) {
            $kelas_data = mysqli_fetch_assoc($result_kelas);
            $kode_kelas = $kelas_data['kode_kelas'];
        } else {
            echo json_encode(["status" => "error", "message" => "Kelas tidak ditemukan"]);
            exit;
        }

        $query_user = "INSERT INTO user (nama_lengkap, email, jenis_kelamin, telepon, tanggal_lahir, nama_ortu_wali, alamat)
                       VALUES ('$nama_siswa', '$email', '$jenis_kelamin', '$telepon', '$tanggal_lahir', '$ortu', '$alamat')";

        $conn->begin_transaction();
        try {
            if (mysqli_query($conn, $query_user)) {
                $last_id = mysqli_insert_id($conn);
                $query_kelas_user = "INSERT INTO kelas_user (id_user, kode_kelas) VALUES ('$last_id', '$kode_kelas')";

                if (mysqli_query($conn, $query_kelas_user)) {
                    $conn->commit();
                    $response = ["status" => "success", "message" => "Data berhasil ditambahkan"];
                } else {
                    throw new Exception('Gagal menambahkan data kelas_user');
                }
            } else {
                throw new Exception('Gagal menambahkan data siswa');
            }
        } catch (Exception $e) {
            $conn->rollback();
            $response = ["status" => "error", "message" => $e->getMessage()];
        }
    }
}

echo json_encode($response);
?>
