<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION["codigoEmpleado"]) || $_SESSION["rol"] != "administrador") {
    header("location: login.php");
    exit;
}

$sql = "SELECT * FROM usuarios";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body class="body_administrar_usuarios">
    <div class="contenedor_administrar_usuarios">
        <h1 class="h1_administrar_usuarios">Administrar Usuarios</h1>
        <table>
            <tr>
                <th>Código Empleado</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila["codigoEmpleado"]; ?></td>
                    <td><?php echo $fila["nombres"]; ?></td>
                    <td><?php echo $fila["apellidos"]; ?></td>
                    <td><?php echo $fila["rol"]; ?></td>
                    <td>
                        
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <a href="index.php" class="btn btn-outline-primary">Volver al inicio</a>
    </div>
</body>
</html>
