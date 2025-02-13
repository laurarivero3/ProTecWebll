<?php include("../../bd.php");
session_start(); // Iniciar sesión

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']: "";
    $sentencia = $conexion->prepare("SELECT * FROM empleados where id=:id");
    $sentencia->bindParam(param: ":id", var: $txtID);
    $sentencia->execute();

    //creamos variable crear.php
    $registro=$sentencia->fetch(mode: PDO::FETCH_LAZY);
    $primerNombre = $registro["primerNombre"];
    $segundoNombre = $registro["segundoNombre"];
    $primerApellido = $registro["primerApellido"];
    $segundoApellido = $registro["segundoApellido"];
    $foto = $registro["foto"];
    $cv = $registro["cv"];
    $idpuesto = $registro["idpuesto"];
    $fechaIngreso = $registro["fechaIngreso"];
}

if($_POST){
    //validacion del nombre del puesto
    $txtID=(isset($_POST["txtID"])?$_GET["txtID"]:""); 
    $primerNombre=(isset($_POST["primerNombre"])?$_POST["primerNombre"]:""); //si hay informacion en el nombre del puesto pregunta sino rnvia vacio
    $segundoNombre=(isset($_POST["segundoNombre"])?$_POST["segundoNombre"]:""); 
    $primerApellido=(isset($_POST["primerApellido"])?$_POST["primerApellido"]:""); 
    $segundoApellido=(isset($_POST["segundoApellido"])?$_POST["segundoApellido"]:""); 
    
    $foto=(isset($_POST["foto"])?$_POST["foto"]:""); 
    $cv=(isset($_POST["cv"])?$_POST["cv"]:""); 
    $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:""); 
    $fechaIngreso=(isset($_POST["fechaIngreso"])?$_POST["fechaIngreso"]:"");

    //preparar la insercion de los datos 
    $sentencia = $conexion->prepare("UPDATE empleados 
    SET primerNombre = :primerNombre, segundoNombre = :segundoNombre, 
    primerApellido = :primerApellido, segundoApellido = :segundoApellido, 
    foto = :foto, cv = :cv, idpuesto = :idpuesto, fechaIngreso = :fechaIngreso 
    WHERE id = :id");

    //asignando los valores que vienen del metodo post (los que vienen del formulario)
    $sentencia->bindParam(param: ":id", var: $txtID);
    $sentencia->bindParam(param: ":primerNombre", var: $primerNombre);
    $sentencia->bindParam(param: ":segundoNombre", var: $segundoNombre);
    $sentencia->bindParam(param: ":primerApellido", var: $primerApellido);
    $sentencia->bindParam(param: ":segundoApellido", var: $segundoApellido);
    $sentencia->bindParam(param: ":foto", var: $foto);
    $sentencia->bindParam(param: ":cv", var: $cv);
    $sentencia->bindParam(param: ":idpuesto", var: $idpuesto);
    $sentencia->bindParam( param:":fechaIngreso", var: $fechaIngreso);
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
    <div class="card-header">Datos del Empleado</div>
    <div class="card-body">
        <!--form:post -->
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtID; ?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="primerNombre" class="form-label">Primer Nombre</label>
                <input type="text" value="<?php echo $primerNombre; ?>"
                class="form-control" name="primerNombre" id="primerNombre" aria-describedby="helpId" placeholder="Colocar el primer nombre ">
            </div>
        
            <div class="mb-3">
                <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                <input type="text" value="<?php echo $segundoNombre; ?>"
                class="form-control" name="segundoNombre" id="segundoNombre" aria-describedby="helpId" placeholder="Colocar el segundo nombre ">
            </div>

            <div class="mb-3">
                <label for="primerApellido" class="form-label">Primer Apellido</label>
                <input type="text" value="<?php echo $primerApellido; ?>"
                class="form-control" name="primerApellido" id="primerApellido" aria-describedby="helpId" placeholder="Colocar el primer apellido ">
            </div>

            <div class="mb-3">
                <label for="segundoApellido" class="form-label"> Segundo  Apellido</label>
                <input type="text" value="<?php echo $segundoApellido; ?>"
                class="form-control" name="segundoApellido" id="segundoApellido" aria-describedby="helpId" placeholder="Colocar el segundo apellido ">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="text" value="<?php echo $foto; ?>"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Colocar el primer nombre ">
            </div>

            <div class="mb-3">
                <label for="cv" class="form-label">Curriculum Vitae </label>
                <input type="text" value="<?php echo $cv; ?>"
                class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="Colocar curriculum vitae ">
            </div>

            <div class="mb-3">
                <label for="idpuesto" class="form-label"> Puesto</label>
                <input type="text" value="<?php echo $idpuesto; ?>"
                class="form-control" name="idpuesto" id="idpuesto" aria-describedby="helpId" placeholder="Colocar el puesto ">
            </div>

            <div class="mb-3">
                <label for="fechaIngreso" class="form-label"> Fecha ingreso</label>
                <input type="date" value="<?php echo $fechaIngreso; ?>"
                class="form-control" name="fechaIngreso" id="fechaIngreso" aria-describedby="helpId" placeholder="Colocar la fecha de ingreso ">
            </div>

           

            <button type="submit" class="btn btn-success" >Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

       
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>



<?php include ("../../template/footer.php")?>
