<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "sabi";
$koneksi = mysqli_connect($server, $username, $password, $db);

if (!$koneksi) {
    die("Koneksi Gagal : ".mysqli_connect_error());
}else {
    echo "Koneksi Berhasil";
}
?>