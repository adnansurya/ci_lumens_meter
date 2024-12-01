<?php 

$host = "localhost";

$username = "cond7572_root";

$password = "UDTyT)],K*Cg";

$database = "cond7572_login";



$conn = mysqli_connect($host, $username, $password, $database);



if(!$conn){

    die("Koneksi Tidak Berhasil". mysqli_connect_error());

}



$data_p3 = "";

$data_w ="";



$query= mysqli_query($conn, "(SELECT * FROM table_data ORDER BY id DESC LIMIT 10) ORDER BY id ASC");

while($row = mysqli_fetch_assoc($query)){

    $data_w .= $row['waktu']. ",";

    $data_p3 .= $row['power']. ",";



}



echo json_encode(array(

    'waktu' => substr($data_w,0,-1),

    'pressure_103' => substr($data_p3,0,-1)

));



?>

