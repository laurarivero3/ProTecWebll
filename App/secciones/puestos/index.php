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


    //borra los datos del puestos 
    $sentencia=$conexion->prepare("DELETE FROM puestos WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute(); 
    //header("local:index.php");
}

//consulta para empledos y puestos mostrados como unico registro 
$sentencia = $conexion->prepare("SELECT * FROM puestos"); 
$sentencia->execute(); 
$lista_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//print_r($lista_puestos);
?>


<?php include ("../../template/header.php")?>

<h2>lista de Puestos</h2>

<!-- bs5-card-head-foot-->
<div class="card">
    <div class="card-header">

        <!--bs5-button-a-->
        <a name=""id=""class="btn btn-primary"href="crear.php"role="button">Nuevo Puesto</a>
  
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
                    <th scope="col">Puestos</th>
                    <th scope="col">Acciones</th>              
                </tr>
            </thead>

            <tbody>
                <?php foreach($lista_puestos as $registro) {?>  
                <tr class="">
                    <td scope="row"> <?php echo $registro ['id']; ?> </td>
                    <td> <?php echo $registro ['NombreDelPuesto']; ?> </td>       
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


<!-- Autocompletado con AJAX -->
<div class="container mt-4">
    <div class="p-3 mb-3 bg-light rounded-3 shadow-sm">
        <h3 class="display-7 fw-bold">Sugerencias De Puestos</h3>    
        <br>
        <!-- Campo de búsqueda -->
        <input type="text" id="search" class="form-control" placeholder="Buscar puesto..." autocomplete="off">
        <!-- Lista de sugerencias con bordes -->
        <ul id="suggestions" class="list-group mt-2 border rounded-3"></ul>
    </div>
</div>

<!-- Script de autocompletado -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#search').on('input', function() {
        var query = $(this).val();

        // Si el texto tiene más de 2 caracteres, hacer la búsqueda
        if (query.length > 2) {
            $.ajax({
                url: '../../search.php', // Si search.php está en un directorio superior
 // Archivo PHP para manejar la búsqueda
                type: 'GET',
                data: { query: query },
                success: function(data) {
                    console.log(data); // Verifica que los datos estén siendo recibidos
                    $('#suggestions').html(data); // Mostrar las sugerencias
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX: " + error);
                }
            });
        } else {
            $('#suggestions').empty(); // Limpiar sugerencias si el campo está vacío
        }
    });

    // Al hacer clic en una sugerencia, llenar el campo de búsqueda con el texto seleccionado
    $(document).on('click', 'li', function() {
        $('#search').val($(this).text());
        $('#suggestions').empty(); // Limpiar sugerencias
    });
});

</script>

<!-- Agregar el script de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php include ("../../template/footer.php")?>






<?php include ("../../template/footer.php")?>
