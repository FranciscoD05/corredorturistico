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

// Obtener el ID del registro a eliminar
$id = $_POST["Id"];

// Consulta SQL para eliminar el registro
$sql = "DELETE FROM Registros WHERE Id = ?";

// Preparar la consulta
$stmt = sqlsrv_prepare($conn, $sql, array(&$id));

if (sqlsrv_execute($stmt)) {
    echo "<script>";
    echo "alert('Registro eliminado con éxito.');";
    echo "window.location.href = 'RegistrosCantona.php';";
    echo "</script>";

} else {
    echo "Error al eliminar el registro: " . print_r(sqlsrv_errors(), true);
}

// Liberar recursos
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
