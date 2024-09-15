<?php
session_start(); // Iniciar la sesión
session_destroy(); // Destruir la sesión actual

// Redirigir al inicio de sesión
header('Location: login.html');
exit();
?>
