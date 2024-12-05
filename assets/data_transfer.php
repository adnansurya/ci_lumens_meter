<?php 

$host = "localhost";

$username = "cond7572_root";

$password = "UDTyT)],K*Cg";

$database = "cond7572_login";



$conn = mysqli_connect($host, $username, $password, $database);



if(!$conn){

    die("Koneksi Tidak Berhasil". mysqli_connect_error());

}


$sql = "SELECT slider_value FROM dataarduino WHERE id='1'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

$dimmerPercent = $row["slider_value"];


$sql = "SELECT slider_value FROM dataarduino WHERE id='2'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

$area = $row["slider_value"];


$query = mysqli_query($conn, "SELECT * FROM table_data ORDER BY id DESC LIMIT 1");

while($row = mysqli_fetch_assoc($query)){

    $light_level = $row['light_level'];

    $power = $row['power'];

    $lumens_level = floatval($light_level) * floatval($area);
    

    $data = array(

        'light_level' => $light_level,

        'lumens_level' => $lumens_level,

        'power' => $power,

        'dimmer_percent' => $dimmerPercent,

        'area' => $area,

    );

    echo json_encode($data);



}



?>