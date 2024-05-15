<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoEmpleado = $_POST["codigoEmpleado"];
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT * FROM usuarios WHERE codigoEmpleado = '$codigoEmpleado' AND contrasena = '$contrasena'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        // Usuario autenticado correctamente
        $_SESSION["codigoEmpleado"] = $codigoEmpleado;
        $_SESSION["rol"] = $resultado->fetch_assoc()["rol"]; // Asignar el rol del usuario a la sesión
        header("location: index.php"); // Redirigir al usuario a la página principal
        exit;
    } else {
        $error = "Código de empleado o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body class="body_login">
    <div class="contenedor_login">
        <h1 class="h1_login">Control de Horas Extras</h1><br><br>
        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="codigoEmpleado" placeholder="Codigo de empleado">
            <label for="floatingInput">Codigo de Empleado</label>
            </div><br>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="contrasena" placeholder="Contraseña">
            <label for="floatingPassword">Contraseña</label>
            </div>
            <br>
            <button type="submit" class="btn btn-outline-primary">Iniciar Sesión</button>    
        </form>
    </div>
</body>
</html>
