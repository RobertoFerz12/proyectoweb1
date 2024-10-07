<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar el correo electrónico
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Compara directamente la contraseña almacenada
        if ($password === $user['password']) {
            $_SESSION['admin_logged'] = true;
            header("Location: admin_panel.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo electrónico no encontrado.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_login.css"> <!-- Asegúrate de que el nombre del archivo CSS sea correcto -->
</head>
<body>

<div class="login-container">
    <div class="logo-container">
        <img src="img/logo.jpeg" alt="Logo de la Empresa"> <!-- Ajusta la ruta del logo -->
    </div>
    <div class="login-form">
        <h2>Iniciar Sesión</h2>
        <form method="post" action="">
            <label class="form-label" for="email">Correo Electrónico:</label>
            <input class="form-input" type="email" name="email" required placeholder="Tu correo">
            
            <label class="form-label" for="password">Contraseña:</label>
            <input class="form-input" type="password" name="password" required placeholder="Tu contraseña">
            
            <button class="form-button" type="submit">Iniciar Sesión</button>
        </form>
        <p style="text-align: center; color: white;">¡Bienvenido! Inicia sesión para continuar.</p>
    </div>
</div>

</body>
</html>
