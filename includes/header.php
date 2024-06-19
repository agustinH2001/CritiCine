<?php
// Iniciar la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Procesar cierre de sesión
if (isset($_GET['logout'])) {
    session_destroy(); // Destruir todas las variables de sesión
    header("Location: index.php"); // Redirigir a la página de inicio u otra página deseada
    exit(); // Asegurar que el script se detenga después de redirigir
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRITICINE</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<header>
    <h1>CRITICINE</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2): ?>
                <li><a href="add_movie.php">Agregar Película</a></li>
                <li><a href="add_series.php">Agregar Serie</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="login.php" class="button">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>




