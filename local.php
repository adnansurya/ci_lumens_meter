<?php
include("koneksi.php");
if(!empty($_POST)){
$tdsValue = $_POST["local"];
$query = "INSERT INTO local (ip)
VALUES ('".$tdsValue."')";
if ($conn->query($query) === TRUE) {
echo "Berhasil menyimpan data ke table local";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>