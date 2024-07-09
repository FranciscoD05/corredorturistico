<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/styleLogin.css">
    <style>
        body {
            background-image: url('imagenes/index.jpg');
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="usuario">Usuario:</label><br>
        <input type="text" name="usuario" required><br>
        <label for="contraseña">Contraseña:</label><br>
        <input type="password"  name="contrasena" required><br>
        <input type="submit" value="Enviar">

        <a href="index.html" class="mt-3 btn btn-secondary  ">Regresar</a>
    </form>
    
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serverName = "localhost"; // Nombre del servidor MySQL
    $username = "corredorturistico";  // Nombre de usuario de MySQL
    $password = "corredorturistico"; // Contraseña de MySQL
    $dbName = "corredorturistico"; // Nombre de la base de datos MySQL

    // Establecer la conexión con MySQL
    $conn = new mysqli($serverName, $username, $password, $dbName);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT id FROM usuariosadministradores WHERE usuario = ? AND contrasena = ?";
    
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena);
    
    // Ejecutar la consulta
    $stmt->execute();
    
    // Obtener resultados
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario autenticado correctamente
        header("Location: RegistrosCantona.php");
        exit();
    } else {
        // Usuario o contraseña incorrectos
        echo "<script>";
        echo "alert('Usuario o contraseña incorrectos');";
        echo "window.location.href = 'login.php';";
        echo "</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}
?>


</body>
</html>

