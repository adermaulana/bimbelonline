<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "database_bimbel_221047";

    $koneksi = mysqli_connect($server,$user,$pass,$database) or die(mysqli_error($koneksi));
?>