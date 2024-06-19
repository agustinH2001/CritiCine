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
    <link rel="icon" href="media/film.svg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.0/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRITICINE</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<header class="bg-dark text-white py-4">
    <div class="container d-flex justify-content-between align-items-center">

        <h1 class="m-0"><i class="bi bi-film"></i> CritiCine</h1>

        <nav>
            <ul class="list-inline mb-0">
                <li class="list-inline-item"><a href="index.php" class="text-white"> <i class="bi bi-house"></i> Inicio</a></li>
                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2): ?>
                    <li class="list-inline-item"><a href="moderator.php" class="text-white">Panel de moderador</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3): ?>
                    <li class="list-inline-item"><a href="admin.php" class="text-white">Panel de administrador</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="list-inline-item"><a href="logout.php" class="btn btn-outline-light">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="list-inline-item"><a href="login.php" class="btn btn-outline-light">Login</a></li>
                <?php endif; ?>
                <li class="list-inline-item"><a href="search.php"><i class="bi bi-search"></i></a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="list-inline-item"><a href="user.php"><i class="bi bi-person"></i></a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

