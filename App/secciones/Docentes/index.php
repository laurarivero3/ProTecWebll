<?php include("../../bd.php"); 
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: login.php");
    exit();
}

//envio de parametros en la url o en el metodo GET 
if (isset($_GET['txtID'])) {       
    //$txtID = ($_GET['txtID'] != null) ? $_GET['txtID'] : "";//si recupera el id asigna el id recuperado caso contrario le asigna vacio 
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    //Buscar el archivo relacionado con el empleado 
    $sentencia = $conexion->prepare("SELECT foto,cv from Docentes WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute(); 
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

    //buscar los archivos y borrarlos foto
    if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
        if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);
        }
    }
    //buscar los archivos y borrarlos cv
    if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=""){
        if(file_exists("./".$registro_recuperado["cv"])){
            unlink("./".$registro_recuperado["cv"]);
        }
    }
    //borra los datos del empleado 
    $sentencia=$conexion->prepare("DELETE FROM Docentes WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute(); 
    header("local:index.php");
}


//consulta para empledos y Materias mostrados como unico registro 
$sentencia = $conexion->prepare("SELECT * ,
(select NombreMateria from Materias where Materias.id=Docentes.idmaterias 
limit 1 )as Materias FROM Docentes"); 
$sentencia->execute(); 
$lista_Docentes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//print_r($lista_Docentes);
?>


<?php include ("../../template/header.php")?>



<h2>lista de Docentes</h2>

<!-- bs5-card-head-foot-->
<div class="card">
    <div class="card-header">

        <!--bs5-button-a-->
        <a name=""id=""class="btn btn-primary"href="crear.php"role="button">Nuevo Docente</a>
  
        </div>
    <div class="card-body">

<!-- bs5-table-default-->
    <div
        class="table-responsive-sm">
        <table
            class="table table-primary" id="tabla_id">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombres y Apellidos</th>
                    <th scope="col">Fotos</th>
                    <th scope="col">Programa de la asignatura</th>
                    <th scope="col">Materias</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Acciones</th>

                </tr>
            </thead>
            <tbody>

            <?php foreach($lista_Docentes as $registro) {?>  
                <tr class="">
                    <td scope="row"> <?php echo $registro ['id']; ?> </td>
                    <td> 
                        <?php echo $registro ['primerNombre']; ?> 
                        <?php echo $registro ['segundoNombre']; ?> 
                        <?php echo $registro ['primerApellido']; ?> 
                        <?php echo $registro ['segundoApellido']; ?> </td>
                        
                    <td> 
                        <img width="50"
                        src="<?php echo $registro ['foto']; ?>"
                        class="img-fluid rounded" alt=""/>      
                     </td>
                    <td> 
                        <a href="<?php echo $registro ['cv']; ?>">
                        <?php echo $registro ['cv']; ?> </a>
                    </td>
                    <td> <?php echo $registro ['idmaterias']; ?></td>
                    <td> <?php echo $registro ['fechaIngreso']; ?> </td>
                    <!--bs5-button-a-->                  
                    <td>
                        <a name="" id="" class="btn btn-primary" href="carta_recomendacion.php?txtID=<?php echo $registro['id'];?>" role="button" >
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"  >
                            <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/>
                        </svg></a>

                        <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id'];?>" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" width="16px" fill="currentColor" viewBox="0 -960 960 960" >
                            <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
                        </svg></a>


                        <a name="" id="" class="btn btn-danger" href="javascript:borrar( <?php echo $registro['id'];?>);" role="button">                    
                        <svg xmlns="http://www.w3.org/2000/svg" height="16px" width="16px" fill="currentColor" viewBox="0 -960 960 960" >
                            <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                        </svg></a>

                       


                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>  
    </div>
</div>
<?php include ("../../template/footer.php")?>
