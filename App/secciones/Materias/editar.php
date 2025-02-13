<?php include("../../bd.php");
session_start(); // Iniciar sesión

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']: "";
    $sentencia = $conexion->prepare("SELECT * FROM Materias where id=:id");
    $sentencia->bindParam(param: ":id", var: $txtID);
    $sentencia->execute();

    //creamos variable crear.php
    $registro=$sentencia->fetch(mode: PDO::FETCH_LAZY);
    $NombreMateria=$registro["NombreMateria"];
}



if($_POST){
    //validacion del nombre del puesto
    $txtID=(isset($_POST["txtID"])?$_GET["txtID"]:""); 
    $NombreMateria=(isset($_POST["NombreMateria"])?$_POST["NombreMateria"]:"");
    //preparar la insercion de los datos 
    //$sentencia=$conexion->prepare(query:"INSERT INTO Materias(id, NombreMateria)
    //values (null, \:NombreMateria)");

    $sentencia = $conexion->prepare("UPDATE Materias SET NombreMateria=:NombreMateria
    WHERE id=:id") ;
   //asignando los valores que vienen del metodo post (los que vienen del formulario)
    $sentencia->bindParam(param: ":NombreMateria", var: $NombreMateria);
    $sentencia->bindParam(param: ":id", var: $txtID);
    $sentencia->execute();
    $mensaje="Registro Actualizado";
    //redireccionar el formulario indext.php
    header(header: "Location:index.php?mensaje=" . $mensaje);
}
?>



<?php include ("../../template/header.php")?>
<br/>

<link rel="stylesheet" href="estilos.css">
<div class="fondo-oscuro"></div>
<div class="ventana-flotante">

<!-- bs5-card-head-foot-->
<div class="card">
    <div class="card-header">Datos del Puesto</div>
    <div class="card-body">
        <!--form:post -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtID; ?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="NombreMateria" class="form-label">Nombre Del Puesto</label>
                <input type="text" value="<?php echo $NombreMateria; ?>" 
                class="form-control" name="NombreMateria" id="NombreMateria" aria-describedby="helpId" placeholder="Colocar nombre de la materia">
            </div>

            <button type="submit" class="btn btn-success" >Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

       
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
</div>


<?php include ("../../template/footer.php")?>
