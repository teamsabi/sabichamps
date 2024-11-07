<?php

use PHPUnit\Framework\TestCase;

// Memasukkan file koneksi dan kelas Auth
require_once __DIR__ . '/../koneksi.php';
require_once __DIR__ . '/../Auth.php';

class AuthTest extends TestCase
{
    private $auth;

    protected function setUp(): void
    {
        // Mengakses variabel $koneksi dari koneksi.php
        global $koneksi;

        // Pastikan koneksi berhasil
        if ($koneksi === null) {
            $this->fail("Koneksi ke database gagal, periksa konfigurasi database Anda.");
        }

        // Inisialisasi objek Auth dengan koneksi database
        $this->auth = new Auth($koneksi);
    }

    public function testRegisterSuccess()
    {
        // Registrasi pengguna baru
        $result = $this->auth->register('testuser', 'password123');
        $this->assertTrue($result, "Registrasi berhasil seharusnya mengembalikan true.");
    }

    public function testLoginSuccess()
    {
        // Pastikan pengguna sudah terdaftar
        $this->auth->register('testuser', 'password123');

        // Login dengan data yang benar
        $result = $this->auth->login('testuser', 'password123');
        $this->assertTrue($result, "Login berhasil seharusnya mengembalikan true.");
    }

    public function testLoginFailure()
    {
        // Login dengan data yang salah
        $result = $this->auth->login('wronguser', 'wrongpassword');
        $this->assertFalse($result, "Login gagal seharusnya mengembalikan false.");
    }

    protected function tearDown(): void
    {
        // Hapus data uji untuk menjaga kebersihan database
        global $koneksi;
        $koneksi->exec("DELETE FROM user WHERE username = 'testuser'");
    }
}
