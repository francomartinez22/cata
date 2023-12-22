<?php
$servidor = "localhost";
$baseDeDatos = "cata";
$usuario = "root";
$contrasena = "";
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasena);
    echo "Conexión exitosa...";
} catch (Exception $error) {
    echo "Error al conectar a la base de datos: " . $error->getMessage();
}
?>
