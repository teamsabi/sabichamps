<?php
require_once '../../helper/conek.php';

if (isset($_POST['aksi'])) {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($_POST['aksi'] == "add") {
        $query = "INSERT INTO user (username, email, password, role) VALUES ('$username', '$email', '$hashedPassword', '$role');";
    } elseif ($_POST['aksi'] == "edit") {
        $query = "UPDATE user SET username='$username', email='$email', password='$hashedPassword', role='$role' WHERE id_user='$id_user';";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: userlogin.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


if (isset($_GET['hapus'])) {
    $id_user = $_GET['hapus'];

    // Query untuk menghapus data
    $query = "DELETE FROM user WHERE id_user = '$id_user'";
    $sql = mysqli_query($conn, $query);

    if ($sql) {
        // Redirect jika berhasil
        header("Location: userlogin.php?pesan=hapus_sukses");
    } else {
        echo $sql;
    }
} else {
    header("Location: userlogin.php");
}

?>