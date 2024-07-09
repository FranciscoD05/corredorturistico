<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservaciones de Habitaciones</title>
    <link rel="stylesheet" href="css/styleRegistrosC.A.css">
</head>
<body>

<h2>Reservaciones de Habitaciones</h2>

<table>
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Telefono</th>
        <th>Correo Electrónico</th>
        <th>Fecha de inicio de la reservacion</th>
        <th>Fecha de fin de la reservacion</th>
        <th>Tipo de habitacion</th>
        <th>Estatus</th>
        <th>Cantidad de Habitaciones</th>
    </tr>
    <?php
    $serverName = "FRANCISCOD\\SQLEXPRESS";
    $connectionOptions = array(
        "Database" => "CorredorTuristico"
    );

    // Establecer la conexión
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $sql = "SELECT * FROM ReservacionesHabitaciones";
    $getResults = sqlsrv_query($conn, $sql);

    if ($getResults === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['apellidos'] . "</td>";
        echo "<td>" . $row['telefono'] . "</td>";
        echo "<td>" . $row['correo'] . "</td>";
        
        // Convertir datetime a cadena
        $fecha_inicio = $row['fecha_inicio'];
        $fecha_final = $row['fecha_final'];
        $fecha_inicio_str = date_format($fecha_inicio, 'd-M-Y');
        $fecha_final_str = date_format($fecha_final, 'd-M-Y');
        
        echo "<td>" . $fecha_inicio_str . "</td>";
        echo "<td>" . $fecha_final_str . "</td>";
        echo "<td>" . $row['tipo_habitacion'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo "<td>" .$row['cantidad_habitaciones']."</td>";
        echo "<td>";
        echo "<form action='eliminarReservacion.php' method='post'>";
        echo "<input type='hidden' name='Id' value='" . $row['Id'] . "'>";
        echo "<input type='submit' id='eliminarRegistro' value='Eliminar'>";
        echo "</form>";
        echo "</td>";
        
    }

    sqlsrv_free_stmt($getResults);
    sqlsrv_close($conn);
    ?>
</table>
<br>
<a class="btn" id="agregarRegistro" href="agregarReservacion.php">Agregar Reservacion de Habitacion</a>

<br>

<h2>Reservaciones Cabañas</h2>
<table>
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Telefono</th>
        <th>Correo Electrónico</th>
        <th>Fecha de inicio de la reservacion</th>
        <th>Fecha de fin de la reservacion</th>
        <th>Tipo de cabaña</th>
        <th>Estatus</th>
        <th>Cantidad de Cabañas</th>
    </tr>
<br>
<?php
    $serverName = "FRANCISCOD\\SQLEXPRESS";
    $connectionOptions = array(
        "Database" => "CorredorTuristico"
    );

    // Establecer la conexión
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $sql2 = "SELECT * FROM ReservacionesCabanas";
    $getResults2 = sqlsrv_query($conn, $sql2);

    if ($getResults2 === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row2 = sqlsrv_fetch_array($getResults2, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row2['nombre'] . "</td>";
        echo "<td>" . $row2['apellidos'] . "</td>";
        echo "<td>" . $row2['telefono'] . "</td>";
        echo "<td>" . $row2['correo'] . "</td>";
        
        // Convertir datetime a cadena
        $fecha_inicio = $row2['fecha_inicio'];
        $fecha_final = $row2['fecha_final'];
        $fecha_inicio_str = date_format($fecha_inicio, 'd-M-Y');
        $fecha_final_str = date_format($fecha_final, 'd-M-Y');
        
        echo "<td>" . $fecha_inicio_str . "</td>";
        echo "<td>" . $fecha_final_str . "</td>";
        echo "<td>" . $row2['tipo_cabana'] . "</td>";
        echo "<td>" . $row2['estado'] . "</td>";
        echo "<td>" . $row2['cantidad_cabanas']."</td>";
        echo "<td>";
        echo "<form action='eliminarReservacion.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row2['id'] . "'>";
        echo "<input type='submit' id='eliminarRegistro' value='Eliminar'>";
        echo "</form>";
        echo "</td>";
        
    }

    sqlsrv_free_stmt($getResults2);
    sqlsrv_close($conn);
    ?>
    </table>
    <br>
    <a class="btn" id="cerrarsesion" href="cerrarsesion.php">Cerrar Sesión</a>
    <a class="btn" id="agregarRegistro" href="agregarReservacionCabaña.php">Agregar Reservacion de Cabaña</a>
</body>
</html>