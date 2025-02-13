<?php include("../../bd.php"); 
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: login.php");
    exit();
}
//envio de parametros en la url o en el metodo GET 
if (isset($_GET['txtID'])) {       
    $txtID = ($_GET['txtID'] != null) ? $_GET['txtID'] : "";//si recupera el id asigna el id recuperado caso contrario le asigna vacio 
    //Buscar el archivo relacionado con el empleado 


    //borra los datos del Materias 
    $sentencia=$conexion->prepare("DELETE FROM Materias WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute(); 
    //header("local:index.php");
}

//consulta para empledos y Materias mostrados como unico registro 
$sentencia = $conexion->prepare("SELECT * FROM Materias"); 
$sentencia->execute(); 
$lista_Materias= $sentencia->fetchAll(PDO::FETCH_ASSOC);
//print_r($lista_Materias);
?>


<?php include ("../../template/header.php")?>

<h2>lista de Materias</h2>

<!-- bs5-card-head-foot-->
<div class="card">
    <div class="card-header">

        <!--bs5-button-a-->
        <a name=""id=""class="btn btn-primary"href="crear.php"role="button">Nueva Materia</a>
  
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
                    <th scope="col">Materias</th>
                    <th scope="col">Acciones</th>              
                </tr>
            </thead>

            <tbody>
                <?php foreach($lista_Materias as $registro) {?>  
                <tr class="">
                    <td scope="row"> <?php echo $registro ['id']; ?> </td>
                    <td> <?php echo $registro ['NombreMateria']; ?> </td>       
                    <!--bs5-button-a-->
                    <td>
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
                <!--<tr class="">
                    <td scope="row">Item</td>
                    <td>Item</td>
                    <td>Item</td>    
                </tr>-->
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    </div>
    <!-- <div class="card-footer text-muted">Footer</div>-->
</div>

<?php include ("../../template/footer.php")?>
