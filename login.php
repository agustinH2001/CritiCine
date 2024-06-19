<?php
session_start(); // Iniciar la sesión

include 'includes/header.php';

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirigir si ya está logueado
    exit();
}

include 'includes/db_connect.php'; 

// Variables para manejar mensajes de error
$error = '';

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para obtener el usuario con el nombre de usuario proporcionado
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // Iniciar sesión y almacenar el ID de usuario en la variable de sesión
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            // Obtener el role_id del usuario y almacenarlo en la sesión
            $_SESSION['role_id'] = $row['role_id'];

            // Redirigir al usuario a la página de inicio o a otra página deseada
            header("Location: index.php");
            exit();
        } else {
            $error = "Contraseña incorrecta. Intenta de nuevo.";
        }
    } else {
        $error = "Usuario no encontrado. Verifica tu nombre de usuario.";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header bg-dark text-white text-center">Ingrese sus credenciales</h5>
                <div class="card-body">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label for="username">Usuario:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                    </form>
                    <p class="mt-3">¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

