<?php
session_start();

if (!isset($_SESSION["codigoEmpleado"])) {
    header("location: login.php");
    exit;
}

$codigoEmpleado = $_SESSION["codigoEmpleado"];
$rol = $_SESSION["rol"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body class="body_index">
    <div class="contenedor_index">
        <h1 class="h1_index">Bienvenido <?php echo $codigoEmpleado; ?>!</h1>
        <p class="p_index">Tu rol es: <?php echo $rol; ?></p>
        <nav>
            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="guardar_horas.php" class="btn btn-primary">Registrar Horas Extras</a>
                <a href="visualizar_horas.php" class="btn btn-primary">Visualizar Horas Extras</a>
                


                <?php if ($rol == "administrador") { ?>
                    <a href="administrar_usuarios.php" class="btn btn-primary">Administrar Usuarios</a>
                <?php } ?>


                <?php
                if ($_SESSION["rol"] == "administrador") {
                echo '<a href="registro.php" class="btn btn-primary">Agregar Usuarios</a>';
                }?>
    
            <a href="logout.php" class="btn btn-primary">Cerrar Sesión</a>        
        </div>
</body>
</html>
