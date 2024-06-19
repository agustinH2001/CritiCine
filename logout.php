<?php
session_start();

// Procesar cierre de sesión
if (isset($_SESSION['user_id'])) {
    session_destroy(); // Destruir todas las variables de sesión
}

// Redirigir a la página de inicio
header("Location: index.php");
exit(); // Asegurar que el script se detenga después de redirigir
?>
