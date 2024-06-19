<?php
session_start(); // Iniciar la sesión

include 'includes/header.php';

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirigir si ya está logueado
    exit();
}

include 'includes/db_connect.php'; // Incluir la conexión a la base de datos

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
            echo "<p>Contraseña incorrecta. Intenta de nuevo.</p>";
        }
    } else {
        echo "<p>Usuario no encontrado. Verifica tu nombre de usuario.</p>";
    }
}
?>

<h2>Login</h2>
<form method="post" action="login.php">
    <label for="username">Usuario:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>

<p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>

<?php
include 'includes/footer.php'; 
?>

