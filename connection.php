<?php
$db_host="localhost";
$db_username="root";
$db_password="";
$db_name="crud_db";


//Creating connection
$conn=mysqli_connect($db_host, $db_username, $db_password, $db_name);

// ///Checking the connection
// if ($conn) {
// 	echo "Connected Successfully";
// }
// else{
// 	echo "Failed to Connect";
// }

// if ($conn->connect_error) {
// 	die("Not connected :" .$conn->connect_error);
// }
// else{
// 	echo "Connected Successfully";
// }


?>