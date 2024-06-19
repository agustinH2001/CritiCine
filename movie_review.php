<?php
include 'includes/header.php';
include 'includes/db_connect.php';

// Verificar si se proporcionó un ID de película válido
if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];

    // Consulta para obtener la información de la película
    $query = "SELECT * FROM peliculas WHERE movie_id = $movie_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
    } else {
        echo "<p>Película no encontrada</p>";
        exit();
    }
} else {
    echo "<p>ID de película no proporcionado</p>";
    exit();
}

// Verificar si el usuario ha iniciado sesión y obtener su ID
if (!isset($_SESSION['user_id'])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de login
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Consultar si el usuario ya ha dejado una reseña para esta película
$sql_check_review = "SELECT * FROM reviews_peliculas WHERE user_id = $user_id AND pelicula_id = $movie_id";
$result_check_review = $conn->query($sql_check_review);

if ($result_check_review->num_rows > 0) {
    // Si el usuario ya ha dejado una reseña, cargar los datos de la reseña existente
    $row_review = $result_check_review->fetch_assoc();
    $titulo = $row_review['title'];
    $contenido = $row_review['content'];
} else {
    // Si el usuario no ha dejado una reseña, inicializar los campos en blanco
    $titulo = "";
    $contenido = "";
}

// Procesar el formulario cuando se envíe la reseña
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    // Verificar si el usuario ya tiene una reseña para esta película
    if ($result_check_review->num_rows > 0) {
        // Actualizar la reseña existente
        $sql_update_review = "UPDATE reviews_peliculas 
                              SET title = '$titulo', content = '$contenido', created_at = NOW() 
                              WHERE user_id = $user_id AND pelicula_id = $movie_id";
        if ($conn->query($sql_update_review) === TRUE) {
            echo "<script>alert('Reseña actualizada');</script>";
        } else {
            echo "Error al actualizar la reseña: " . $conn->error;
        }
    } else {
        // Insertar una nueva reseña
        $sql_insert_review = "INSERT INTO reviews_peliculas (user_id, pelicula_id, title, content, created_at) 
                              VALUES ($user_id, $movie_id, '$titulo', '$contenido', NOW())";
        if ($conn->query($sql_insert_review) === TRUE) {
            echo "<script>alert('Reseña guardada');</script>";
        } else {
            echo "Error al insertar la reseña: " . $conn->error;
        }
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><strong>Reseña de la película: <?php echo $title ?></strong></h5>
                    <form method="post" action="movie_review.php?id=<?php echo $movie_id ?>">
                        <div class="form-group">
                            <label for="titulo">Título de la reseña:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="contenido">Contenido de tu reseña:</label>
                            <textarea class="form-control" id="contenido" name="contenido" rows="5" required><?php echo $contenido ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar reseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
