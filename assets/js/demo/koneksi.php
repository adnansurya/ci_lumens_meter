<?php
// Koneksi ke database MySQL
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'arduino';

$koneksi = mysqli_connect($host, $username, $password, $database);
if (!$koneksi) {
  die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Mengambil data dari database
$query = "SELECT waktu, NilaipH FROM log order by id desc";
$result = mysqli_query($koneksi, $query);

$labels = array();
$values = array();

while ($row = mysqli_fetch_assoc($result)) {
  $labels[] = $row['waktu'];
  $values[] = $row['NilaipH'];
}

// Menggabungkan data dalam format JSON
$data = array(
  'labels' => $labels,
  'values' => $values
);

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);

// Menutup koneksi database
mysqli_close($koneksi);
?>
