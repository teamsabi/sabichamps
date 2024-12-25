<?php
header('Content-Type: application/json');
session_start();

// Koneksi database
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'sabi';

// Buat koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die(json_encode(['status' => 'error', 'message' => 'Koneksi database gagal: ' . mysqli_connect_error()]));
}

// Inisialisasi response
$response = [];

// Pastikan request method adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form-data
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        // Validasi input
        if (empty($username) || empty($email) || empty($password)) {
            $response = [
                'status' => 'error',
                'message' => "Username, Email, dan Password tidak boleh kosong!"
            ];
        } elseif (strlen($password) < 8) {
            $response = [
                'status' => 'error',
                'message' => "Password harus berisi minimal 8 karakter!"
            ];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = [
                'status' => 'error',
                'message' => "Format email tidak valid!"
            ];
        } else {
            // Cek apakah email sudah terdaftar
            $query = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($koneksi, $query);

            if (mysqli_num_rows($result) > 0) {
                $response = [
                    'status' => 'error',
                    'message' => 'Email sudah terdaftar!'
                ];
            } else {
                // Enkripsi password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Query untuk insert data registrasi
                $insertQuery = "INSERT INTO user (username, email, password, role) 
                                VALUES ('$username', '$email', '$hashedPassword', 'siswa')";
                
                if (mysqli_query($koneksi, $insertQuery)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Registrasi berhasil!',
                        'user_data' => [
                            'username' => $username,
                            'email' => $email,
                            'role' => 'siswa'
                        ]
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan saat registrasi, coba lagi!'
                    ];
                }
            }
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Username, Email, dan Password harus disertakan'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Metode HTTP tidak valid, hanya POST yang diperbolehkan.'
    ];
}

// Menutup koneksi
mysqli_close($koneksi);

// Mengirimkan respons JSON ke client
echo json_encode($response);
?>
