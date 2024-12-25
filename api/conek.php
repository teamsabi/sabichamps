<?php
    $host = 'wstif23.myhost.id';
    $user = 'wstifmy1_kelas_b';
    $pass = '@Polije164B';
    $db = 'wstifmy1_b_team5';

    $conn = mysqli_connect($host, $user, $pass, $db);

    if($conn){
        //echo 'koneksi berhasil';
    }

    mysqli_select_db($conn, $db);
 ?>