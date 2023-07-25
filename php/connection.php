<?php
$ip = "srv950.hstgr.io";
$user = "u116956945_juamba02";
$pass = "Estudiantes02";
$dbName = "u116956945_perla";
$connection = mysqli_connect($ip, $user, $pass, $dbName);
if(!$connection){
    die("Conexion fallida". mysqli_connect_error());
}
?>