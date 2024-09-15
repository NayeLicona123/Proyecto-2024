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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Actualizar datos
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $sql = "UPDATE temas SET nombre='$nombre', descripcion='$descripcion' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Tema actualizado exitosamente.";
            header('Location: gestion_temas.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Obtener tema actual
    $sql = "SELECT * FROM temas WHERE id=$id";
    $result = $conn->query($sql);
    $tema = $result->fetch_assoc();
} else {
    echo "ID no especificado.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tema de Estudio</title>
</head>
<body>
    <h1>Editar Tema de Estudio</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre del Tema:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $tema['nombre']; ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="5" required><?php echo $tema['descripcion']; ?></textarea>

        <button type="submit">Actualizar Tema</button>
    </form>
</body>
</html>
