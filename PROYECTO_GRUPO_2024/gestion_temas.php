<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plataforma_examenes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Mostrar todos los temas
$sql = "SELECT * FROM temas";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Temas de Estudio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Temas de Estudio</h1>
        <a href="crear_tema.php">Crear nuevo tema</a>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["nombre"] . "</td>
                            <td>" . $row["descripcion"] . "</td>
                            <td>
                                <a href='editar_tema.php?id=" . $row["id"] . "'>Editar</a> | 
                                <a href='eliminar_tema.php?id=" . $row["id"] . "'>Eliminar</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay temas disponibles</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
