<?php
include 'includes/header.php'; 
include 'includes/db_connect.php';  

// Verificar si el usuario ha iniciado sesión y obtener su ID
if (!isset($_SESSION['user_id'])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de login
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Consulta para obtener la información del usuario
$query = "SELECT username, email FROM usuarios WHERE user_id = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
} else {
    echo "<p>Error: Usuario no encontrado</p>";
    exit();
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tu info personal</h5>
                    <form>
                        <div class="form-group">
                            <label for="username">Nombre de Usuario (público):</label>
                            <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico (privado):</label>
                            <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
                        </div>
                    </form>
                    <a href="user_update.php" class="btn btn-primary">Actualizar Información</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
