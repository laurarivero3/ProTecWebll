<?php include("../../bd.php");

//consulta de puestos 
$sentencia = $conexion->prepare("SELECT id, NombreDelPuesto FROM puestos"); 
$sentencia->execute(); 
$lista_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


if($_POST){
    print_r($_POST);
    //validacion del nombre del puesto
    $primerNombre=(isset($_POST["primerNombre"])?$_POST["primerNombre"]:""); //si hay informacion en el nombre del puesto pregunta sino rnvia vacio
    $segundoNombre=(isset($_POST["segundoNombre"])?$_POST["segundoNombre"]:""); 
    $primerApellido=(isset($_POST["primerApellido"])?$_POST["primerApellido"]:""); 
    $segundoApellido=(isset($_POST["segundoApellido"])?$_POST["segundoApellido"]:""); 
    //para foto y cv cambialos a $_file y agregamos name 
    $foto=(isset($_FILES["foto"]["name"])?$_FILES["foto"]["name"]:""); 
    $cv=(isset($_FILES["cv"]["name"])?$_FILES["cv"]["name"]:""); 
    //$foto=(isset($_POST["foto"])?$_POST["foto"]:""); 
    //$cv=(isset($_POST["cv"])?$_POST["cv"]:""); 
    $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:""); 
    $fechaIngreso=(isset($_POST["fechaIngreso"])?$_POST["fechaIngreso"]:""); 
    //preparar la insercion de los datos 
    //$sentencia=$conexion->prepare(query:"INSERT INTO puestos(id, NombreDelPuesto)
    //values (null, \:NombreDelPuesto)");

    $sentencia = $conexion->prepare("INSERT INTO empleados(id, primerNombre, segundoNombre, primerApellido, segundoApellido,
    foto, cv, idpuesto, fechaIngreso) 
    VALUES (null, :primerNombre, :segundoNombre, :primerApellido, :segundoApellido, :foto, :cv, :idpuesto, :fechaIngreso)");

    //asignando los valores que vienen del metodo post (los que vienen del formulario)
    $sentencia->bindParam(param: ":primerNombre", var: $primerNombre);
    $sentencia->bindParam(param: ":segundoNombre", var: $segundoNombre);
    $sentencia->bindParam(param: ":primerApellido", var: $primerApellido);
    $sentencia->bindParam(param: ":segundoApellido", var: $segundoApellido);
    //$sentencia->bindParam(param: ":foto", var: $foto);
    //$sentencia->bindParam(param: ":cv", var: $cv);

    //adjuntamos foto
    $fecha_=new DateTime();
    $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]["name"]:"";
    //archivo temporal de la foto
    $tmp_foto = $_FILES["foto"]["tmp_name"];
    if ($tmp_foto != '') {
        move_uploaded_file($tmp_foto, "./" . $nombreArchivo_foto);
    }
    $sentencia->bindParam(":foto", $nombreArchivo_foto);
    //cv
    $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]["name"]:"";
    //archivo temporal de la cv
    $tmp_cv=$_FILES["cv"]["tmp_name"];
    if($tmp_cv!=''){
        move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);
    }
    $sentencia->bindParam(":cv", $nombreArchivo_cv);
    $sentencia->bindParam(param: ":idpuesto", var: $idpuesto);
    $sentencia->bindParam( param:":fechaIngreso", var: $fechaIngreso);


    $sentencia->execute();
    $mensaje="Empleado agregado exitosamente";
    //redireccionar el formulario index.php
    header("Location:index.php?mensaje=" . $mensaje);

    
}

?>



<?php include ("../../template/header.php")?>
<br/>

<link rel="stylesheet" href="estilos.css">
<div class="fondo-oscuro"></div>
<div class="ventana-flotante">

<!-- bs5-card-head-foot-->
<div class="card">
    <div class="card-header">Datos del Empleado</div>
    <div class="card-body">
        <!--form:post -->
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="primerNombre" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" name="primerNombre" id="primerNombre" aria-describedby="helpId" placeholder="Colocar el primer nombre ">
                <small id="helpId" class="form-text text-muted">Ingrese el primer nombre</small>
            </div>
        
            <div class="mb-3">
                <label for="segundoNombre" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" name="segundoNombre" id="segundoNombre" aria-describedby="helpId" placeholder="Colocar el segundo nombre ">
                <small id="helpId" class="form-text text-muted">Ingrese el segundo nombre</small>
            </div>

            <div class="mb-3">
                <label for="primerApellido" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="primerApellido" id="primerApellido" aria-describedby="helpId" placeholder="Colocar el primer apellido ">
                <small id="helpId" class="form-text text-muted">Ingrese el primer apellido</small>
            </div>

            <div class="mb-3">
                <label for="segundoApellido" class="form-label"> Segundo  Apellido</label>
                <input type="text" class="form-control" name="segundoApellido" id="segundoApellido" aria-describedby="helpId" placeholder="Colocar el segundo apellido ">
                <small id="helpId" class="form-text text-muted">Ingrese el segundo apellido </small>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" id="foto" accept="image/*" aria-describedby="helpId" placeholder="Colocar el primer nombre ">
                <small id="helpId" class="form-text text-muted">Ingrese el primer nombre</small>
            </div>

            <div class="mb-3">
                <label for="cv" class="form-label"> Curriculum Vitae (PDF) </label>
                <input type="file" class="form-control" name="cv" id="cv" accept=".pdf" aria-describedby="helpId" placeholder="curriculum vitae ">
                <small id="helpId" class="form-text text-muted">Adjuntar un archivo en PDF</small>
            </div>
             <!--<div class="mb-3">
                <label for="idpuesto" class="form-label"> Puesto</label>
                <input type="text" class="form-control" name="idpuesto" id="idpuesto" aria-describedby="helpId" placeholder="Colocar el puesto ">
                <small id="helpId" class="form-text text-muted">Ingrese el Puesto</small>
            </div> -->
            <div class="mb-3">
                <label for="idpuesto" class="form-label"> Materia </label>
               <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                <option selected>Seleccione una opción</option>
                <?php foreach ($lista_puestos as $registro) { ?>
                    <option value="<?php echo $registro['NombreDelPuesto']; ?>">
                        <?php echo $registro['NombreDelPuesto']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            
            <div class="mb-3">
                <label for="fechaIngreso" class="form-label"> Fecha ingreso</label>
                <input type="date" class="form-control" name="fechaIngreso" id="fechaIngreso" aria-describedby="helpId" placeholder="Colocar la fecha de ingreso ">
                <small id="helpId" class="form-text text-muted">Ingrese la fecha de ingreso </small>
            </div>

            <button type="submit" class="btn btn-success" >Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

       
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

 </div>



<?php include ("../../template/footer.php")?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>