<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleformulariocantona.css">
</head>
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
<body>
    <div class="container mt-5">
        <h2>Registro de Usuarios</h2>
        <form action="agregarregistro.php" method="POST">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="Nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Apellidos:</label>
                <input type="text" name="Apellidos" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nombre del grupo de danza:</label>
                <input type="text"name="GrupoDanza" class="form-control" required>
            </div>
            <div class="form-group">
                <label>¿Eres el encargado?</label><br>
                <input type="text" name="Encargado" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Número de Teléfono:</label>
                <input type="tel" name="Telefono" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Correo Electrónico:</label>
                <input type="email" name="CorreoElectronico" class="form-control" required>
            </div>
            <button type="submit" class="mt-3 mr-2 btn btn-primary">Enviar</button>

            <a href="registros.php" class="mt-3 btn btn-secondary">Regresar</a>
        </form>
    </div>

    
    <!-- Agrega los enlaces a los archivos JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["Nombre"];
    $apellidos = $_POST["Apellidos"];
    $grupoDanza = $_POST["GrupoDanza"];
    $encargado = $_POST["Encargado"];
    $telefono = $_POST["Telefono"];
    $correoElectronico = $_POST["CorreoElectronico"];

    // Establecer la conexión con la base de datos
    $serverName = "FRANCISCOD\\SQLEXPRESS";
    $connectionOptions = array(
        "Database" => "CorredorTuristico"
    );
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Construir la consulta SQL para insertar el nuevo registro
    $sql = "INSERT INTO Registros (Nombre, Apellidos, GrupoDanza, Encargado, Telefono, CorreoElectronico) VALUES (?, ?, ?, ?, ?, ?)";
    $params = array($nombre, $apellidos, $grupoDanza, $encargado, $telefono, $correoElectronico);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Cerrar la conexión con la base de datos
    sqlsrv_close($conn);

    // Redirigir a la página de registros después de agregar el registro
    header("Location: registros.php");
    exit();
}
?>
</html>