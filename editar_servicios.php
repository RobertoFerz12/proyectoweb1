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
        }
        nav {
            width: 200px;
            height: 100vh;
            background-color: #f4f4f4;
            padding: 20px;
        }
        nav a {
            display: block;
            padding: 10px;
            margin: 10px 0;
            text-decoration: none;
            color: #333;
        }
        main {
            padding: 20px;
            flex-grow: 1;
        }
    </style>
</head>
<body>
    <nav>
        <h2>Menú</h2>
        <a href="admin_servicios.php">Servicios</a>
        <a href="logout.php">Cerrar Sesión</a>
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
        <br>
        <a href="admin_panel.php">Volver al Panel</a>
    </main>
</body>
</html>

<?php
$conn->close();
?>
