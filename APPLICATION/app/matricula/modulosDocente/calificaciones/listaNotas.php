<?php
require 'funciones.php';


//consulta las materias
$cursos = $conn->prepare("select * from curso");
$cursos->execute();
$cursos = $cursos->fetchAll();

//consulta de grados
$grados = $conn->prepare("select * from grado");
$grados->execute();
$grados = $grados->fetchAll();

//consulta las secciones
$secciones = $conn->prepare("select * from seccion");
$secciones->execute();
$secciones = $secciones->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas</title>
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
                <h2 class="text-center">CALIFICACIONES</h2>
            </div>

            <div class="enlaces">
                <a class="btn btn-primary" href="calificaciones.php" role="button">Inicio</a>
                <a class="btn btn-primary" href="notasVer.php" role="button">Registro de Notas</a>
                <a class="btn btn-primary" href="listaNotas.php" role="button">Consulta de Notas</a>
            </div>

            <div class="body">
                <div class="panel">
                    <h3>Consulta de Notas</h3>
                    <?php
                    if (!isset($_GET['consultar'])) {
                    ?>
                        <p>Seleccione el grado, el curso y la sección</p>
                        <form method="get" class="form" action="listaNotas.php">
                            <label>Seleccione el Grado</label><br>
                            <select name="grado" required>
                                <?php foreach ($grados as $grado) : ?>
                                    <option value="<?php echo $grado['ID'] ?>"><?php echo $grado['Descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <br><br>
                            <label>Seleccione el curso</label><br>
                            <select name="curso" required>
                                <?php foreach ($cursos as $curso) : ?>
                                    <option value="<?php echo $curso['ID'] ?>"><?php echo $curso['Descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <br><br>
                            <label>Seleccione la Sección</label><br><br>
                            <select name="seccion" required>
                                <?php foreach ($secciones as $seccion) : ?>
                                    <option value="<?php echo $seccion['ID'] ?>"><?php echo $seccion['Descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <br><br>
                            <button type="submit" name="consultar" value="1">Consultar Notas</button></a>
                            <br><br>
                        </form>
                    <?php
                    }
                    ?>
                    <hr>

                    <?php
                    if (isset($_GET['consultar'])) {
                        $id_curso = $_GET['curso'];
                        $id_grado = $_GET['grado'];
                        $id_seccion = $_GET['seccion'];

                        //extrayendo el numero de evaluaciones para el curso seleccionada
                        $num_eval = $conn->prepare("SELECT num_evaluaciones from curso where ID = " . $id_curso);
                        $num_eval->execute();
                        $num_eval = $num_eval->fetch();
                        $num_eval = $num_eval['num_evaluaciones'];


                        //mostrando el cuadro de notas de todos los alumnos del grado seleccionado
                        $sqlalumnos = $conn->prepare("SELECT a.ID, a.PersonaID, a.FechaCreacion, a.UsuarioCreacion, a.FechaCreacion,a.FechaModificacion, b.Calificacion, b.Observacion, avg(b.calificacion) 
                        as promedio from alumno as a left join calificacion as b on a.ID = b.AlumnoID
                        WHERE GradoID = " . $id_grado . " and SeccionID = " . $id_seccion . " group by a.ID");
                        $sqlalumnos->execute();
                        $alumnos = $sqlalumnos->fetchAll();
                        // $num_alumnos = $sqlalumnos->rowCount();
                        $promediototal = 0.0;

                    ?>
                        <br>
                        <a href="listaNotas.php"><strong>
                                << Volver</strong></a>
                        <br>
                        <br>


                        <table class="table table-sm table-striped table-hover mt-4">
                            <thead class="table-dark-lg">
                                <tr>
                                    <th>N°</th>
                                    <th>Alumno</th>
                                    <th>Grado</th>
                                    <th>Sección</th>
                                    <?php
                                    for ($i = 1; $i <= $num_eval; $i++) {
                                        echo '<th>Nota ' . $i . '</th>';
                                    }
                                    ?>
                                    <th>Promedio</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <?php foreach ($alumnos as $index => $alumno) : ?>
                                <!-- campos ocultos necesarios para realizar el insert-->
                                <tr>
                                    <td align="center"><?php echo $alumno['ID'] ?></td>
                                    <td><?//php echo $alumno['AlumnoID'] //?></td>
                                    <td><?php echo $alumno['GradoID'] ?></td>
                                    <td><?php echo $alumno['SeccionID'] ?></td>
                                    <?php

                                    //escribiendo las notas en columnas
                                    $notas = $conn->prepare("SELECT ID, Calificacion from calificacion where AlumnoID = " . $alumno['ID'] . " and CursoID = " . $id_curso);
                                    $notas->execute();
                                    $notas = $notas->fetchAll();

                                    foreach ($notas as $eval => $nota) {

                                        echo '<td align="center"><input type="hidden" 
                                            name="Calificacion' . $eval . '" value="' . $nota['Calificacion'] . '" >' . $nota['Calificacion'] . '</td>';
                                    }

                                    echo '<td align="center">' . number_format($alumno['promedio'], 2) . '</td>';
                                    
                                    $promediototal += number_format($alumno['promedio'], 2);
                                    echo '<td>' . $alumno['Observaciones'] . '</td>';
                                    ?>

                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3"><?php
                                                for ($i = 0; $i < $num_eval; $i++) {
                                                    echo '<td><div class="text-center" ID="promedio' . $i . '"><div></td>';
                                                }
                                                ?>
                                <td align="center"><?php echo number_format($promediototal / 4, 2) ?></td>
                            </tr>
                        </table>

                        <br>


                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>


</body>
<script>
    <?php
    for ($i = 0; $i < $num_eval; $i++) {
        echo 'var values' . $i . ' = [];
        var promedio' . $i . ';
    var valor' . $i . ' = 0;
    var Calficacion' . $i . ' = document.getElementsByName("Calificacion' . $i . '");
    for(var i = 0; i < Calificacion' . $i . '.length; i++) {
        valor' . $i . ' += parseFloat(Calificacion' . $i . '[i].value);
    }
    promedio' . $i . ' = (valor' . $i . ' / parseFloat(Calificacion' . $i . '.length));
    document.getElementById("promedio' . $i . '").innerHTML = (promedio' . $i . ').toFixed(2);';
    }
    ?>
</script>

<script src="../../../../assets/js/bootstrap.min.js"></script>
<script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../../../assets/js/index.js"></script>

</html>