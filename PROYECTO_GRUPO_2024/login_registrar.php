

<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = mysqli_real_escape_string($conn, $_POST["usuario"]);
    $pass = mysqli_real_escape_string($conn, $_POST["pass"]);

    // Registrar
    if (isset($_POST["btnregistrar"])) {
        // Encriptar la contraseña
        $pass_encriptada = password_hash($pass, PASSWORD_BCRYPT);

        // Insertar en la base de datos
        $sqlgrabar = "INSERT INTO login (usuario, password) VALUES ('$nombre', '$pass_encriptada')";

        if (mysqli_query($conn, $sqlgrabar)) {
            // Redirigir a otra página después de un registro exitoso
            echo "<script> alert('Usuario registrado con éxito: $nombre'); window.location='index.html'; </script>";
            exit();  // Detener la ejecución después de la redirección
        } else {
            echo "Error: " . $sqlgrabar . "<br>" . mysqli_error($conn);
        }
    }
}
?>
