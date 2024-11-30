<?php 

$host = "localhost";

$username = "cond7572_root";

$password = "UDTyT)],K*Cg";

$database = "cond7572_login";



$conn = mysqli_connect($host, $username, $password, $database);



if(!$conn){

    die("Koneksi Tidak Berhasil". mysqli_connect_error());

}



$query = mysqli_query($conn, "SELECT * FROM data ORDER BY id DESC LIMIT 1");

while($row = mysqli_fetch_assoc($query)){

    $pressure_102 = $row['pressure_102'];

    $pressure_103 = $row['pressure_103'];

    $contrast = $row['contrast'];

    

    $data = array(

        'pressure_102' => $pressure_102,

        'pressure_103' => $pressure_103,

        'contrast' => $contrast,

    );

    echo json_encode($data);



}



?>