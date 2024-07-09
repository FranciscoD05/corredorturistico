<?php
$serverName = "localhost"; // Nombre del servidor MySQL
$username = "corredorturistico";  // Nombre de usuario de MySQL
$password = "corredorturistico";  // Contraseña de MySQL
$dbName = "corredorturistico"; // Nombre de la base de datos MySQL

// Establecer la conexión con MySQL
$conn = new mysqli($serverName, $username, $password, $dbName);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del registro a confirmar
$id = $_GET['Id']; // Asegúrate de que el parámetro Id sea pasado correctamente desde la URL

// Consulta SQL para confirmar el registro
$sql = "UPDATE registros SET estado = 'confirmada' WHERE id = ?";

// Preparar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero (ID)

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "<script>";
    echo "alert('Registro confirmada.');";
    echo "window.location.href = 'confirmacionCantona.php';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Error al confirmar la reservación: " . $conn->error . "');";
    echo "window.location.href = 'pagina_error.php';";
    echo "</script>";
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$conn->close();
?>
