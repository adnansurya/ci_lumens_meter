<?php
include("koneksi.php");
if(!empty($_POST)){
$phValue = $_POST["phValue"];
$tdsValue = $_POST["tdsValue"];
$tinggiAir = $_POST["tinggiAir"];
$temperature = $_POST["temperature"];
$query = "INSERT INTO log (NilaiTDS, NilaipH, KetinggianAir, Temperature)
VALUES ('".$tdsValue."', '".$phValue."', '".$tinggiAir."', '".$temperature."')";
if ($conn->query($query) === TRUE) {
echo "Berhasil menyimpan data ke table log";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>