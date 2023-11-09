<?php 
$conn=new mysqli("localhost","root","","Trabajadores2");
$conm ->query("SET NAMES 'UTF8'");
if (!$conn) {
    die("conection failed: ".$conn->connect_error);

}
?>