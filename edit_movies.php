<?php
include 'includes/header.php';
include 'includes/db_connect.php';

// Verificar si el usuario está autenticado y tiene el rol de moderador
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] !== '2') {
    // Redirigir a index
    header("Location: index.php");
    exit();
}

// Resto del código

$movie_id = null;

// Procesar la búsqueda por título y establecer el movie_id
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search_term = $_POST['search'];

    // Consulta para buscar la película por título
    $sql_search = "SELECT * FROM peliculas WHERE title LIKE '%$search_term%'";
    $result_search = $conn->query($sql_search);

    if ($result_search->num_rows > 0) {
        $row = $result_search->fetch_assoc();
        $movie_id = $row['movie_id'];
    } else {
        echo "<div class='alert alert-warning' role='alert'>No se encontró ninguna película con el título '$search_term'.</div>";
    }
}

// Procesar el formulario de actualización si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $movie_id = $_POST['movie_id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $director = $_POST['director'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];

    // Consulta para actualizar la película
    $sql_update = "UPDATE peliculas SET 
                    title = '$title',
                    genre = '$genre',
                    release_date = '$release_date',
                    director = '$director',
                    duration = '$duration',
                    description = '$description'
                    WHERE movie_id = $movie_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Película actualizada exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al actualizar la película: " . $conn->error . "</div>";
    }
}

// Si se ha encontrado una película, obtener su información
if ($movie_id) {
    // Consulta para obtener la película por movie_id
    $sql_movie = "SELECT * FROM peliculas WHERE movie_id = $movie_id";
    $result_movie = $conn->query($sql_movie);

    if ($result_movie->num_rows > 0) {
        $row = $result_movie->fetch_assoc();
        $title = $row['title'];
        $genre = $row['genre'];
        $release_date = $row['release_date'];
        $director = $row['director'];
        $duration = $row['duration'];
        $description = $row['description'];
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: Película no encontrada.</div>";
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Editar Películas</h2>

    <!-- Formulario de búsqueda por título -->
    <form method="post" action="edit_movies.php" class="mb-4">
        <div class="form-group">
            <label for="search">Buscar por Título:</label>
            <input type="text" id="search" name="search" class="form-control" placeholder="Ingrese título de la película">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Formulario de edición si se ha encontrado una película -->
    <?php if ($movie_id): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Género</th>
                        <th>Fecha de Estreno</th>
                        <th>Director</th>
                        <th>Duración (min)</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <form method="post" action="edit_movies.php">
                            <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
                            <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                            <td><input type="text" name="genre" value="<?php echo $genre; ?>" required></td>
                            <td><input type="date" name="release_date" value="<?php echo $release_date; ?>" required></td>
                            <td><input type="text" name="director" value="<?php echo $director; ?>" required></td>
                            <td><input type="number" name="duration" value="<?php echo $duration; ?>" required></td>
                            <td><textarea name="description" rows="2" required><?php echo $description; ?></textarea></td>
                            <td>
                                <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

