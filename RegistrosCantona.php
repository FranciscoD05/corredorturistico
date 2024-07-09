<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <link rel="stylesheet" href="css/styleRegistrosC.A.css">
</head>
<body>

<h2>Registros</h2>

<table>
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Grupo Danza</th>
        <th>Encargado</th>
        <th>Teléfono</th>
        <th>Correo Electrónico</th>
        <th>Estado</th>
        
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

    $sql = "SELECT * FROM Registros";
    $getResults = sqlsrv_query($conn, $sql);

    if ($getResults === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['Nombre'] . "</td>";
        echo "<td>" . $row['Apellidos'] . "</td>";
        echo "<td>" . $row['GrupoDanza'] . "</td>";
        echo "<td>" . $row['Encargado'] . "</td>";
        echo "<td>" . $row['Telefono'] . "</td>";
        echo "<td>" . $row['CorreoElectronico'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo "<td>";
        echo "<form action='eliminarRegistroCantona.php' method='post'>";
        echo "<input type='hidden' name='Id' value='" . $row['Id'] . "'>";
        echo "<input type='submit' id='eliminarRegistro' value='Eliminar'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    sqlsrv_free_stmt($getResults);
    sqlsrv_close($conn);
    ?>
</table>

<br>

<a class="btn" id="cerrarsesion" href="cerrarsesion.php">Cerrar Sesión</a>

<a class="btn" id="agregarRegistro" href="agregarRegistro.php">Agregar Registro</a>


</body>
</html>

