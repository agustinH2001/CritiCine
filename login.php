<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $contraseña = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE email='$email' AND contraseña='$contraseña'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        session_start();
        
        $_SESSION['email'] = $email;

        header("Location: inicio.php");
    } else {
        echo "Correo electrónico o contraseña incorrectos.";
    }
}
?>
