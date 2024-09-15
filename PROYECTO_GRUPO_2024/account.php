<?php
// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Variables de conexión a la base de datos
    $servername = "localhost";   // Servidor de MySQL (normalmente "localhost" para XAMPP)
    $username = "root";          // Usuario de MySQL (por defecto es "root" en XAMPP)
    $password = "";              // Contraseña de MySQL (por defecto en XAMPP está vacía)
    $dbname = "plataforma_examenes";  // Nombre de la base de datos

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $school = $_POST['school'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que las contraseñas coincidan
    if ($password != $confirm_password) {
        echo "Error: Las contraseñas no coinciden.";
        exit();
    }

    // Encriptar la contraseña usando password_hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Comprobar si el correo electrónico ya existe en la base de datos
    $check_email_query = "SELECT * FROM usuarios WHERE correo = '$email'";
    $result = $conn->query($check_email_query);

    if ($result->num_rows > 0) {
        echo "Error: El correo electrónico ya está registrado.";
    } else {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO usuarios (nombre, genero, colegio, correo, telefono, contrasena) 
                VALUES ('$name', '$gender', '$school', '$email', '$phone', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso. Ahora puede iniciar sesión.";
            header('Location: login.html');  // Redirigir a la página de inicio de sesión
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
