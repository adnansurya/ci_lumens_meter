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

    date_default_timezone_set('Asia/Makassar');

    $jam = date("h:i:s A");



    // Query untuk mengupdate nilai slider di tabel dataArduino

    $sqlUpdate = "UPDATE dataarduino SET slider_value = $slider_value WHERE id = 1";



    if ($conn->query($sqlUpdate) === TRUE) {

        echo "Record updated successfully";



    } else {

        echo "Error: " . $sqlUpdate . "<br>" . $conn->error;

    }

}



$conn->close();

