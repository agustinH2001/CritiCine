<?php
include 'includes/header.php';  
include 'includes/db_connect.php';  

// Verificar si el usuario ha iniciado sesión y es un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 3) {
    header("Location: login.php");  // Redirigir a la página de inicio de sesión si no hay sesión activa o no es admin
    exit();
}

// Procesar la actualización del rol del usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];

    if ($new_role === '') {
        // Establecer el rol a NULL si se selecciona "Remover roles"
        $sql_update_role = "UPDATE usuarios SET role_id = NULL WHERE user_id = ?";
    } else {
        // Actualizar el rol a 2 o 3
        $sql_update_role = "UPDATE usuarios SET role_id = ? WHERE user_id = ?";
    }

    $stmt = $conn->prepare($sql_update_role);

    if ($new_role === '') {
        $stmt->bind_param("i", $user_id);
    } else {
        $stmt->bind_param("ii", $new_role, $user_id);
    }

    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">Rol de usuario actualizado correctamente.</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error al actualizar el rol de usuario: ' . $conn->error . '</div>';
    }

    $stmt->close();
}

// Buscar usuarios
$search_results = [];
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    $sql_search_users = "SELECT user_id, username, email, role_id FROM usuarios WHERE username LIKE ?";
    $stmt = $conn->prepare($sql_search_users);
    $search_term = "%$search_term%";
    $stmt->bind_param("s", $search_term);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $search_results[] = $row;
    }

    $stmt->close();
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Panel de Administrador</h2>
            <form method="get" action="admin.php" class="form-inline mb-3">
                <input type="text" name="search" class="form-control mr-2" placeholder="Buscar usuario" required>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
            
            <?php if (!empty($search_results)): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Usuario</th>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                            <th>Rol Actual</th>
                            <th>Modificar Rol</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($search_results as $user): ?>
                            <tr>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['role_id'] !== null ? $user['role_id'] : 'Sin rol'; ?></td>
                                <td>
                                    <form method="post" action="admin.php">
                                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                        <select name="role" class="form-control">
                                            <option value="">Remover roles</option>
                                            <option value="2" <?php echo $user['role_id'] == 2 ? 'selected' : ''; ?>>Moderador</option>
                                            <option value="3" <?php echo $user['role_id'] == 3 ? 'selected' : ''; ?>>Admin</option>
                                        </select>
                                </td>
                                <td>
                                        <button type="submit" name="update_role" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php elseif (isset($_GET['search'])): ?>
                <p>No se encontraron usuarios.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>