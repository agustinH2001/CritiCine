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

$series_id = null;

// Procesar la búsqueda por título y establecer el series_id
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search_term = $_POST['search'];

    // Consulta para buscar la serie por título
    $sql_search = "SELECT * FROM series WHERE title LIKE '%$search_term%'";
    $result_search = $conn->query($sql_search);

    if ($result_search->num_rows > 0) {
        $row = $result_search->fetch_assoc();
        $series_id = $row['series_id'];
    } else {
        echo "<div class='alert alert-warning' role='alert'>No se encontró ninguna serie con el título '$search_term'.</div>";
    }
}

// Procesar el formulario de actualización si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $series_id = $_POST['series_id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $seasons = $_POST['seasons'];
    $episodes = $_POST['episodes'];
    $director = $_POST['director'];
    $description = $_POST['description'];

    // Consulta para actualizar la serie
    $sql_update = "UPDATE series SET 
                    title = '$title',
                    genre = '$genre',
                    release_date = '$release_date',
                    seasons = $seasons,
                    episodes = $episodes,
                    director = '$director',
                    description = '$description'
                    WHERE series_id = $series_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Serie actualizada exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al actualizar la serie: " . $conn->error . "</div>";
    }
}

// Si se ha encontrado una serie, obtener su información
if ($series_id) {
    // Consulta para obtener la serie por series_id
    $sql_series = "SELECT * FROM series WHERE series_id = $series_id";
    $result_series = $conn->query($sql_series);

    if ($result_series->num_rows > 0) {
        $row = $result_series->fetch_assoc();
        $title = $row['title'];
        $genre = $row['genre'];
        $release_date = $row['release_date'];
        $seasons = $row['seasons'];
        $episodes = $row['episodes'];
        $director = $row['director'];
        $description = $row['description'];
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: Serie no encontrada.</div>";
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Editar Series</h2>

    <!-- Formulario de búsqueda por título -->
    <form method="post" action="edit_series.php" class="mb-4">
        <div class="form-group">
            <label for="search">Buscar por Título:</label>
            <input type="text" id="search" name="search" class="form-control" placeholder="Ingrese título de la serie">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Formulario de edición si se ha encontrado una serie -->
    <?php if ($series_id): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Género</th>
                        <th>Fecha de Estreno</th>
                        <th>Temporadas</th>
                        <th>Episodios</th>
                        <th>Director</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <form method="post" action="edit_series.php">
                            <input type="hidden" name="series_id" value="<?php echo $series_id; ?>">
                            <td><input type="text" name="title" value="<?php echo $title; ?>" required></td>
                            <td><input type="text" name="genre" value="<?php echo $genre; ?>" required></td>
                            <td><input type="date" name="release_date" value="<?php echo $release_date; ?>" required></td>
                            <td><input type="number" name="seasons" value="<?php echo $seasons; ?>" required></td>
                            <td><input type="number" name="episodes" value="<?php echo $episodes; ?>" required></td>
                            <td><input type="text" name="director" value="<?php echo $director; ?>" required></td>
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
