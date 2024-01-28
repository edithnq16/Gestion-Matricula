<?php
require '../../../config/db.php';


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
            <div class="container py-3">
                <h2 class="text-center">CALIFICACIONES</h2>

                <div class="body">
                    <div class="panel">
                        <h3>Consulta de Notas</h3>
                        <?php
                        if (!isset($_GET['consultar'])) {
                        ?>
                            <p>Seleccione el grado, el curso y la sección</p>
                            <form method="get" class="form" action="../../modulosDocente/calificaciones/listaNotas.php">
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
                            $num_eval = $conn->prepare("select num_evaluaciones from curso where id = " . $id_curso);
                            $num_eval->execute();
                            $num_eval = $num_eval->fetch();
                            $num_eval = $num_eval['num_evaluaciones'];


                            //mostrando el cuadro de notas de todos los alumnos del grado seleccionado
                            $sqlalumnos = $conn->prepare("SELECT a.id, a.num_lista, a.apellidos, a.nombres, b.nota,b.observaciones, avg(b.nota) as promedio from alumnos as a left join notas as b on a.id = b.id_persona
                        WHERE id_grado = " . $id_grado . " and id_seccion = " . $id_seccion . " group by a.id");
                            $sqlalumnos->execute();
                            $alumnos = $sqlalumnos->fetchAll();
                            $num_alumnos = $sqlalumnos->rowCount();
                            $promediototal = 0.0;

                        ?>
                            <br>
                            <a href="listaNotas.php"><strong>
                                    << Volver</strong></a>
                            <br>
                            <br>


                            <table class="table table-sm table-striped table-hover mt-4">
                                <thead class="table-dark">
                                    <tr>
                                        <th>N°</th>
                                        <th>Apellidos</th>
                                        <th>Nombres</th>
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
                                        <td align="center"><?php echo $alumno['num_lista'] ?></td>
                                        <td><?php echo $alumno['apellidos'] ?></td>
                                        <td><?php echo $alumno['nombres'] ?></td>
                                        <?php

                                        //escribiendo las notas en columnas
                                        $notas = $conn->prepare("select id, nota from notas where id_persona = " . $alumno['id'] . " and id_curso = " . $id_curso);
                                        $notas->execute();
                                        $notas = $notas->fetchAll();

                                        foreach ($notas as $eval => $nota) {

                                            echo '<td align="center"><input type="hidden" 
                                            name="nota' . $eval . '" value="' . $nota['nota'] . '" >' . $nota['nota'] . '</td>';
                                        }

                                        echo '<td align="center">' . number_format($alumno['promedio'], 2) . '</td>';
                                        //echo '<td><a href="notas.view.php?grado='.$id_grado.'&materia='.$id_materia.'&seccion='.$id_seccion.'">Editar</a> </td>';
                                        $promediototal += number_format($alumno['promedio'], 2);
                                        echo '<td>' . $alumno['observaciones'] . '</td>';
                                        ?>

                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3"><?php
                                                    for ($i = 0; $i < $num_eval; $i++) {
                                                        echo '<td><div class="text-center" id="promedio' . $i . '"><div></td>';
                                                    }
                                                    ?>
                                    <td align="center"><?php echo number_format($promediototal / $num_alumnos, 2) ?></td>
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
    </div>
</body>
<script>
    <?php
    for ($i = 0; $i < $num_eval; $i++) {
        echo 'var values' . $i . ' = [];
        var promedio' . $i . ';
    var valor' . $i . ' = 0;
    var nota' . $i . ' = document.getElementsByName("nota' . $i . '");
    for(var i = 0; i < nota' . $i . '.length; i++) {
        valor' . $i . ' += parseFloat(nota' . $i . '[i].value);
    }
    promedio' . $i . ' = (valor' . $i . ' / parseFloat(nota' . $i . '.length));
    document.getElementById("promedio' . $i . '").innerHTML = (promedio' . $i . ').toFixed(2);';
    }
    ?>
</script>


<!-- fin de contenido -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap JS y Popper.js (necesarios para ciertos componentes de Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



<script src="../../../../assets/js/bootstrap.min.js"></script>
<script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../../../assets/js/index.js"></script>
</body>

</html>