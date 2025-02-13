<?php include("../../bd.php");
session_start();
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']: "";
    $sentencia = $conexion->prepare("SELECT * FROM usuarios where id=:id");
    $sentencia->bindParam(param: ":id", var: $txtID);
    $sentencia->execute();

    //creamos variable crear.php
    $registro=$sentencia->fetch(mode: PDO::FETCH_LAZY);
    $usuarios = $registro["usuarios"];
    $password = $registro["password"];
    $correo = $registro["correo"];
}

if($_POST){
    //validacion del nombre del puesto
    $txtID=(isset($_POST["txtID"])?$_GET["txtID"]:""); 
    $usuarios=(isset($_POST["usuarios"])?$_POST["usuarios"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:""); 
    //$sentencia=$conexion->prepare(query:"INSERT INTO puestos(id, NombreDelPuesto)
    //values (null, \:NombreDelPuesto)");

    $sentencia = $conexion->prepare("UPDATE usuarios SET usuarios=:usuarios, password=:password, 
    correo=:correo WHERE id = :id");


    //asignando los valores que vienen del metodo post (los que vienen del formulario)
    $sentencia->bindParam(param: ":id", var: $txtID);
    $sentencia->bindParam(param: ":usuarios", var: $usuarios);
    $sentencia->bindParam(param: ":password", var: $password);
    $sentencia->bindParam(param: ":correo", var: $correo);
    $sentencia->execute();
    $mensaje="Registro Actualizado";
    //redireccionar el formulario indext.php
    header(header: "Location:index.php?mensaje=" . $mensaje);

}
?>



<?php include ("../../template/header.php")?>
<br/>
<!-- bs5-card-head-foot-->
<div class="card">
    <div class="card-header">Datos de Usuario</div>
    <div class="card-body">
        <!--form:post -->
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtID; ?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="usuarios" class="form-label">Nombre Del usuarios</label>
                <input type="text" value="<?php echo $usuarios; ?>"
                class="form-control" name="usuarios" id="usuarios" aria-describedby="helpId" placeholder="Colocar el nombre del usuario">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="text" value="<?php echo $password; ?>"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Colocar contraseña">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" 
                    value="<?php echo $correo; ?>"
                    class="form-control" name="correo" id="correo" 
                    aria-describedby="helpId" placeholder="Colocar correo electrónico" 
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                <div class="invalid-feedback"> Por favor, ingresa un correo válido (ejemplo@dominio.com). </div>
            </div>

        

            <button type="submit" class="btn btn-success" >Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

       
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>



<?php include ("../../template/footer.php")?>
