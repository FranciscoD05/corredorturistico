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

// Obtener el ID del registro a confirmar

if('id'== $id_reservacion){
$id_reservacion = $_GET['id'];

// Consulta SQL para confirmar el registro
$sql = "UPDATE ReservacionesHabitaciones SET estado = 'confirmada' WHERE id = ?";
}

else{
    $id_cabaña=$_GET['Id'];
    $sql= "UPDATE ReservacionesCabanas SET estado = 'confirmada' WHERE id = ?";
}

// Preparar la consulta
$stmt = sqlsrv_prepare($conn, $sql, array(&$id_reservacion));

if (sqlsrv_execute($stmt)) {
    echo "<script>";
    echo "alert('Reservación confirmada.');";
    echo "window.location.href = 'ConfirmacionApulco.html';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Error al confirmar la reservación: " . print_r(sqlsrv_errors(), true) . "');";
    echo "window.location.href = 'pagina_error.php';";
    echo "</script>";
}

// Liberar recursos
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
