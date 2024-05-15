<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoEmpleado = $_POST["codigoEmpleado"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"]; // Asegúrate de tener una forma segura de establecer el rol del usuario

    // Verificar si el código de empleado ya está registrado
    $sql_verificar = "SELECT * FROM Usuarios WHERE codigoEmpleado = '$codigoEmpleado'";
    $resultado_verificar = $conexion->query($sql_verificar);

    if ($resultado_verificar->num_rows > 0) {
        echo "El código de empleado ya está registrado. Por favor, ingresa otro código de empleado.";
    } else {
        $sql_insertar = "INSERT INTO usuarios (codigoEmpleado, nombres, apellidos, contrasena, rol) 
                         VALUES ('$codigoEmpleado', '$nombres', '$apellidos', '$contrasena', '$rol')";

        if ($conexion->query($sql_insertar) === TRUE) {
            echo '<script>alert("Registros de horas guardados correctamente"); window.location.href = "index.php";</script>';
        } else {
            echo "Error al registrar el usuario: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body class="body_registro">
    <div class="contenedor_registro">
        <h1 class="h1_registro">Registro de Usuarios</h1><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        
            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Apellidos" name="codigoEmpleado" required>
            <label for="codigoEmpleado">Código de Empleado:</label>
            </div>
            
            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Apellidos" name="nombres" required>
            <label for="nombres">Nombres:</label>
            </div>
            
            <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Apellidos" name="apellidos" required>
            <label for="apellidos">Apellidos:</label>
            </div>
            
            <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingInput" placeholder="Apellidos" name="contrasena" required>
            <label for="contrasena">Contraseña:</label>
            </div>
            

            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="usuario">Usuario</option>
                <option value="administrador">Administrador</option>
            </select><br><br>
            <button type="submit" class="btn btn-outline-primary">Registrar Usuario</button><br><br>
            <a href="index.php" class="btn btn-outline-primary">Regresar</a>
        </form>
    </div>
</body>
</html>

