<script>
    var usuarioId = localStorage.getItem("identificador");
</script>
<?php


require '../../../config/database.php';

$dni = isset($_POST['dni']) ? $_POST['dni'] : '';
$nombreCompleto = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apoderado = isset($_POST['apoderadoMat']) ? $_POST['apoderadoMat'] : '';
$descripcion = isset($_POST['descripcionMat']) ? $_POST['descripcionMat'] : '';
$seccion = isset($_POST['seccion']) ? $_POST['seccion'] : '';
$grado = isset($_POST['grado']) ? $_POST['grado'] : '';
$cursosSeleccionados = isset($_POST['cursosSeleccionados']) ? $_POST['cursosSeleccionados'] : array();
$usuarioId = isset($_POST['identificador']) ? $_POST['identificador'] : '';
$cursos = '';
$sql = '';
$usuario = '';
$correlativo = '';
$boletaMatricula = '';
$montoMat = '';
$idAlumno = '';

if (!empty($cursosSeleccionados)) {
    foreach ($cursosSeleccionados as $cursoSeleccionado) {
        $cursos .= $cursoSeleccionado . ',';
    }
    $cursoTexto = rtrim($cursos, ',');
    $queryUsuario = 'SELECT Nombre, Apellido FROM persona WHERE ID = ' . "'" . strval($usuarioId) . "'";
    $nombreUsuario = $conn->query($queryUsuario);
    $queryAlumno = 'SELECT ID,Nombre, Apellido FROM persona WHERE DNI= ' . "'" . strval($dni) . "'";
    $nombreAlumno = $conn->query($queryAlumno);
    $queryMonto = "SELECT m.Monto FROM grado g  INNER JOIN monto m ON m.ID = g.MontoID WHERE g.ID = $grado";
    $montoMat = $conn->query($queryMonto);
    $queryCorrelativo = "SELECT Correlativo FROM correlativo WHERE Codigo = 'BM'";
    $correlativo = $conn->query($queryCorrelativo);

    if ($correlativo === false) {
        header("Location: matricula.php?error=105");
    } else {
        $row = $correlativo->fetch_assoc();
        if ($row !== null) {
            $correlativo = $row['Correlativo'];
            print_r($correlativo);
        } else {
            header("Location: grado.php?error=101");
        }
    }
    if ($nombreAlumno === false) {
        header("Location: matricula.php?error=105");
    } else {
        $row = $nombreAlumno->fetch_assoc();
        if ($row !== null) {
            $nombreAlumno = $row['Nombre'] . ' ' . $row['Apellido'];
            $idAlumno = $row['ID'];
        } else {
            header("Location: grado.php?error=101");
        }
    }
    if ($nombreUsuario === false) {
        header("Location: matricula.php?error=105");
    } else {
        $row = $nombreUsuario->fetch_assoc();
        if ($row !== null) {
            $nombreUsuario = $row['Nombre'] . ' ' . $row['Apellido'];
        } else {
            header("Location: grado.php?error=101");
        }
    }
    if ($montoMat === false) {
        header("Location: matricula.php?error=105");
    } else {
        $row = $montoMat->fetch_assoc();
        if ($row !== null) {
            $montoMat = $row['Monto'];
            print_r('<br>' . $montoMat . '<br>');
        } else {
            header("Location: matricula.php?error=101");
        }
    }
    $boletaMatricula = "BM001-" . str_pad($correlativo + 1, 5, '0', STR_PAD_LEFT);
    $sqlBoletaPago = "INSERT INTO boletapago(NumeroBoleta, MontoBoleta, Estado, FechaCreacion, UsuarioCreacion) VALUES('$boletaMatricula',$montoMat,'PE',NOW(), '$nombreUsuario')";
    $matricula = $conn->query($sqlBoletaPago);
    if ($matricula) {
        $idMatricula = $conn->insert_id;
        $sqlCorrelativo = "UPDATE correlativo SET Correlativo = $correlativo+1 WHERE Codigo = 'BM'";
        $upCorrelativo = $conn->query($sqlCorrelativo);

        if ($upCorrelativo) {
            $sqlMatricula = "INSERT INTO matricula (PersonaID, Descripcion, ApoderadoMatricula,GradoID,SeccionID,BoletaID,CursosID,FechaCreacion,UsuarioCreacion)
            VALUES($idAlumno,'$descripcion','$apoderado',$grado,$seccion,$idMatricula,'$cursoTexto',NOW(),'$nombreUsuario')";
            $insertMatricula = $conn->query($sqlMatricula);
            if($insertMatricula){
                header("Location: matricula.php?success=100");
            }
            else{
                header("Location: matricula.php?error=105");
            }
        } else {
        }
    } else {
    }
}
else{
    header("Location: matricula.php?error=106");
}






$conn->close();

?>