<?php
$servername = "localhost";
$username = "root";
$password = "adamlolxd12";
$dbname = "TiendaVirtual";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}
?>
