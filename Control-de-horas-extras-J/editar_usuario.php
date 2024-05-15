<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION["codigoEmpleado"]) || $_SESSION["rol"] != "administrador") {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoEmpleado = $_POST["codigoEmpleado"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $rol = $_POST["rol"];

    $sql_actualizar = "UPDATE usuarios SET codigoEmpleado='$codigoEmpleado', nombres='$nombres', apellidos='$apellidos', rol='$rol' WHERE codigoEmpleado=$codigoEmpleado";

    if ($conexion->query($sql_actualizar) === TRUE) {
        echo '<script>alert("Usuario actualizado correctamente")</script>';
        header("location: administrar_usuarios.php");
        exit;
    } else {
        echo "Error al actualizar el usuario: " . $conexion->error;
    }
}

if (isset($_GET["codigoEmpleado"])) {
    $codigoEmpleado = $_GET["codigoEmpleado"];
    $sql = "SELECT * FROM usuarios WHERE codigoEmpleado=$codigoEmpleado";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
    } else {
        echo "Usuario no encontrado";
        exit;
    }
} else {
    echo "ID de usuario no especificado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contenedor_editar_usuarios">
        <h1>Editar Usuario</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

            <input type="hidden" name="codigoEmpleado" value="<?php echo $codigoEmpleado; ?>">

            <label for="codigoEmpleado">Código de Empleado:</label>
            <input type="text" id="codigoEmpleado" name="codigoEmpleado" value="<?php echo $fila["codigoEmpleado"]; ?>" required>

            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" value="<?php echo $fila["nombres"]; ?>" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $fila["apellidos"]; ?>" required>

            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="usuario" <?php echo ($fila["rol"] == "usuario") ? "selected" : ""; ?>>Usuario</option>
                <option value="administrador" <?php echo ($fila["rol"] == "administrador") ? "selected" : ""; ?>>Administrador</option>
            </select>
            <button type="submit">Guardar Cambios</button>
        </form>
        <br>
        <a href="administrar_usuarios.php">Volver a Administrar Usuarios</a>
    </div>
</body>
</html>
