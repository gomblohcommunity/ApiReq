<?php
$servername="localhost";
$username="root";
$password="apik";
$db_name="masjid";

$connection = new  mysqli($servername,$username,$password,$db_name);
if($connection->connect_error){
die("connect fail :" . $connection->connect_error);
}else{
// echo("connected");
}
?>
