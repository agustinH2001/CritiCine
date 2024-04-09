<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit(); 
}

include 'db.php';

$mensajeUsuario = '';
$errorUsuario = '';
$mensajePermiso = '';
$errorPermiso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registro_usuario'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    $query = "INSERT INTO usuarios (nombre, apellido, dni, email, contraseña) VALUES ('$nombre', '$apellido', '$dni', '$email', '$contraseña')";
    if (mysqli_query($conn, $query)) {
        $mensajeUsuario = "Usuario agregado correctamente.";
    } else {
        $errorUsuario = "Error al agregar usuario: " . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registro_permiso'])) {
    $id_modulo = $_POST['id_modulo'];
    $puede_crear = isset($_POST['puede_crear']) ? 1 : 0;
    $puede_leer = isset($_POST['puede_leer']) ? 1 : 0;
    $puede_modificar = isset($_POST['puede_modificar']) ? 1 : 0;
    $puede_borrar = isset($_POST['puede_borrar']) ? 1 : 0;

    $query = "INSERT INTO permisos (id_rol, id_modulo, puede_crear, puede_leer, puede_modificar, puede_borrar) VALUES ('$id_modulo', '$id_modulo', $puede_crear, $puede_leer, $puede_modificar, $puede_borrar)";
    if (mysqli_query($conn, $query)) {
        $mensajePermiso = "Permiso agregado correctamente.";
    } else {
        $errorPermiso = "Error al agregar permiso: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .module {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo $_SESSION['email']; ?>!</h1>
        <p>Su sesión ha sido iniciada correctamente.</p>
        <p><a href="logout.php">Cerrar sesión</a></p>

        <div class="module">
            <h2>Registrar nuevo usuario</h2>
            <?php if (!empty($mensajeUsuario)) { ?>
                <div class="message success"><?php echo $mensajeUsuario; ?></div>
            <?php } ?>
            <?php if (!empty($errorUsuario)) { ?>
                <div class="message error"><?php echo $errorUsuario; ?></div>
            <?php } ?>
            <form action="" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" required>
                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" required>
                <label for="contraseña">Contraseña:</label>
                <input type="password" name="contraseña" required>
                <button type="submit" name="registro_usuario">Registrar</button>
            </form>
        </div>

        <div class="module">
    <h2>Agregar nuevos permisos</h2>
    <?php if (!empty($mensajePermiso)) { ?>
        <div class="message success"><?php echo $mensajePermiso; ?></div>
    <?php } ?>
    <?php if (!empty($errorPermiso)) { ?>
        <div class="message error"><?php echo $errorPermiso; ?></div>
    <?php } ?>
    <form action="" method="post">
        <label for="id_rol">ID de Rol:</label>
        <select name="id_rol" required>
            <option value="1">Rol 1</option>
            <option value="2">Rol 2</option>
            <option value="3">Rol 3</option>
            <option value="4">Rol 4</option>
            <option value="5">Rol 5</option>
        </select><br><br>
        <label for="id_modulo">ID de Módulo:</label>
        <select name="id_modulo" required>
            <option value="1">Módulo 1</option>
            <option value="2">Módulo 2</option>
            <option value="3">Módulo 3</option>
        </select><br><br>
        <label>Permisos:</label><br>
        <input type="checkbox" name="puede_crear" id="puede_crear">
        <label for="puede_crear">Puede Crear</label><br>
        <input type="checkbox" name="puede_leer" id="puede_leer">
        <label for="puede_leer">Puede Leer</label><br>
        <input type="checkbox" name="puede_modificar" id="puede_modificar">
        <label for="puede_modificar">Puede Modificar</label><br>
        <input type="checkbox" name="puede_borrar" id="puede_borrar">
        <label for="puede_borrar">Puede Borrar</label><br><br>
        <button type="submit" name="registro_permiso">Registrar Permiso</button>
    </form>
</div>

    </div>
</body>
</html>
