<?php 
include("../../bd.php");

$mensajeError = ""; // Variable para almacenar el mensaje de error
$nombreDelPuesto = ""; // Para almacenar el valor del puesto

if ($_POST) {
    $nombreDelPuesto = isset($_POST["NombreDelPuesto"]) ? $_POST["NombreDelPuesto"] : "";

    // Validación del nombre del puesto
    if (empty($nombreDelPuesto)) {
        $mensajeError = "El nombre del puesto es obligatorio.";
    } elseif (strlen($nombreDelPuesto) < 3) {
        $mensajeError = "El nombre del puesto debe tener al menos 3 caracteres.";
    } else {
        // Verificar si el puesto ya existe en la base de datos
        $consulta = $conexion->prepare("SELECT COUNT(*) FROM puestos WHERE NombreDelPuesto = :NombreDelPuesto");
        $consulta->bindParam(":NombreDelPuesto", $nombreDelPuesto);
        $consulta->execute();
        $count = $consulta->fetchColumn();

        if ($count > 0) {
            $mensajeError = "Este puesto ya existe en la base de datos.";
        } else {
            // Insertar el puesto en la base de datos si no hay errores
            $sentencia = $conexion->prepare("INSERT INTO puestos(id, NombreDelPuesto) VALUES (null, :NombreDelPuesto)");
            $sentencia->bindParam(":NombreDelPuesto", $nombreDelPuesto);
            $sentencia->execute();
            $mensaje = "Registro Agregado";
            header("Location:index.php?mensaje=" . $mensaje); // Redirigir a la lista de puestos
            exit;
        }
    }
}
?>




<?php include("../../template/header.php"); ?>
<br />
<!-- bs5-card-head-foot -->
<link rel="stylesheet" href="../estilos.css">
<div class="fondo-oscuro"></div>
<div class="ventana-flotante">
    <div class="card">
        <div class="card-header">Datos del Puesto</div>
        <div class="card-body">
            <!--form:post -->
            <form action="" method="post" enctype="multipart/form-data" id="formPuesto">
                <div class="mb-3">
                    <label for="NombreDelPuesto" class="form-label">Nombre Del Puesto</label>
                    <input type="text" class="form-control" name="NombreDelPuesto" id="NombreDelPuesto" value="<?php echo htmlspecialchars($nombreDelPuesto); ?>" aria-describedby="helpId" placeholder="Colocar nombre del puesto">
                    <small id="helpId" class="form-text text-muted">Ingrese el nombre del puesto</small>

                    <?php if (!empty($mensajeError)): ?>
                        <div id="errorNombrePuesto" style="color: red;"><?php echo $mensajeError; ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success">Agregar</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
        <div class="card-footer text-muted"></div>
    </div>
</div>

<script>
    document.getElementById('formPuesto').addEventListener('submit', function (e) {
        const nombreDelPuesto = document.getElementById('NombreDelPuesto').value.trim();
        const errorDiv = document.getElementById('errorNombrePuesto');
        
        // Validación del nombre del puesto
        if (nombreDelPuesto === "") {
            errorDiv.textContent = "El nombre del puesto es obligatorio.";
            e.preventDefault(); // Evitar que el formulario se envíe
        } else if (nombreDelPuesto.length < 3) {
            errorDiv.textContent = "El nombre del puesto debe tener al menos 3 caracteres.";
            e.preventDefault(); // Evitar que el formulario se envíe
        } else {
            errorDiv.textContent = ""; // Limpiar mensaje de error
        }
    });
</script>

<?php include("../../template/footer.php"); ?>
