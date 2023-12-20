<?php
require 'controller.php';
require 'modelo.php'; 
//BD
$hostname = "blronw9ngcuvwlc1hkm3-mysql.services.clever-cloud.com";
$username = "ufqaij0owzc8d63r";
$password = "44Z9adRa4YxV90RA1bss";
$database = "blronw9ngcuvwlc1hkm3";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$controlador = new Controlador($conn, new Resena($conn)); 
$controlador->procesarSolicitud();

$conn->close();
//http://localhost:8080/

?>
