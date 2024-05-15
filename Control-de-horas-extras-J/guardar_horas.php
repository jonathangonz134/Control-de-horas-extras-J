<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoEmpleado = $_SESSION["codigoEmpleado"];
    $fecha = $_POST["fecha"];
    $horaInicio = $_POST["horaInicio"];
    $horaFin = $_POST["horaFin"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $actividades = $_POST["actividades"];
    $ticket = $_POST["ticket"];

    $sql = "INSERT INTO horasextras (codigoEmpleado, fecha, horaInicio, horaFin, nombres, apellidos, actividades, ticket) 
            VALUES ('$codigoEmpleado', '$fecha', '$horaInicio', '$horaFin', '$nombres', '$apellidos', '$actividades', '$ticket')";

    if ($conexion->query($sql) === TRUE) {
        echo '<script>alert("Registros de horas guardados correctamente"); window.location.href = "index.php";</script>';
        exit;
    } else {
        echo "Error al guardar los registros de horas: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Horas Extras</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body class="body_guardar_horas">
    <div class="contenedor_guardar_horas">
        <h1 class="h1_guardar_horas">Registrar Horas Extras</h1><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            
            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput"  name="codigoEmpleado" placeholder="name@example.com">
            <label for="floatingInput">Codigo de Empleado</label>
            </div>

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Nombres" name="nombres">
            <label for="nombres">Nombres:</label>
            </div>

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Apellidos" name="apellidos">
            <label for="apellidos">Apellidos:</label>
            </div>

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Actividades" name="actividades">
            <label for="actividades">Actividades Realizadas</label>
            </div>

            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Ticket" name="ticket">
            <label for="ticket">Ticket</label>
            </div>

            <div class="form-floating mb-3">
            <input type="date" class="form-control" id="floatingInput" placeholder="fecha" name="fecha" required><br>
            <label for="fecha">Fecha:</label>
            </div>

            <div class="form-floating mb-3">
            <input type="time" class="form-control" id="floatingInput" placeholder="Hora Inicio" name="horaInicio" required><br>
            <label for="horaInicio">Hora Inicio:</label>
            </div>

            <div class="form-floating mb-3">
            <input type="time" class="form-control" id="floatingInput" placeholder="Hora Fin" name="horaFin" required><br>
            <label for="horaFin">Hora Fin:</label>
            </div>            

            <button type="submit" class="btn btn-outline-primary">Guardar Horas Extras</button>
        </form>
        <br>
        <a href="index.php" class="btn btn-outline-primary">Volver al inicio</a>
    </div>
</body>
</html>
