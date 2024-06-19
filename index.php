<?php
session_start();

// Procesar cierre de sesión
if (isset($_GET['logout'])) {
    session_destroy(); // Destruir todas las variables de sesión
    header("Location: index.php"); // Redirigir a la página de inicio
    exit(); // Asegurar que el script se detenga después de redirigir
}
?>

<?php include 'includes/header.php'; // Incluir header

include 'includes/db_connect.php'; // Incluir la conexión a la base de datos
// Consulta SQL para obtener las últimas 10 películas ordenadas por fecha de creación
$sql_movies = "SELECT * FROM peliculas ORDER BY created_at DESC LIMIT 9";
$result_movies = $conn->query($sql_movies);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRITICINE - Inicio</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <main>
        <h2>Bienvenido a CRITICINE</h2>
        <p></p>
            <ul>
            <?php
            if ($result_movies->num_rows > 0) {
            echo '<div class="latest-movies">';
            echo '<h2>Últimas Películas Agregadas</h2>';
            echo '<ul class="movie-list">';

            while ($row = $result_movies->fetch_assoc()) {
            echo '<li class="movie-item">';
            echo '<img src="' . $row['poster_url'] . '" alt="' . $row['title'] . '" class="movie-poster">';
            echo '<h3>' . $row['title'] . '</h3>';
            echo '</li>';
            }

            echo '</ul>';
            echo '</div>';
            } else {
            echo '<p>No se encontraron películas.</p>';
            }
            ?>
            </ul>
    </main>
    
    <?php include 'includes/footer.php'; // Incluir pie de página ?>
</body>
</html>
