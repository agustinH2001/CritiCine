<?php
session_start();

// Procesar cierre de sesión
if (isset($_GET['logout'])) {
    session_destroy(); // Destruir todas las variables de sesión
    header("Location: index.php"); // Redirigir a la página de inicio
    exit(); // Asegurar que el script se detenga después de redirigir
}
?>

<?php include 'includes/header.php'; 
include 'includes/db_connect.php'; 
// Consulta SQL para obtener las últimas 10 películas ordenadas por fecha de creación
$sql_movies = "SELECT * FROM peliculas ORDER BY created_at DESC LIMIT 10";
$result_movies = $conn->query($sql_movies);
// Consulta SQL para obtener las últimas 10 series ordenadas por fecha de creación
$sql_series = "SELECT * FROM series ORDER BY created_at DESC LIMIT 10";
$result_series = $conn->query($sql_series);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRITICINE - Inicio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .movie-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .movie-item {
            width: 200px;
            margin: 0 10px 20px;
            text-align: center;
        }
        .movie-poster {
            width: 160px;
            height: auto;
        }
    </style>
</head>
<body>
    <main class="container mt-5">
        <h2 class="text-center mb-4 p-3 bg-dark text-white shadow-lg rounded">Explorar novedades</h2>
        
        <!-- Mostrador de películas recientes -->
        <?php if ($result_movies->num_rows > 0): ?>
            <div class="latest-movies">
                <h3 class="text-center">Últimas Películas Agregadas</h3>
                <ul class="movie-list">
                    <?php while ($row = $result_movies->fetch_assoc()): ?>
                        <li class="movie-item">
                            <a href="movie.php?id=<?= $row['movie_id'] ?>">
                                <img src="<?= $row['poster_url'] ?>" alt="<?= $row['title'] ?>" class="movie-poster img-fluid">
                                <h4 class="mt-2"><?= $row['title'] ?></h4>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php else: ?>
            <p class="text-center">No se encontraron películas.</p>
        <?php endif; ?>
        
        <hr>
        
        <!-- Mostrador de series recientes -->
        <?php if ($result_series->num_rows > 0): ?>
            <div class="latest-series">
                <h3 class="text-center">Últimas Series Agregadas</h3>
                <ul class="movie-list">
                    <?php while ($row = $result_series->fetch_assoc()): ?>
                        <li class="movie-item">
                            <a href="series.php?id=<?= $row['series_id'] ?>">
                                <img src="<?= $row['poster_url'] ?>" alt="<?= $row['title'] ?>" class="movie-poster img-fluid">
                                <h4 class="mt-2"><?= $row['title'] ?></h4>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php else: ?>
            <p class="text-center">No se encontraron series.</p>
        <?php endif; ?>
    </main>

    <!-- Bootstrap y JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
include 'includes/footer.php'; 
?>
