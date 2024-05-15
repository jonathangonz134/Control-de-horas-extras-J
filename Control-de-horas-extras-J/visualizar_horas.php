<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION["codigoEmpleado"])) {
    header("location: login.php");
    exit;
}

$rol = $_SESSION["rol"];
if ($rol == "usuario") {
    $codigoEmpleado = $_SESSION["codigoEmpleado"];
    $sql = "SELECT * FROM HorasExtras WHERE codigoEmpleado = '$codigoEmpleado'";
} elseif ($rol == "administrador") {
    $sql = "SELECT * FROM HorasExtras";
} else {
    // Manejo de errores o redirección si el rol no es válido
    header("location: error.php");
    exit;
}

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Horas Extras</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body class="body_visualizar_horas">
    <div class="contenedor_visualizar_horas">
        <h1 class="h1_visualizar_horas">Horas Extras Registradas</h1>
        <table class="table table-striped table-hover">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr class="table-primary">
                    <th >Código Empleado</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Trabajo Realizado</th>
                    <th>Ticket</th>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                </tr>
            </thead>
            <tbody>
                <!-- Datos de las horas extras -->
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr class="table-info">
                        <td ><?php echo $fila['codigoEmpleado']; ?></td>
                        <td><?php echo $fila['nombres']; ?></td>
                        <td><?php echo $fila['apellidos']; ?></td>
                        <td><?php echo $fila['actividades']; ?></td>
                        <td><?php echo $fila['ticket']; ?></td>
                        <td><?php echo $fila['fecha']; ?></td>
                        <td><?php echo $fila['horaInicio']; ?></td>
                        <td><?php echo $fila['horaFin']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <a href="index.php" class="btn btn-outline-primary">Volver al inicio</a>
    </div>
</body>
</html>