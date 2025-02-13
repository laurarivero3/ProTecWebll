<?php include("../../bd.php");
if($_POST){
    print_r($_POST);
    //validacion del nombre del puesto
    $Estudiantes=(isset($_POST["Estudiantes"])?$_POST["Estudiantes"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:""); 
    //$sentencia=$conexion->prepare(query:"INSERT INTO puestos(id, NombreDelPuesto)
    //values (null, \:NombreDelPuesto)");

    $sentencia = $conexion->prepare("INSERT INTO Estudiantes(id, Estudiantes, password, correo) 
    VALUES (null, :Estudiantes, :password, :correo)");

    //asignando los valores que vienen del metodo post (los que vienen del formulario)
    $sentencia->bindParam(param: ":Estudiantes", var: $Estudiantes);
    $sentencia->bindParam(param: ":password", var: $password);
    $sentencia->bindParam(param: ":correo", var: $correo);
    $sentencia->execute();
    $mensaje="Estudiante Agregado";
    //redireccionar el formulario indext.php
    header(header: "Location:index.php?mensaje=" . $mensaje);

}
?>

<?php include("../../template/header.php")?>
<br/>
<!-- bs5-card-head-foot-->
<link rel="stylesheet" href="../estilos.css">
<div class="fondo-oscuro"></div>
<div class="ventana-flotante">

<div class="card">
    <div class="card-header">Datos de Estudiantes</div>
    <div class="card-body">
        <!--form:post -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="Estudiantes" class="form-label">Nombre Del Estudiantes</label>
                <input type="text" class="form-control" name="Estudiantes" id="Estudiantes" aria-describedby="helpId" placeholder="Colocar el nombre del Estudiantes">
                <small id="helpId" class="form-text text-muted">Ingrese el nombre del Estudiantes</small>
                <div id="errorUsuario" style="color:red;"></div> <!-- Aquí se mostrará el mensaje de error -->
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="text" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Colocar contraseña">
                <small id="helpId" class="form-text text-muted">Ingrese la Contraseña</small>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" value="<?php echo isset($correo) ? htmlspecialchars($correo) : ''; ?>" 
                    class="form-control" name="correo" id="correo" 
                    aria-describedby="helpId" placeholder="Colocar correo electrónico" 
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                <div class="invalid-feedback"> Por favor, ingresa un correo válido (pepito@gmail.com). </div>
            </div>


            <button type="submit" class="btn btn-success" >Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
</div>

<script>
document.getElementById('Estudiantes').addEventListener('blur', function() {
    const usuario = this.value.trim();

    // Si el campo no está vacío
    if (usuario !== "") {
        fetch('validar_usuario.php', {
            method: 'POST',
            body: new URLSearchParams('usuario=' + usuario)  // Enviar el nombre de usuario al servidor
        })
        .then(response => response.text()) // Obtener la respuesta del servidor
        .then(data => {
            document.getElementById('errorUsuario').textContent = data; // Mostrar mensaje de error o éxito
        })
        .catch(error => console.log(error));
    }
});
</script>

<?php include ("../../template/footer.php")?>
