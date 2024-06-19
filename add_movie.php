<?php
include 'includes/db_connect.php';
include 'includes/header.php';

// Verificar si el usuario está autenticado y tiene el rol de moderador
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] !== '2') {
    // Redirigir a otra página o mostrar un mensaje de error
    header("Location: index.php");
    exit();
}

// Resto del código

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $director = $_POST['director'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    $poster_url = $_POST['poster_url'];

    $sql = "INSERT INTO peliculas (title, genre, release_date, director, duration, description, poster_url) VALUES ('$title', '$genre', '$release_date', '$director', '$duration', '$description', '$poster_url')";

    if ($conn->query($sql) === TRUE) {
        echo "Película agregada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Agregar Película</h2>
<form method="post" action="add_movie.php">
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" required><br><br>

    <label for="genre">Género:</label>
    <input type="text" id="genre" name="genre" required><br><br>

    <label for="release_date">Fecha de Lanzamiento:</label>
    <input type="date" id="release_date" name="release_date" required><br><br>

    <label for="director">Director:</label>
    <input type="text" id="director" name="director" required><br><br>

    <label for="duration">Duración (minutos):</label>
    <input type="number" id="duration" name="duration" required><br><br>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="poster_url">URL del Póster:</label>
    <input type="url" id="poster_url" name="poster_url" required><br><br>

    <input type="submit" value="Agregar Película">
</form>
