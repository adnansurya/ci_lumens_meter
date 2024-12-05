<?php 

$host = "localhost";

$username = "cond7572_root";

$password = "UDTyT)],K*Cg";

$database = "cond7572_login";



$conn = mysqli_connect($host, $username, $password, $database);



if(!$conn){

    die("Koneksi Tidak Berhasil". mysqli_connect_error());

}

$sql = "SELECT slider_value FROM dataarduino WHERE id='2'";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

$area = $row["slider_value"];



$data_p2 = "";

$data_w ="";





$query= mysqli_query($conn, "(SELECT * FROM table_data ORDER BY id DESC LIMIT 10) ORDER BY id ASC");

while($row = mysqli_fetch_assoc($query)){

    $data_w .= $row['waktu']. ",";

    $light_level = $row['light_level'];

    $lumens_level = floatval($light_level) * floatval($area);

    $data_p2 .= $lumens_level. ",";



}



echo json_encode(array(

    'waktu' => substr($data_w,0,-1),

    'pressure_102' => substr($data_p2,0,-1)

));



?>

