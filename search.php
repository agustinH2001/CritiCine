<?php
include 'includes/header.php';
include 'includes/db_connect.php';

// Inicializar variables para las consultas
$search_term = "";
$movies_results = [];
$series_results = [];

// Procesar formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search_term = $_POST['search'];
    
    // Consulta para buscar películas
    $sql_movies = "SELECT * FROM peliculas 
                   WHERE title LIKE '%$search_term%' 
                      OR genre LIKE '%$search_term%' 
                      OR director LIKE '%$search_term%'";
    $result_movies = $conn->query($sql_movies);

    if ($result_movies->num_rows > 0) {
        while ($row = $result_movies->fetch_assoc()) {
            $movies_results[] = $row;
        }
    }

    // Consulta para buscar series
    $sql_series = "SELECT * FROM series 
                   WHERE title LIKE '%$search_term%' 
                      OR genre LIKE '%$search_term%' 
                      OR director LIKE '%$search_term%'";
    $result_series = $conn->query($sql_series);

    if ($result_series->num_rows > 0) {
        while ($row = $result_series->fetch_assoc()) {
            $series_results[] = $row;
        }
    }
}
?>

<main class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="mb-4">Buscar Películas y Series</h2>
            <form method="post" action="search.php">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="search" name="search" value="<?php echo htmlspecialchars($search_term); ?>" placeholder="Ingrese términos de búsqueda..." required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            <!-- Mostrar resultados de películas -->
            <?php if (!empty($movies_results)): ?>
                <div class="search-results">
                    <h3>Películas encontradas:</h3>
                    <div class="row">
                        <?php foreach ($movies_results as $movie): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <a href="movie.php?id=<?php echo $movie['movie_id']; ?>">
                                        <img src="<?php echo $movie['poster_url']; ?>" class="card-img-top" alt="<?php echo $movie['title']; ?>">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $movie['title']; ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Mostrar resultados de series -->
            <?php if (!empty($series_results)): ?>
                <div class="search-results">
                    <h3>Series encontradas:</h3>
                    <div class="row">
                        <?php foreach ($series_results as $series): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <a href="series.php?id=<?php echo $series['series_id']; ?>">
                                        <img src="<?php echo $series['poster_url']; ?>" class="card-img-top" alt="<?php echo $series['title']; ?>">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $series['title']; ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Mensaje si no se encontraron resultados -->
            <?php if (empty($movies_results) && empty($series_results)): ?>
                <div class="alert alert-warning" role="alert">
                    No se encontraron resultados para "<?php echo htmlspecialchars($search_term); ?>"
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

