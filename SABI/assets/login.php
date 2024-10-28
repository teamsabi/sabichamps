<?php
require ('koneksi.php');

$email =$_POST["Email"];
$password =$_POST["Password"];

    $query = "SELECT * FROM `user_detail` WHERE email ='$email' AND password ='$password'";
    $result = mysqli_query($koneksi, $query);

if(mysqli_num_rows($result) >0){
    header("Location= dashboard.html");
}else{
    $php_errormsg = 'user atau password salah!!';
    header("Location= login.html");
}



 ?>