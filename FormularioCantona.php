<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleformulariocantona.css">
    <style>
        body {
            background-image: url('imagenes/index.jpg');
            background-size: cover;
            background-position: center;
            padding-top: 50px;
            margin: 0;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Registro de actividades</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Apellidos:</label>
            <input type="text" name="apellidos" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Taller o actividad que te gustaria impartir:</label>
            <input type="text" name="actividad_taller" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Número de Teléfono:</label>
            <input type="tel" name="telefono" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Correo Electrónico:</label>
            <input type="email" name="correo" class="form-control" required>
        </div>
        <button type="submit" class="mt-3 mr-2 btn btn-primary">Enviar</button>

        <a href="Cantona.html" class="mt-3 btn btn-secondary">Regresar</a>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serverName = "localhost";  // Cambia esto a tu servidor de base de datos si no es localhost
    $username = "corredorturistico";   // Tu usuario de MySQL
    $password = "corredorturistico"; // Tu contraseña de MySQL
    $dbName = "corredorturistico";

    // Establecer la conexión
    $conn = new mysqli($serverName,$username,$password, $dbName);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los valores del formulario
    $Nombre = $_POST['nombre'];
    $Apellidos = $_POST['apellidos'];
    $Actividad = $_POST['actividad_taller'];
    $Telefono = $_POST['telefono'];
    $CorreoElectronico = $_POST['correo'];

    // Consulta SQL para insertar los datos
    $insertar = $conn->prepare("INSERT INTO registros (nombre, apellidos, actividad_taller, telefono, correo, estado) VALUES (?, ?, ?, ?, ?, 'pendiente')");
    
    $insertar->bind_param("sssss", $Nombre, $Apellidos, $Actividad, $Telefono, $CorreoElectronico);

    $mensaje = "Registro exitoso";

    if ($insertar->execute()) {
        echo "<script>alert('Registro exitoso.'); window.location.href = 'Cantona.html';</script>";
    } else {
        echo "<script>alert('Error al realizar el registro.'); window.location.href = 'registrocantona.php';</script>";
    }

    // Cerrar conexión
    $insertar->close();
    $conn->close();
}
?>


<!-- Agrega los enlaces a los archivos JS de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/
