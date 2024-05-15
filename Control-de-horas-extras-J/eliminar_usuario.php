<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION["codigoEmpleado"]) || $_SESSION["rol"] != "administrador") {
    header("location: login.php");
    exit;
}

if (isset($_GET["codigoEmpleado"])) {
    $id = $_GET["codigoEmpleado"];
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoEmpleado = $_POST["id"];
    $sql_eliminar = "DELETE FROM usuarios WHERE codigoEmpleado=$codigoEmpleado";

    if ($conexion->query($sql_eliminar) === TRUE) {
        echo '<script>alert("Usuario eliminado correctamente")</script>';
        header("location: administrar_usuarios.php");
        exit;
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contenedor_eiminar_usuarios">
        <h1>Eliminar Usuario</h1>
        <p>¿Estás seguro de que deseas eliminar al siguiente usuario?</p>
        <p>Código de Empleado: <?php echo $fila["codigoEmpleado"]; ?></p>
        <p>Nombres: <?php echo $fila["nombres"]; ?></p>
        <p>Apellidos: <?php echo $fila["apellidos"]; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="codigoEmpleado" value="<?php echo $codigoEmpleado; ?>">
            <button type="submit">Eliminar Usuario</button>
        </form>
        <br>
        <a href="administrar_usuarios.php">Cancelar</a>
    </div>
</body>
</html>
