<?php

/**
 * Class Auth untuk melakukan login dan registrasi user baru
 */
class Auth
{
    private $db;       // Menyimpan koneksi database
    private $error;    // Menyimpan pesan error terakhir

    /**
     * Konstruktor untuk inisialisasi koneksi dan sesi
     */
    public function __construct($db_conn)
    {
        $this->db = $db_conn;

        // Cek apakah sesi sudah aktif, jika belum mulai sesi
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Registrasi User baru
     */
    public function register($username, $email, $password, $role = 'guru') {
        try {
            // Validasi panjang password
            if (strlen($password) < 8) {
                $this->error = "Password harus berisi minimal 8 karakter!";
                return false;
            }
    
            // Masukkan user baru ke database dengan role yang diinputkan
            $stmt = $this->db->prepare("INSERT INTO user (username, email, password, role) 
                                        VALUES (:username, :email, :pass, :role)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pass", $password); // Simpan password langsung
            $stmt->bindParam(":role", $role);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            // Tangani error jika email sudah digunakan
            if ($e->errorInfo[0] == 23000) {
                $this->error = "Email sudah digunakan!";
            } else {
                $this->error = "Terjadi kesalahan: " . $e->getMessage();
            }
            return false;
        }
    }
    
    

    /**
     * Login User
     */
    public function login($email, $password) {
        try {
            // Validasi panjang password
            if (strlen($password) < 8) {
                $this->error = "Password harus berisi minimal 8 karakter!";
                return false;
            }
    
            // Periksa apakah email ada dalam database
            $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $data = $stmt->fetch();
    
            // Jika email ditemukan dan password sesuai
            if ($data && $password === $data['password']) { // Langsung bandingkan password
                // Simpan data penting ke dalam sesi
                $_SESSION['user_session'] = $data['id_user'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['role'] = $data['role']; // Tambahkan role ke sesi untuk keperluan otorisasi
                return true;
            } else {
                // Jika email tidak ditemukan atau password salah
                $this->error = "Email atau Password salah.";
                return false;
            }
        } catch (PDOException $e) {
            // Tangani error dari PDO
            $this->error = "Terjadi kesalahan: " . $e->getMessage();
            return false;
        }
    }
    

    public function getUserRole()
    {
        if (isset($_SESSION['user_session'])) {
            $stmt = $this->db->prepare("SELECT role FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $_SESSION['user_session']);
            $stmt->execute();
            $data = $stmt->fetch();
            return $data['role'] ?? null; // Kembalikan role atau null jika tidak ditemukan
        }
        return null; // Jika sesi tidak ada
    }


    /**
     * Cek apakah user sudah login
     */
    public function isLoggedIn()
    {
        return isset($_SESSION['user_session']);
    }

    /**
     * Ambil data user yang sudah login
     */
    public function getUser()
    {
        if (!$this->isLoggedIn()) return false;

        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id");
            $stmt->bindParam(":id", $_SESSION['user_session']);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            $this->error = "Terjadi kesalahan: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        // Hapus sesi dan destroy session
        session_unset();
        session_destroy();
        return true;
    }

    /**
     * Ambil pesan error terakhir
     */
    public function getLastError()
    {
        return $this->error;
    }
}
?>

