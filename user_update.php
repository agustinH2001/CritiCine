<?php
include 'includes/header.php';
include 'includes/db_connect.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirigir a la página de inicio de sesión si no hay sesión activa
    exit();
}

$user_id = $_SESSION['user_id'];  // Obtener el ID de usuario de la sesión actual

// Obtener la información del usuario actual
$sql_user_info = "SELECT username, email FROM usuarios WHERE user_id = $user_id";
$result_user_info = $conn->query($sql_user_info);

if ($result_user_info->num_rows > 0) {
    $row = $result_user_info->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
} else {
    echo "<p>No se encontró información del usuario.</p>";
    exit();
}

// Procesar el formulario de actualización de datos cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Manejar la actualización del nombre de usuario
    if (isset($_POST['new_username'])) {
        $new_username = $_POST['new_username'];
        
        // Validar y actualizar el nombre de usuario
        if (!empty($new_username)) {
            // Verificar si el nuevo nombre de usuario ya está registrado
            $sql_check_username = "SELECT * FROM usuarios WHERE username = '$new_username' AND user_id != $user_id";
            $result_username = $conn->query($sql_check_username);
            
            if ($result_username->num_rows > 0) {
                echo "<script>alert('El nombre de usuario ya está en uso. Por favor, elige otro.');</script>";
            } else {
                $sql_update_username = "UPDATE usuarios SET username = '$new_username' WHERE user_id = $user_id";
                if ($conn->query($sql_update_username) === TRUE) {
                    $username = $new_username;  // Actualizar la variable local
                    echo "<script>alert('Nombre de usuario actualizado');</script>";
                } else {
                    echo "Error al actualizar el nombre de usuario: " . $conn->error;
                }
            }
        } else {
            echo "<script>alert('El nombre de usuario no puede estar vacío');</script>";
        }
    }
    
    // Manejar la actualización del correo electrónico
    if (isset($_POST['new_email'])) {
        $new_email = $_POST['new_email'];
        
        // Validar y actualizar el correo electrónico
        if (!empty($new_email) && filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            // Verificar si el nuevo correo electrónico ya está registrado
            $sql_check_email = "SELECT * FROM usuarios WHERE email = '$new_email' AND user_id != $user_id";
            $result_email = $conn->query($sql_check_email);
            
            if ($result_email->num_rows > 0) {
                echo "<script>alert('El correo electrónico ya está en uso. Por favor, usa otro.');</script>";
            } else {
                $sql_update_email = "UPDATE usuarios SET email = '$new_email' WHERE user_id = $user_id";
                if ($conn->query($sql_update_email) === TRUE) {
                    $email = $new_email;  // Actualizar la variable local
                    echo "<script>alert('Correo electrónico actualizado');</script>";
                } else {
                    echo "Error al actualizar el correo electrónico: " . $conn->error;
                }
            }
        } else {
            echo "<script>alert('El correo electrónico no es válido');</script>";
        }
    }
    
    // Manejar la actualización de la contraseña
    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validar y actualizar la contraseña
        if (!empty($new_password) && $new_password === $confirm_password) {
            // Hash de la contraseña
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            $sql_update_password = "UPDATE usuarios SET password = '$hashed_password' WHERE user_id = $user_id";
            if ($conn->query($sql_update_password) === TRUE) {
                echo "<script>alert('Contraseña actualizada');</script>";
            } else {
                echo "Error al actualizar la contraseña: " . $conn->error;
            }
        } else {
            echo "<script>alert('Las contraseñas no coinciden o están vacías');</script>";
        }
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Información del Usuario</h5>
                    <form method="post" action="user_update.php">
                        <div class="form-group">
                            <label for="username">Nombre de Usuario:</label>
                            <input type="text" class="form-control" id="username" name="new_username" value="<?php echo $username ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="new_email" value="<?php echo $email ?>" required>
                        </div>
                        <hr>
                        <h5>Cambiar Contraseña</h5>
                        <div class="form-group">
                            <label for="new_password">Nueva Contraseña:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmar Nueva Contraseña:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>