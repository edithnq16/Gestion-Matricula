<?php
require 'funciones.php';


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
                <h2 class="text-center">CALIFICACIONES</h2>


            </div>

            <div class="enlaces">
                <a class="btn btn-primary" href="calificaciones.php" role="button">Inicio</a>
                <a class="btn btn-primary" href="notasVer.php" role="button">Registro de Notas</a>
                <a class="btn btn-primary" href="listaNotas.php" role="button">Consulta de Notas</a>
            </div>

            <div class="body">
                <div class="panel">
                    <h3>Registro y Modificación Notas</h3>
                    <?php
                    if (!isset($_GET['revisar'])) {
                    ?>

                        <form method="get" class="form" action="notasVer.php">
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
                            <button type="submit" name="revisar" value="1">Ingresar Notas</button> <a class="btn-link" href="listaNotas.php">Consultar Notas</a>
                            <br><br>
                        </form>
                    <?php
                    }
                    ?>
                    <hr>

                    <?php
                    if (isset($_GET['revisar'])) {
                        $id_curso = $_GET['curso'];
                        $id_grado = $_GET['grado'];
                        $id_seccion = $_GET['seccion'];

                        //extrayendo el numero de evaluaciones para esa materia seleccionada
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
                        $num_alumnos = $sqlalumnos->rowCount();

                    ?>
                        <br>
                        <a href="notasVer.php"><strong>
                                << Volver</strong></a>
                        <br>
                        <br>
                        <form action="procesarnota.php" method="post">

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
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <?php foreach ($alumnos as $index => $alumno) : ?>
                                    <!-- campos ocultos necesarios para realizar el insert-->
                                    <input type="hidden" value="<?php echo $num_alumnos ?>" name="num_alumnos">
                                    <input type="hidden" value="<?php echo $alumno['id'] ?>" name="<?php echo 'AlumnoID' . $index ?>">
                                    <input type="hidden" value="<?php echo $num_eval ?>" name="num_eval">
                                    <!-- campos para devolver los parametros en el get y mantener los mismos datos al hacer el header location-->
                                    <input type="hidden" value="<?php echo $id_curso ?>" name="CursoID">
                                    <input type="hidden" value="<?php echo $id_grado ?>" name="GradoID">
                                    <input type="hidden" value="<?php echo $id_seccion ?>" name="SeccionID">
                                    <tr>
                                        <td align="center"><?php echo $alumno['ID'] ?></td>
                                        <td><?php echo $alumno['Apellidos'] ?></td>
                                        <td><?php echo $alumno['Nombres'] ?></td>
                                        <?php
                                        if (existeNota($alumno['id'], $id_curso, $conn) > 0) {
                                            //ya tiene notas registradas
                                            $notas = $conn->prepare("SELECT id, nota from calificacion where AlumnoID = " . $alumno['ID'] . " and CursoID = " . $id_curso);
                                            $notas->execute();
                                            $registrosnotas = $notas->fetchAll();
                                            $num_notas = $notas->rowCount();
                                            foreach ($registrosnotas as $eval => $nota) {
                                                echo '<input type="hidden" value="' . $nota['ID'] . '" name="idnota' . $eval . 'AlumnoID' . $index . '">';
                                                echo '<td><input type="text" maxlength="5" value="' . $nota['nota'] . '" name="evaluacion' . $eval . 'AlumnoID' . $index . '" class="txtnota"></td>';
                                            }
                                            if ($num_eval > $num_notas) {
                                                $dif = $num_eval - $num_notas;

                                                for ($i = $num_notas; $i < $dif + $num_notas; $i++) {
                                                    echo '<input type="hidden" value="' . $nota['id'] . '" name="idnota' . $i . 'AlumnoID' . $index . '">';
                                                    echo '<td><input type="text" maxlength="5" value="' . $nota['nota'] . '" name="evaluacion' . $i . 'AlumnoID' . $index . '" class="txtnota"></td>';
                                                }
                                            }
                                        } else {
                                            //extrayendo el numero de evaluaciones para esa materia seleccionada
                                            for ($i = 0; $i < $num_eval; $i++) {
                                                echo '<td><input type="text" maxlength="5" name="evaluacion' . $i . 'alumno' . $index . '" class="txtnota"></td>';
                                            }
                                        }

                                        echo '<td align="center">' . number_format($alumno['promedio'], 2) . '</td>';

                                        if (existeNota($alumno['id'], $id_curso, $conn) > 0) {
                                            echo '<td><input type="text" maxlength="100" value="' . $alumno['Observaciones'] . '" name="Observaciones' . $index . '" class="txtnota"></td>';
                                        } else {
                                            echo '<td><input type="text" name="Observaciones' . $index . '" class="txtnota"></td>';
                                        }

                                        if (existeNota($alumno['id'], $id_curso, $conn) > 0) {
                                            echo '<td><a href="notaDelete.php?AlumnoID=' . $alumno['ID'] . '&CursoID=' . $id_curso . '">Eliminar</a> </td>';
                                        } else {
                                            echo '<td>Sin notas</td>';
                                        }
                                        ?>
                                    </tr>
                                <?php endforeach; ?>
                                <tr></tr>
                            </table>
                            <br>
                            <button type="submit" name="insertar">Guardar</button> <button type="reset">Limpiar</button> <a class="btn-link" href="listaNotas.php">Consultar Notas</a>
                            <br>
                        </form>


                    <?php }

                    ?>
                    <!--mostrando los mensajes que recibe a traves de los parametros en la url-->
                    <?php
                    if (isset($_GET['err']))
                        echo '<span class="error">Error al almacenar el registro</span>';
                    if (isset($_GET['info']))
                        echo '<span class="success">Registro almacenado correctamente!</span>';
                    ?>

                    </form>
                    <?php
                    if (isset($_GET['err']))
                        echo '<span class="error">Error al guardar</span>';
                    ?>
                </div>
            </div>

            </script>
            <script src="../../../../assets/js/bootstrap.min.js"></script>
            <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
            <script src="../../../../assets/js/index.js"></script>

</body>

</html>