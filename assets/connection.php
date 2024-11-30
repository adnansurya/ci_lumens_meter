<?php 
$host = "localhost";
$username = "cond7572_root ";
$password = "UDTyT)],K*Cg";
$database = "cond7572_login";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("Koneksi Tidak Berhasil". mysqli_connect_error());
}