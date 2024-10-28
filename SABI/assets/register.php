<?php
require 'koneksi.php';

$username =  $_POST["Username"];
$email = $_POST["Email"];
$password = $_POST["Password"];

if (strlen($password) < 8) {
    echo "Password harus diisi minimal 8 karakter.";
    exit();
}

$query_sql = "INSERT INTO user_detail (username, email, password) 
              VALUES ('$username', '$email', '$password')";

if (mysqli_query($koneksi, $query_sql)) {
    header("Location: login.html");
} else {
    echo "Registrasi gagal: " . mysqli_error($koneksi);
}
?>
