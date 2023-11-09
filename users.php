<?php
$conn = new mysqli("localhost", "root", "1234", "Trabajadores2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->query("SET NAMES 'UTF8'");
?>
