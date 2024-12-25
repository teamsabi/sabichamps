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

// Inisialisasi variabel untuk error dan input
$response = []; // Pastikan response didefinisikan
$emailValue = '';
$passwordValue = '';

// Pastikan request method adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data email dan password dari form-data
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $emailValue = $email;
        $passwordValue = $password;

        // Validasi input
        if (empty($email) && empty($password)) {
            $response = [
                'status' => 'error',
                'message' => "Email dan Password tidak boleh kosong!"
            ];
        } elseif (empty($email)) {
            $response = [
                'status' => 'error',
                'message' => "Email tidak boleh kosong!"
            ];
        } elseif (empty($password)) {
            $response = [
                'status' => 'error',
                'message' => "Password tidak boleh kosong!"
            ];
        } else {
            // Query untuk mencari user berdasarkan email
            $query = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($koneksi, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);

                // Verifikasi password tanpa hashing
                if ($password === $user['password']) {
                    // Pastikan hanya siswa yang bisa login
                    if ($user['role'] === 'siswa') {
                        // Simpan informasi user ke session
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = $user['role'];

                        // Respons login berhasil
                        $response = [
                            'status' => 'success',
                            'message' => 'Login berhasil',
                            'user_data' => $user  // Menampilkan semua data user
                        ];
                    } else {
                        // Jika role bukan siswa
                        $response = [
                            'status' => 'error',
                            'message' => 'Hanya siswa yang dapat login'
                        ];
                    }
                } else {
                    // Jika password tidak valid
                    $response = [
                        'status' => 'error',
                        'message' => 'Email atau password salah'
                    ];
                }
            } else {
                // Jika email tidak ditemukan
                $response = [
                    'status' => 'error',
                    'message' => 'Email tidak terdaftar'
                ];
            }
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Email dan password harus disertakan'
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
