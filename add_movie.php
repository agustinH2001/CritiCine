<?php
include 'includes/db_connect.php';
include 'includes/header.php';

// Verificar si el usuario está autenticado y tiene el rol de moderador
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] !== '2') {
    // Redirigir a index si no es moderador
    header("Location: index.php");
    exit();
}

// Inicializar variables
$title = $genre = $release_date = $director = $duration = $description = $poster_url = "";
$message = "";

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $director = $_POST['director'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    $poster_url = $_POST['poster_url'];

    // Insertar película en la base de datos
    $sql = "INSERT INTO peliculas (title, genre, release_date, director, duration, description, poster_url) 
            VALUES ('$title', '$genre', '$release_date', '$director', '$duration', '$description', '$poster_url')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID de la película recién agregada
        $movie_id = $conn->insert_id;

        // Redirigir a la página de la película recién agregada
        header("Location: movie.php?id=$movie_id");
        exit();
    } else {
        $message = "Error al agregar la película: " . $conn->error;
    }
}
?>

<div class="container mt-5">
    <h2>Agregar Película</h2>
    <?php if (!empty($message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form method="post" action="add_movie.php">
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" class="form-control" required value="<?php echo htmlspecialchars($title); ?>">
        </div>
        <div class="form-group">
            <label for="genre">Género:</label>
            <input type="text" id="genre" name="genre" class="form-control" required value="<?php echo htmlspecialchars($genre); ?>">
        </div>
        <div class="form-group">
            <label for="release_date">Fecha de Lanzamiento:</label>
            <input type="date" id="release_date" name="release_date" class="form-control" required value="<?php echo htmlspecialchars($release_date); ?>">
        </div>
        <div class="form-group">
            <label for="director">Director:</label>
            <input type="text" id="director" name="director" class="form-control" required value="<?php echo htmlspecialchars($director); ?>">
        </div>
        <div class="form-group">
            <label for="duration">Duración (minutos):</label>
            <input type="number" id="duration" name="duration" class="form-control" required value="<?php echo htmlspecialchars($duration); ?>">
        </div>
        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <div class="form-group">
            <label for="poster_url">URL del Póster:</label>
            <input type="url" id="poster_url" name="poster_url" class="form-control" required value="<?php echo htmlspecialchars($poster_url); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Agregar Película</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
