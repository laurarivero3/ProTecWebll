<?php
$servidor="localhost:3306"; //127.0.0.1
$baseDeDatos="App";
$usuario="root";
$contrasenia="";
try{
    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",
    username: $usuario,password: $contrasenia);
}catch(Exception $ex) {
    echo $ex -> getMessage();
}
?>

  