<?php
require_once '../../helper/conek.php'; 

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){
            echo "tambah data";
        }else if($_POST['aksi'] == "edit"){
            echo "edit data";

        }
    }

    if(isset($_GET['hapus'])){   
        echo "hapus data";
    }
 ?>