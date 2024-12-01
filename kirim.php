<?php

include("koneksi.php");

if (!empty($_POST)) {

    $lightValue = $_POST["lightValue"];

    $powerValue = $_POST["powerValue"];

    date_default_timezone_set('Asia/Makassar');

    $waktuindonesia = date("d F Y");

    $jam = date("h:i:s A");


    $sql = "SELECT slider_value FROM dataarduino WHERE id='1'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $dimmerPercent = $row["slider_value"];

    // $dimmerPercent = 2;
    echo $dimmerPercent;

    $sqlstr = "INSERT INTO table_data (tanggal, waktu, light_level, power, dimmer_percent) 
        VALUES ('$waktuindonesia', '$jam', $lightValue, $powerValue, $dimmerPercent)";

    if ($conn->query($sqlstr)) {
        echo "Berhasil menyimpan data ke table code";
    } else {
        echo "Error " . $query . "<br>" . $conn->error;
    }
}
