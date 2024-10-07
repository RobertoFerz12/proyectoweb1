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
            margin: 0; /* Elimina márgenes */
            font-family: 'Roboto', sans-serif; /* Fuente */
            background-image: url('img/fondo_telas.jpg'); /* Asegúrate de que la ruta de la imagen sea correcta */
            background-size: cover; /* Cubrir toda la ventana */
            background-position: center; /* Centrar la imagen */
            display: flex;
            height: 100vh; /* Ocupa toda la altura de la ventana */
        }
        nav {
    width: 200px;
    height: 100vh;
    background-color: rgba(244, 244, 244, 0.2); /* Fondo con opacidad para que se vea la imagen */
    padding: 20px;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2); /* Sombra para el menú */
}

nav h2 {
    font-size: 1.5em; /* Tamaño del encabezado del menú */
    margin-bottom: 20px; /* Espaciado inferior del encabezado */
    color: rgba(0, 0, 0, 1); /* Color del texto del encabezado */
}

nav a {
    display: block;
    padding: 10px;
    margin: 10px 0;
    text-decoration: none;
    color: #333; /* Color del texto de los enlaces */
    transition: background-color 0.3s; /* Transición suave */
    font-weight: bold; /* Grosor de letras más pesado */
    font-size: 1.1em; /* Aumenta el tamaño del texto de los enlaces */
}

nav a:hover {
    background-color: rgba(200, 200, 200, 0.5); /* Color de fondo al pasar el mouse */
}

main {
    padding: 20px;
    flex-grow: 1;
    color: white; /* Texto blanco para mejor contraste */
}

        .color{
            color: black;
            
        }
    </style>
</head>
<body>
    <nav>
        <h2>Menú</h2>
        <a class="color" href="editar_servicios.php">Servicios</a>
        <a class="color" href="logout.php">Cerrar Sesión</a>
    </nav>
    <main>
        <h1>Bienvenido al Panel Administrativo</h1>
        <p>Selecciona una opción del menú para empezar.</p>
    </main>
</body>
</html>


