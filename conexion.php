<?php
// Parámetros de conexión
$servername = "localhost";
$username = "root"; // Usuario por defecto en XAMPP
$password = ""; // Contraseña vacía por defecto en XAMPP
$dbname = "bd"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si la conexión es exitosa, no mostrará errores
?>
