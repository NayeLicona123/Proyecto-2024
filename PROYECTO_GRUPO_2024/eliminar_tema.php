<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plataforma_examenes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM temas WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Tema eliminado exitosamente.";
        header('Location: gestion_temas.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
