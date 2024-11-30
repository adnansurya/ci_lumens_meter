<?php
include("koneksi.php");
if(!empty($_POST)){
$phValue = $_POST["phValue"];
$tdsValue = $_POST["tdsValue"];
date_default_timezone_set('Asia/Makassar');
$waktuindonesia = date("d F Y");
$jam = date("h:i:s A");
$query = "INSERT INTO data (tanggal, waktu, pressure_102, pressure_103)
VALUES ('$waktuindonesia', '$jam', $phValue, $tdsValue)";
if ($conn->query($query) === TRUE) {
echo "Berhasil menyimpan data ke table code";
} else {
echo "Error: " . $query . "<br>" . $conn->error;
}
}
?>