<?php
//db.php: Datatbase connection
$host = 'localhost';
$db = 'wound_monitoring_system';
$user = 'root';
$pass = '';

//make a connection
$conn = new mysqli($host, $user, $pass, $db);

if($conn ->connect_error){
    die("Connection failed:" .$conn->connect_error);
}
?>