<?php
include 'conexion.php'; // Asegúrate de tener la conexión correcta a tu base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verifica que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
    } else {
        // Cifrar la contraseña usando password_hash()
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Inserta el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hashed_password);

        if ($stmt->execute()) {
            echo "Cuenta creada con éxito.";
            header("Location: admin_login.php");
            exit();
        } else {
            echo "Error al crear la cuenta.";
        }

        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="crear_cuenta.css"> <!-- Enlace a tu archivo CSS -->
</head>
<body>

<div class="register-container">
    <h2>Crear una Cuenta</h2>
    <form method="post" action="">
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required placeholder="Tu correo">

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required placeholder="Tu contraseña">

        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" name="confirm_password" required placeholder="Confirma tu contraseña">

        <button type="submit">Crear Cuenta</button>
    </form>
</div>

</body>
</html>
