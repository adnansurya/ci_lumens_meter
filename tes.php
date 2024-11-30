<?php
$host = "localhost";
$username = "cond7572_root";
$password = "UDTyT)],K*Cg";
$database = "cond7572_login";

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengeksekusi permintaan SQL untuk mengambil 4 nilai dari tabel
$sql = "SELECT slider_value FROM dataarduino WHERE id='1'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nilai1 = $row["slider_value"];

    // Mengubah data menjadi format query string
    $data = "nilai1=" . urlencode($nilai1);
    echo $data;
} else {
    echo "nilai1=0"; // Nilai default jika tidak ada data yang ditemukan
}

$conn->close();
?>
