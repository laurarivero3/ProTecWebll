<?php
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
    header("Location: login.php");
    exit();
}

include("template/header.php");
?>



<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="container-fluid ">
            <a class="navbar-brand" href="#">Tecnología Web II</a>
            <div class="d-flex">
                <span class="navbar-text p-3 mb-2 bg-light rounded-5">
                    <?php
                    // Verificar si el usuario está logueado
                    if (isset($_SESSION['usuario']) && $_SESSION['logueado'] == true) {
                        echo "Bienvenido(a), <strong>" . $_SESSION['usuario'] . "</strong>";
                    }
                    ?>
                </span>
            </div>
        </div>
    </nav>
</body>
</html>

<br>
<div class="p-5 mb-4 bg-light  rounded-3"> 
    <div class="container-fluid py-7"></div> 
    <h1 class="display-6 fw-bold">Tecnología Web II</h1>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <p class="col-md-8 fs-4">
            Aprenderás a desarrollar aplicaciones web conectadas a 
            base de datos usando lenguajes del lado del servidor y 
            técnicas de optimización de algoritmos
            </p>
            <button class="btn btn-danger btn-lg" type="button">
                Mostrar Más
            </button>
        </div>
    </div>

</div> 
<?php include ("template/footer.php")?>
<br><br>

