<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit();
}

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
</head>
<body>
    <h1>Modificar Precios</h1>
    <form method="post" action="">
        <table>
            <tr>
                <th>Servicio</th>
                <th>Precio</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['servicio']; ?></td>
                <td>
                    <input type="number" name="precios[<?php echo $row['id']; ?>]" 
                           value="<?php echo $row['precio']; ?>" step="0.01" required>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <button type="submit">Actualizar Precios</button>
    </form>
    <br>
    <a href="admin_panel.php">Volver al Panel</a>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>

<?php
$conn->close();
?>
