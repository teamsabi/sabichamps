<?php
require_once 'connection.php';

$response = array();

// Pastikan koneksi berhasil
if ($con) {
    // Cek apakah semua data `$_POST` telah di-set
    if (isset($_POST['email'], $_POST['password'], $_POST['kelas'])) {

        // Ambil data dari input
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $kelas    = $_POST['kelas'];

        // Pastikan tidak ada field yang kosong
        if ($email !== "" && $password !== "" && $kelas !== "") {

            // Cek apakah email sudah ada di database
            $checkStmt = mysqli_prepare($con, "SELECT * FROM user WHERE email = ?");
            mysqli_stmt_bind_param($checkStmt, "s", $email);
            mysqli_stmt_execute($checkStmt);
            mysqli_stmt_store_result($checkStmt);

            if (mysqli_stmt_num_rows($checkStmt) > 0) {
                // Jika email sudah ada
                array_push($response, array('status' => 'FAILED', 'message' => 'Email already exists.'));
            } else {
                // Hash password sebelum menyimpannya ke database
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Gunakan prepared statement untuk menghindari SQL injection
                $stmt = mysqli_prepare($con, "INSERT INTO user(email, password,  kelas) VALUES (?,?,?)");
                mysqli_stmt_bind_param($stmt, "ssss", $email, $hashedPassword, $kelas);

                if (mysqli_stmt_execute($stmt)) {
                    array_push($response, array('status' => 'OK', 'message' => 'Data successfully inserted.'));
                } else {
                    array_push($response, array('status' => 'FAILED', 'message' => 'Failed to execute query.'));
                }

                // Tutup prepared statement
                mysqli_stmt_close($stmt);
            }

            // Tutup statement untuk pengecekan email
            mysqli_stmt_close($checkStmt);
        } else {
            array_push($response, array('status' => 'FAILED', 'message' => 'Some fields are empty.'));
        }
    } else {
        array_push($response, array('status' => 'FAILED', 'message' => 'Some fields are missing.'));
    }
} else {
    array_push($response, array('status' => 'FAILED', 'message' => 'Database connection failed.'));
}

// Keluarkan response dalam format JSON
echo json_encode(array("server_response" => $response));

// Tutup koneksi
mysqli_close($con);
