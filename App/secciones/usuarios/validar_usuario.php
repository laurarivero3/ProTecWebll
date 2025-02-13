<?php
include("../../bd.php");

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];

    // Consultar si el usuario ya existe en la base de datos
    $sentencia = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE usuarios = :usuario");
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->execute();

    // Si el nombre de usuario existe, devuelve un mensaje
    $result = $sentencia->fetchColumn();
    if ($result > 0) {
        echo "El nombre de usuario ya está registrado.";
    } else {
        echo "El nombre de usuario está disponible.";
    }
}
?>
