<?php
session_start();
session_destroy();
setcookie('admin_logged', '', time() - 3600, '/'); // Eliminar la cookie
header("Location: admin_login.php");
exit();
?>
