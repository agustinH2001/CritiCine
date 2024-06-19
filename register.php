<?php
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/db_connect.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo '<div class="alert alert-danger" role="alert">Las contraseñas no coinciden. Por favor, intenta de nuevo.</div>';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Validar formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-danger" role="alert">Formato de email inválido. Introduce un email válido.</div>';
        } else {
            // Validar nombre de usuario usando una expresión regular
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                echo '<div class="alert alert-danger" role="alert">El nombre de usuario solo puede contener letras, números y guiones bajos (_).</div>';
            } else {
                // Verificar si el nombre de usuario ya está registrado
                $sql_check_username = "SELECT * FROM usuarios WHERE username = '$username'";
                $result_username = $conn->query($sql_check_username);

                if ($result_username->num_rows > 0) {
                    echo '<div class="alert alert-danger" role="alert">El nombre de usuario ya está registrado. Por favor, elige otro.</div>';
                } else {
                    // Verificar si el correo electrónico ya está registrado
                    $sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
                    $result_email = $conn->query($sql_check_email);

                    if ($result_email->num_rows > 0) {
                        echo '<div class="alert alert-danger" role="alert">El correo electrónico ya está registrado. Por favor, usa otro.</div>';
                    } else {
                        // Insertar usuario si no hay conflictos
                        $sql_insert_user = "INSERT INTO usuarios (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

                        if ($conn->query($sql_insert_user) === TRUE) {
                            // Registro exitoso, mostrar notificación y redirigir a login.php
                            echo '<div class="alert alert-success" role="alert" id="notification">Registro exitoso.</div>';
                            echo '<script>setTimeout(function() { window.location.href = "login.php"; }, 3000);</script>'; // Redirigir después de 3 segundos
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Error al registrar usuario: ' . $conn->error . '</div>';
                        }
                    }
                }
            }
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header bg-dark text-white text-center">Registro</h5>
                <div class="card-body">
                    <form method="post" action="register.php">
                        <div class="form-group">
                            <label for="username">Usuario:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                            <small id="emailHelp" class="form-text text-muted">Introduce un email válido.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">Mostrar</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmar Contraseña:</label>
                            <div class="input-group">
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">Mostrar</button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                    </form>
                    <p class="mt-3">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    var passwordField = document.getElementById('password');
    var passwordFieldType = passwordField.getAttribute('type');
    if (passwordFieldType === 'password') {
        passwordField.setAttribute('type', 'text');
        this.textContent = 'Ocultar';
    } else {
        passwordField.setAttribute('type', 'password');
        this.textContent = 'Mostrar';
    }
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
    var confirmPasswordField = document.getElementById('confirm_password');
    var confirmPasswordFieldType = confirmPasswordField.getAttribute('type');
    if (confirmPasswordFieldType === 'password') {
        confirmPasswordField.setAttribute('type', 'text');
        this.textContent = 'Ocultar';
    } else {
        confirmPasswordField.setAttribute('type', 'password');
        this.textContent = 'Mostrar';
    }
});
</script>

<?php include 'includes/footer.php'; ?>
