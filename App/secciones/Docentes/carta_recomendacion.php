<?php 
    include("../../bd.php");
    if(isset($_GET['txtID'])){
        $txtID = (isset($_GET['txtID']))?$_GET['txtID'] : "";
        
        $sentencia = $conexion->prepare("SELECT * , (SELECT NombreMateria
        from Materias where Materias.id=Docentes.idmaterias limit 1 ) as puesto
        from Docentes where id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute(); 
        //creamos variables 
        $registro=$sentencia->fetch(mode: PDO::FETCH_LAZY);
        $primerNombre = $registro["primerNombre"];
        $segundoNombre = $registro["segundoNombre"];
        $primerApellido = $registro["primerApellido"];
        $segundoApellido = $registro["segundoApellido"];
        $nombreCompleto=$primerNombre." ".$segundoNombre." ".$primerApellido." ".$segundoApellido;
        $foto = $registro["foto"];
        $cv = $registro["cv"];
        $idmaterias = $registro["idmaterias"];
        $puesto=$registro["puesto"];
        $fechaIngreso = $registro["fechaIngreso"];

        //calcualamos los años trabajados 
        $fechaInicio=new DateTime($fechaIngreso);
        $fechaFin= new DateTime(date('Y-m-d'));
        $diferencia=date_diff($fechaInicio, $fechaFin);

    }
    //marcamos el pdf
    ob_start();

?> 



 <!-- bs5-$ -->
<!doctype html>
<html lang="en">
    <head>
        <title>Carta De Recomendacion </title>
        <!-- Required meta tags -->
        <meta http-equiv="X-UA-compatible" content="IE=edge"/>
        <meta name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        /> -->
    </head>

    <body>
        <h3>UPDS</h3>
        <br/> <br/>
        Santa Cruz, Bolivia a <strong><?php echo date('D M Y'); ?> </strong>
        <br/> <br/>
        Estimado/a Profesor/a <strong><?php echo $primerApellido;?></strong>, 
        <br/> <br/>
        Reciba un cordial y respetuoso saludo.
        <br/> <br/>

        Es un placer informarle que, a partir del <strong><?php echo date('D M'); ?> </strong>
        se le ha asignado la materia de  <strong><?php echo $idmaterias;?></strong> para el siguiente modulo educativo
    .
        <br/> <br/>

        Le agradecemos su compromiso con la formaci&oacute;n de nuestros estudiantes y confiamos en que este 
        semestre ser&aacute; un &eacute;xito acad&eacute;mico. En caso de tener alguna duda o necesitar m&aacute;s 
        informaci&oacute;n, no dude en ponerse en contacto con Nosotros.

        <br/> <br/>
        Sin mas nada a que referir y esperando que esta misiva sea tomada, dejo mi n&uacute;mero de contacto 
        para cualquier aclaraci&oacute;n de interes. 
        <br/> <br/>
        Atentamente,
        <br/> <br/>
        Ing. Wilmer Campos Saavedra

    </body>
</html>
<?php 
    //hasta aqui para convertir en PDF
    $HTML=ob_get_clean();

    require_once("../../libs/autoload.inc.php");
    use Dompdf\Dompdf;
    $dompdf=new Dompdf();
    $opciones= $dompdf->getOptions();
    $opciones->set(array("isRemoteEnabled"=>true));
    $dompdf->setOptions($opciones);

    $dompdf->loadHtml($HTML);
    $dompdf->setPaper('letter');
    $dompdf->render();
    $dompdf->stream("archivo.pdf", array("Attachment"=>false));
?>


