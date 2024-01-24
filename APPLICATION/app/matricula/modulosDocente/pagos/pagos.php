
<?php
require '../../../config/database.php';

$sqlcursos = "SELECT p.ID, p.Descripcion, p.Estado, p.FechaCreacion, p.UsuarioCreacion, p.FechaModificacion, p.UsuarioModificacion FROM curso AS p";

$cursos = $conn->query($sqlcursos);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <link rel="stylesheet" href="../../../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../../../assets/css/styles.css">
</head>

<body>


<?php include '../cabecera/cabecera.php'; ?>

    <div class="d-flex">
        <!--Barra lateral-->

        <?php include '../lateral/lateral.php'; ?>


        <!--Contenido-->
        <div style="width: 100%;">
            <div class="container py-3">
                <h2 class="text-center">PAGOS</h2>

                
            </div>
        </div>
    </div>







    
    <script src="../../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/js/index.js"></script>
</body>

</html>