<?php
session_start();
if (!isset($_SESSION['admin_logged'])) {
    header("Location: admin_login.php");
    exit();
}
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
        <a href="editar_servicios.php">Servicios</a>
        <a href="logout.php">Cerrar Sesión</a>
    </nav>
    <main>
        <h1>Bienvenido al Panel Administrativo</h1>
        <p>Selecciona una opción del menú para empezar.</p>
    </main>
</body>
</html>

