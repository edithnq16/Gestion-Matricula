<?php
require '../../../config/database.php';
require '../../modulosDocente/calificaciones/funciones.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones</title>
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
            <div class="container py-4">
                <h2 class="text-center">CALIFICACIONES</h2>
            </div>

            <div class="enlaces">
                <a class="btn btn-primary" href="calificaciones.php" role="button">Inicio</a>
                <a class="btn btn-primary" href="notasVer.php" role="button">Registro de Notas</a>
                <a class="btn btn-primary" href="listaNotas.php" role="button">Consulta de Notas</a>
            </div>
            <br></br>
            <div class="container mt-5">
                <div class="row">
                    <div class="container py-4">
                        <h2 class="text-center">Grupos a cargo</h2>
                    </div>
                    <br><br>
                    <div class="col-md-4 mb-4">
                        <div class="card  ">
                            <div class="card-body">
                                <h5 class="card-title">Matemáticas</h5>
                                <p class="card-text">Primero "A"</p>
                                <a href="listaNotas.php?grado=1&curso=1&seccion=1&consultar=1" class="btn btn-primary">Ver notas</a>
                            </div>
                        </div>
                    </div>

                    <br></br>
                    <div class="col-md-4 mb-4">
                        <div class="card ">
                            <div class="card-body">
                                <h5 class="card-title">Matemáticas</h5>
                                <p class="card-text">Primero "B"</p>
                                <a href="listaNotas.php?grado=1&curso=1&seccion=1&consultar=1" class="btn btn-primary">Ver notas</a>
                            </div>
                        </div>
                    </div>
                    <br></br>
                    <div class="col-md-4 mb-4">
                        <div class="card ">
                            <div class="card-body">
                                <h5 class="card-title">Matemáticas</h5>
                                <p class="card-text">Segundo "A"</p>
                                <a href="listaNotas.php?grado=1&curso=1&seccion=1&consultar=1" class="btn btn-primary">Ver notas</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/js/index.js"></script>
</body>

</html>