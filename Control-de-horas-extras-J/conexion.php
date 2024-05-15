<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$basedatos = "ControlHorasExtras";

$conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos);

if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>
