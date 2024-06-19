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
    $seasons = $_POST['seasons'];
    $episodes = $_POST['episodes'];
    $director = $_POST['director'];
    $description = $_POST['description'];
    $poster_url = $_POST['poster_url'];

    $sql = "INSERT INTO series (title, genre, release_date, seasons, episodes, director, description, poster_url) VALUES ('$title', '$genre', '$release_date', '$seasons', '$episodes', '$director', '$description', '$poster_url')";

    if ($conn->query($sql) === TRUE) {
        echo "Serie agregada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Agregar Serie</h2>
<form method="post" action="add_series.php">
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" required><br><br>

    <label for="genre">Género:</label>
    <input type="text" id="genre" name="genre" required><br><br>

    <label for="release_date">Fecha de Lanzamiento:</label>
    <input type="date" id="release_date" name="release_date" required><br><br>

    <label for="seasons">Temporadas:</label>
    <input type="number" id="seasons" name="seasons" required><br><br>

    <label for="episodes">Episodios:</label>
    <input type="number" id="episodes" name="episodes" required><br><br>

    <label for="director">Director:</label>
    <input type="text" id="director" name="director" required><br><br>

    <label for="description">Descripción:</label>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="poster_url">URL del Póster:</label>
    <input type="url" id="poster_url" name="poster_url" required><br><br>

    <input type="submit" value="Agregar Serie">
</form>
