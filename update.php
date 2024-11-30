<?php
// Mengambil data dari formulir
$ppmA = $_POST['ppmA'];
$ppmB = $_POST['ppmB'];
$phsetA = $_POST['phsetA'];
$phsetB = $_POST['phsetB'];

// Konfigurasi koneksi ke database MySQL
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'login';

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil atau tidak
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk melakukan update data di tabel
$sql = "UPDATE hiro SET nilai1='$ppmA', nilai2='$ppmB', nilai3 = '$phsetA', nilai4 ='$phsetB' WHERE id='1'";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil diupdate di database.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi ke database
$conn->close();
?>
