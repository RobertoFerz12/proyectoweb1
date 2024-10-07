<?php
session_start();
if (!isset($_SESSION['admin_logged'])) {
    header("Location: admin_login.php");
    exit();
}

include 'conexion.php';

// Actualizar precios si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['precios'] as $id => $precio) {
        $sql = "UPDATE precios_servicios SET precio = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $precio, $id);
        $stmt->execute();
    }
}

// Obtener precios actuales
$sql = "SELECT * FROM precios_servicios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo</title>
    <style>
        body {
            display: flex;
            margin: 0; /* Elimina márgenes */
            font-family: 'Roboto', sans-serif; /* Fuente */
            background-image: url('img/fondo_telas.jpg'); /* Asegúrate de que la ruta de la imagen sea correcta */
            background-size: cover; /* Cubrir toda la ventana */
            background-position: center; /* Centrar la imagen */
            height: 100vh; /* Ocupa toda la altura de la ventana */
        }
        nav {
            width: 200px;
            height: 100vh;
            background-color: rgba(244, 244, 244, 0.2); /* Fondo con opacidad para que se vea la imagen */
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2); /* Sombra para el menú */
        }
        nav a {
            display: block;
            padding: 10px;
            margin: 10px 0;
            text-decoration: none;
            color: rgba(0, 0, 0, 0.9);
            font-size: 1.1em; /* Tamaño del texto de los enlaces */
            font-weight: bold;
        }
        nav a:hover {
            background-color: rgba(200, 200, 200, 0.5); /* Color de fondo al pasar el mouse */
        }
        main {
            padding: 20px;
            flex-grow: 1;
            color: white; /* Texto blanco para mejor contraste */
        }
        table {
            width: 100%; /* Ancho completo de la tabla */
            margin-top: 20px; /* Espaciado superior de la tabla */
            border-collapse: collapse; /* Para eliminar el espaciado entre celdas */
        }
        th, td {
            padding: 10px; /* Espaciado en las celdas */
            text-align: left; /* Alinear el texto a la izquierda */
            border-bottom: 1px solid rgba(255, 255, 255, 0.2); /* Línea de separación entre filas */
        }
        th {
            background-color: rgba(255, 255, 255, 0.2); /* Fondo claro para el encabezado */
        }
        button {
    background-color: #333; /* Fondo del botón */
    color: white; /* Color del texto del botón */
    padding: 15px 30px; /* Aumentar el espaciado del botón */
    border: none; /* Sin borde */
    cursor: pointer; /* Cambia el cursor al pasar por encima */
    transition: background-color 0.3s; /* Transición suave */
    font-size: 18px; /* Aumentar el tamaño de la fuente */
    display: block; /* Asegura que el botón sea un bloque */
    margin: 20px auto; /* Centra el botón horizontalmente y agrega margen superior/inferior */
    width: 200px; /* Ancho fijo para el botón */
}
        button:hover {
            background-color: #555; /* Color de fondo del botón al pasar el mouse */
        }
    </style>
</head>
<body>
    <nav>
        <h2>Menú</h2>
        <a href="admin_servicios.php">Servicios</a>
        <a href="logout.php">Cerrar Sesión</a>
        <a href="admin_panel.php">Volver al Panel</a>
    </nav>
    <main>
        <h1>Modificar Precios de Servicios</h1>
        <form method="post" action="">
            <table>
                <tr>
                    <th>Servicio</th>
                    <th>Precio</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['servicio']); ?></td>
                    <td>
                        <input type="number" name="precios[<?php echo $row['id']; ?>]" 
                               value="<?php echo htmlspecialchars($row['precio']); ?>" step="0.01" required>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
            <button type="submit">Actualizar Precios</button>
        </form>
    </main>
</body>
</html>

<?php
$conn->close();
?>
