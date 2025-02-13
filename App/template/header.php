
<?php 
$url_base="http://localhost:80/App/";
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
 
<!-- bs5-$ -->
<!doctype html>
<html lang="es">
    <head>
        <title>Sistema App</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />  <!-- metadatos -->
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
            <!-- SweetAlert ventanas de dialogo  -->       
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
            crossorigin="anonymous"></script>

            <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
            <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        
        <!-- b5-navbar-minimal-ul -->
         <nav class="navbar navbar-expand navbar-light bg-danger">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $url_base;?>" aria-current="page"
                        ><strong>Sistema Web </strong> <span class="visually-hidden">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>secciones/empleados/"><strong>Empleados </strong> </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>secciones/puestos/"><strong>Puesto </strong> </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>secciones/usuarios/"><strong>Usuarios </strong> </a>
                </li>
                    <!-- place navbar here 
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>secciones/Docentes/"><strong>Docentes </strong> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>secciones/Materias/"><strong>Materias </strong> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>secciones/Estudiantes/"><strong>Estudiantes </strong> </a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base;?>cerrar.php">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="40px"
                         fill="#070707"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                    </a>
                </li>   
                

            </ul>
         </nav>
         

        <main class="container">
            <!-- si hubo envio de mensaje -->
            <?php if (isset($_GET['mensaje'])){?>
                <script> 
                    swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});               
                </script>
            
           <?php } ?>


           
