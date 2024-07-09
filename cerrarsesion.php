<?php
// Iniciar sesión si no está iniciada
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio de sesión o a donde sea necesario
header("Location: login.php");
exit();
?>
