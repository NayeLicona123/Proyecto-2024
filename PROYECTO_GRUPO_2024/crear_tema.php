<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "plataforma_examenes";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO temas (nombre, descripcion) VALUES ('$nombre', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        echo "Tema creado exitosamente.";
        header('Location: gestion_temas.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>
