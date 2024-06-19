<?php
include 'includes/header.php';
include 'includes/db_connect.php';

// Verificar si se proporcionó un ID de serie válido
if (isset($_GET['id'])) {
    $series_id = $_GET['id'];
    $query = "SELECT * FROM series WHERE series_id = $series_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $genre = $row['genre'];
        $release_date = $row['release_date'];
        $seasons = $row['seasons'];
        $episodes = $row['episodes'];
        $director = $row['director'];
        $description = $row['description'];
        $poster_url = $row['poster_url'];

        // Consulta para obtener la calificación promedio desde la tabla ratings_series
        $sql_avg_rating = "SELECT AVG(rating) AS avg_rating 
                           FROM ratings_series 
                           WHERE series_id = $series_id";
        $result_avg_rating = $conn->query($sql_avg_rating);
        $avg_rating = $result_avg_rating->fetch_assoc()['avg_rating'];

        // Consulta para obtener todas las reseñas de la serie
        $sql_reviews = "SELECT r.title AS review_title, r.content AS review_content, r.created_at AS review_created_at, u.username AS username
                        FROM reviews_series r
                        INNER JOIN usuarios u ON r.user_id = u.user_id
                        WHERE r.series_id = $series_id
                        ORDER BY r.created_at DESC";
        $result_reviews = $conn->query($sql_reviews);
    } else {
        echo "<p>Serie no encontrada</p>";
        exit();
    }
} else {
    echo "<p>ID de serie no proporcionado</p>";
    exit();
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <img src="<?php echo $poster_url ?>" class="card-img-top mx-auto d-block" alt="<?php echo $title ?>" style="max-width: 400px;">
                <div class="card-body">
                    <h5 class="card-title"><strong><?php echo $title ?></strong></h5>
                    <p class="card-text"><strong>Género:</strong> <?php echo $genre ?></p>
                    <p class="card-text"><strong>Fecha de Estreno:</strong> <?php echo $release_date ?></p>
                    <p class="card-text"><strong>Temporadas:</strong> <?php echo $seasons ?></p>
                    <p class="card-text"><strong>Episodios:</strong> <?php echo $episodes ?></p>
                    <p class="card-text"><strong>Director:</strong> <?php echo $director ?></p>
                    <p class="card-text"><strong>Sinopsis:</strong> <?php echo $description ?></p>

                    <!-- Mostrar calificación promedio -->
                    <div class="d-flex justify-content-center">
                        <p class="bg-warning text-black p-3 rounded text-center" style="font-size: 1.5rem; width: fit-content;">
                            <strong>Calificación Promedio:</strong> <?php echo number_format($avg_rating, 1) ?> <i class="fas fa-star"></i>
                        </p>
                    </div>
                    
                    <!-- Formulario para calificar (mostrar solo si usuario ha iniciado sesión) -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form method="post" action="series.php?id=<?php echo $series_id ?>">
                            <label for="rating">Opina sobre esta serie:</label>
                            <select name="rating" id="rating" required>
                                <option value="">Selecciona una calificación</option>
                                <option value="1">1 - Muy Malo</option>
                                <option value="2">2 - Malo</option>
                                <option value="3">3 - Regular</option>
                                <option value="4">4 - Bueno</option>
                                <option value="5">5 - Excelente</option>
                            </select><br><br>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    <?php else: ?>
                        <p>Por favor <a href="login.php">inicia sesión</a> para calificar esta serie.</p>
                    <?php endif; ?>
                    <!-- Botón para dejar reseña (mostrar solo si usuario ha iniciado sesión) -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="series_review.php?id=<?php echo $series_id ?>" class="btn btn-primary">Deja tu reseña</a>
                    <?php else: ?>
                        <p>Por favor <a href="login.php">inicia sesión</a> para dejar tu reseña.</p>
                    <?php endif; ?>

                    <!-- Sección para mostrar las reseñas -->
                    <hr>
                    <h5>Otras reseñas</h5>
                    <?php
                    if ($result_reviews->num_rows > 0) {
                        while ($row_review = $result_reviews->fetch_assoc()) {
                            $username = $row_review['username'];
                            $review_title = $row_review['review_title'];
                            $review_content = $row_review['review_content'];
                            $review_created_at = $row_review['review_created_at'];
                    ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted"><strong>Usuario:</strong> <?php echo $username ?></h6>
                                    <h6 class="card-subtitle mb-2 text-muted"><strong>Fecha:</strong> <?php echo $review_created_at ?></h6>
                                    <h5 class="card-title"><strong><?php echo $review_title ?></strong></h5>
                                    <p class="card-text"><?php echo $review_content ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No hay reseñas disponibles.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>