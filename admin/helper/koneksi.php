<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "sabi";

try {
    $koneksi = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>


