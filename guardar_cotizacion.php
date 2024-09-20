<?php
include 'conexion.php'; // Incluir la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el precio total del formulario
    $precioTotal = $_POST['precioTotal'];

    // Insertar la cotización en la base de datos
    $sql = "INSERT INTO cotizaciones (precio_total) VALUES ('$precioTotal')";
    if ($conn->query($sql) === TRUE) {
        echo "Cotización enviada con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    // Redirigir de vuelta a servicios.php
    header("Location: servicios.php");
    exit();
}
?>
