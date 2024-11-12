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
    public function register($username, $email, $password)
    {
        try {
            // Hash password sebelum disimpan
            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan user baru ke database
            $stmt = $this->db->prepare("INSERT INTO user (username, email, password) 
                                        VALUES (:username, :email, :pass)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pass", $hashPasswd);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            // Tangani error jika email sudah digunakan (duplicate entry)
            if ($e->errorInfo[0] == 23000) { // 23000 adalah kode error duplicate entry
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
    public function login($email, $password)
{
    try {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $data = $stmt->fetch();

        if ($data && password_verify($password, $data['password'])) {
            // Simpan ID dan username ke dalam sesi
            $_SESSION['user_session'] = $data['id_user'];
            $_SESSION['username'] = $data['username']; // Tambahkan ini
            return true;
        } else {
            $this->error = "Email atau Password Salah";
            return false;
        }
    } catch (PDOException $e) {
        $this->error = "Terjadi kesalahan: " . $e->getMessage();
        return false;
    }
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

