<?php
$host = "localhost";
$username = "cond7572_root";
$password = "UDTyT)],K*Cg";
$database = "cond7572_login";
$conn = new mysqli("$host", "$username", "$password","$database");
// Check connection
if ($conn -> connect_errno) {
echo "Failed to connect to MySQL: " . $conn -> connect_error;
exit();
}
?>