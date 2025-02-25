<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulario de Reservación</title>
    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleReservar.css">
</head>
<body>
    <style>
            body {
            background-image: url('imagenes/index.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

    </style>
    <div class="container mt-5">
        <h1>Formulario de Reservación</h1>
        <form action="reservarcabañas.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="form-group">
                <label for="fecha_final">Fecha de finalización</label>
                <input type="date" class="form-control" id="fecha_final" name="fecha_final" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="form-group">
            <label for="tipo_cabaña">Tipo de Cabaña</label>
                <select class="form-control" id="tipo_cabaña" name="tipo_cabaña" required>
                    <option value="Mirador">Cabaña Mirador</option>
                    <option value="Señorial">Suite Señorial</option>
                    <option value="Patron">Cabaña Patron</optio>
                    <option value="Manantial">Cabaña Manantial</option>
                    <option value="Real">Cabaña Real</option>
                    <option value="Rio">Cabaña Rio</option>
                    <option value="Arroyo">Cabaña Arroyo</option>
                    <option value="Lago">Cabaña Lago</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad_cabañas">Cantidad de Cabañas</label>
                <input type="number" class="form-control" id="cantidad_cabañas" name="cantidad_cabañas" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Reservar</button>
            <a href="Cabañas.html" class="btn btn-primary">Regresar</a>
        </form>
    </div>
    <?php
if (!empty($_POST)) {
    $serverName = "FRANCISCOD\SQLEXPRESS"; 

    $connectionOptions = array(
        "Database" => "CorredorTuristico");

    // Establecer la conexión
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die("Error de conexión: " . print_r(sqlsrv_errors(), true));
    }

    // Obtener los valores del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final =$_POST['fecha_final'];
    $tipo_cabana = $_POST['tipo_cabaña'];
    $cantidad_cabanas = $_POST['cantidad_cabañas'];

    // Consulta SQL para insertar los datos
    $insertar = "INSERT INTO ReservacionesCabanas (nombre, apellidos, telefono, correo, fecha_inicio, fecha_final, tipo_cabana, cantidad_cabanas, estado) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pendiente')";

    // Preparar la consulta
    $recurso = sqlsrv_prepare($conn, $insertar, array(&$nombre, &$apellidos, &$telefono, &$correo, &$fecha_inicio, &$fecha_final, &$tipo_cabana, &$cantidad_cabanas));
    if (sqlsrv_execute($recurso)) {
        if ($row = sqlsrv_fetch_array($recurso, SQLSRV_FETCH_ASSOC)) {
            $id_cabaña = $row['Id'];
        }
    
        $id_cabana = 'Id';
        $enlace_confirmacion = "http://sitioweb.com/confirmar.php?id=$id_cabana";

        $mensaje = "Reservacion exitosa.\\n";
        $mensaje .= "Correo de confirmación enviado a: $correo.";
        
        $asunto = "Confirmación de reservacion";
        $mensaje_correo = "Hola $nombre,\n\nGracias por realizar tu reservacion de $cantidad_cabanas para el $fecha_inicio hasta el $fecha_final en una cabaña $tipo_cabana.
        \n\nPor favor, haz clic en el siguiente enlace para confirmar tu reservación:\n\n$enlace_confirmacion\n\nSaludos,\nEl equipo de la Hacienda Apulco";
    
        if (mail($correo, $asunto, $mensaje_correo)) {
            echo "<script>alert('$mensaje'); window.location.href = 'Cabañas.html';</script>";
        } else {
            echo "<script>alert('Error al enviar el correo de confirmación.'); window.location.href = 'reservarcabañas.php';</script>";
        }
    } else {
        echo "<script>alert('Error al agregar el registro: " . print_r(sqlsrv_errors(), true) . "'); window.location.href = 'reservarcabañas.php';</script>";
    }
}
?>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>