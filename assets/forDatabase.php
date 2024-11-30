<?php
// Koneksi ke database
$host = "localhost";
$username = "cond7572_root";
$password = "UDTyT)],K*Cg";
$database = "cond7572_login";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan nilai slider dari request
if (isset($_POST['slider_value'])) {
    $slider_value = intval($_POST['slider_value']);

    // Query untuk mengupdate nilai slider
    $sql = "UPDATE dataarduino SET slider_value = $slider_value WHERE id = 1";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
