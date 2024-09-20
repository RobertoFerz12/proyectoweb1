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
        // Mensajes de depuración
        echo "Correo encontrado: " . $user['email'] . "<br>";
        echo "Contraseña ingresada: " . $password . "<br>";
        echo "Contraseña almacenada: " . $user['password'] . "<br>";
        
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

<form method="post" action="">
    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    <button type="submit">Iniciar Sesión</button>
</form>
