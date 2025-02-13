<?php
include("bd.php"); // Incluir conexión a la base de datos

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    // Realiza la consulta en la base de datos
    $sentencia = $conexion->prepare("SELECT NombreDelPuesto FROM puestos WHERE NombreDelPuesto LIKE :query LIMIT 5");
    $sentencia->execute(['query' => "%$query%"]);
    $puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    // Imprimir las sugerencias como lista de elementos <li>
    foreach ($puestos as $puesto) {
        echo '<li class="list-group-item">' . htmlspecialchars($puesto['NombreDelPuesto']) . '</li>';
    }
}
?>
