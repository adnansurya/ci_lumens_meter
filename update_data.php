<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kirimdata";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil nilai yang diinput dari form
  $newValue = $_POST["newValue"];

  // Simpan nilai variabel ke database
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
  }

  $sql = "UPDATE sensor SET nilai = '$newValue' WHERE id = 1";

  if ($conn->query($sql) === TRUE) {
    echo "Nilai variabel berhasil diperbarui dan disimpan ke database.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}

?>
