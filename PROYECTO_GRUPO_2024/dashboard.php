<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Si no ha iniciado sesión, redirigir al inicio de sesión
    header('Location: login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?>!</h1>
    <p>Este es el panel de control de los usuarios registrados.</p>

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
