<?php
// Segundo paso para inicar sesion 
session_start(); // Iniciar sesión

if ($_POST) {
    include("./bd.php");
    $sentencia = $conexion->prepare("SELECT *, count(*) as n_usuarios from usuarios 
                                    WHERE usuarios=:usuario
                                    AND password=:password");

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    // Depuración: ver el contenido de $registro
    //var_dump($registro); // Asegura que contiene los datos del usuario
    if ($registro["n_usuarios"] > 0) {
        // Aquí estamos accediendo correctamente a la columna "usuarios"
        $_SESSION['usuario'] = $registro["usuarios"]; 
        $_SESSION['logueado'] = true;
        header("Location: index.php");
        exit(); 
    } else {
        $mensaje = "Error: el usuario o contraseña son incorrectos";
    }
}
?>



<!--bs5  -->
<!doctype html>
<html lang="es">
    <head>
        <title>Iniciar Sesion</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"/>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main class="container vh-100 d-flex align-items-center">
        <div class="row" ></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <br/><br/>

            

            

            <div class="card">
                <div class="card-header" style="background-color: #ed3939; color: #ffffff; font-weight: bold;" >Iniciar Sesion</div>
                <div class="card-body" style="background-color: #f3eded; color: #000000; font-weight: bold; ">
                   <!-- Segundo paso agregando alert para  mostrar error  -->

                    <?php if (isset($mensaje)){?>
                        <div class="alert alert-danger"role="alert">
                        <strong><?php echo $mensaje;?></strong>
                        </div>
                    <?php } ?>
                    

                    <form action="" method="post"> 
                    <!-- bs5-card-head-f -->
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario: </label>
                        <input type="text" class="form-control" name="usuario" id="usuario"
                         aria-describedby="helpId" placeholder="Ingrese nombre de usuario" />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contrase&ntilde;a: </label>
                        <input type="password" class="form-control" name="password" id="password"
                         aria-describedby="helpId" placeholder="Ingrese contraseña del usuario" />
                    </div>

                    <button type="submit" class="btn btn-primary">Ingresar al sistema</button>
                    </form>
                </div>
                <div class="card-footer text-muted"></div>
            </div>
        </div>
        </main>


        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
    </body>

    
</html>
