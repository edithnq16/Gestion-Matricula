<?php


require '../../../config/database.php';

$numTarjeta = isset($_POST['numTarjeta']) ? $_POST['numTarjeta'] : '';
$fechaTarjeta = isset($_POST['fechaTarjeta']) ? $_POST['fechaTarjeta'] : '';
$cvvTarjeta = isset($_POST['cvvTarjeta']) ? $_POST['cvvTarjeta'] : '';
$nombresTarjeta = isset($_POST['nombresTarjeta']) ? $_POST['nombresTarjeta'] : '';
$apellidosTarjeta = isset($_POST['apellidosTarjeta']) ? $_POST['apellidosTarjeta'] : '';
$correoTarjeta = isset($_POST['correoTarjeta']) ? $_POST['correoTarjeta'] : '';
$idBoleta = isset($_POST['id']) ? $_POST['id'] : '';
$usuarioId = isset($_POST['identificador']) ? $_POST['identificador'] : '';




$queryUsuario = 'SELECT Nombre, Apellido FROM persona WHERE ID = ' . "'" . strval($usuarioId) . "'";
$nombreUsuario = $conn->query($queryUsuario);

if (!$nombreUsuario) {
    echo 'ERROR';
} else {
    $row = $nombreUsuario->fetch_assoc();
    if ($row !== null) {
        $usuario = $row['Nombre'] . ' ' . $row['Apellido'];

        $queryMonto = "SELECT b.MontoBoleta FROM boletapago b WHERE b.ID = $idBoleta";
        $montoMat = $conn->query($queryMonto);

        if (!$montoMat) {
            echo $queryMonto;
            echo 'ERROR';
        } else {

            $row = $montoMat->fetch_assoc();
            if ($row !== null) {
                $montoMat = $row['MontoBoleta'];

                $FechaExp =  explode('/', $fechaTarjeta);
                $MesExp = $FechaExp[0];
                $AnioExp = $FechaExp[1];

                $queryInsertPago = "INSERT INTO pagos(BoletaID,Monto, ExpMonth, ExpYear, CardNumber, Cvv, Nombres, Apellidos, Email, FechaCreacion, UsuarioCreacion) 
                VALUES ($idBoleta,$montoMat,$MesExp, $AnioExp, '$numTarjeta', $cvvTarjeta, '$nombresTarjeta', '$apellidosTarjeta', '$correoTarjeta', NOW(), '$usuario'  )";
                $queryPago = $conn->query($queryInsertPago);

                if (!$queryPago) {
                    echo $queryInsertPago;
                    echo 'ERROR';
                } else {
                    $queryPagarMatricula = "UPDATE boletapago set Estado = 'CO', FechaPago = NOW() WHERE ID = $idBoleta";
                    $queryPagarResultado = $conn->query($queryPagarMatricula);

                    if (!$queryPagarResultado) {

                        echo 'ERROR';
                    } else {

                        $queryObtenerGradoCurso = "SELECT b.GradoID, b.CursosID,b.SeccionID FROM matricula b WHERE b.BoletaID = $idBoleta";
                        $gradoCurso = $conn->query($queryObtenerGradoCurso);

                        if (!$gradoCurso) {
                            echo 'ERROR';
                        } else {
                            $row = $gradoCurso->fetch_assoc();
                            if ($row !== null) {
                                $gradoID = $row['GradoID'];
                                $Cursos = $row['CursosID'];
                                $seccion = $row['SeccionID'];
                                $CursoExplode =  explode(',', $Cursos);
                                $queryInsertAlumno = "INSERT INTO alumno (PersonaID, GradoID, SeccionID, FechaCreacion, UsuarioCreacion)
                                    VALUES ( $usuarioId, $gradoID,$seccion, NOW(), '$usuario')";
                                $resultadoAlumno = $conn->query($queryInsertAlumno);
                                if ($resultadoAlumno === false) {
                                    echo 'ERROR';
                                } else {
                                    $idAlumno = $conn->insert_id;
                                    foreach ($CursoExplode as $key => $value) {
                                        $queryCursoAlumno = "INSERT INTO cursoalumno (AlumnoID,CursoID,FechaCreacion,UsuarioCreacion)
                                         VALUES ($idAlumno,$value,NOW(),'$usuario')";
                                        $resultadocursoAlumno = $conn->query($queryCursoAlumno);
                                    }
                                    if (!$resultadocursoAlumno) {
                                        echo 'ERROR';
                                    } else {
                                        echo 'OK';
                                    }
                                }
                            } else {
                                echo 'ERROR';
                            }
                        }
                    }
                }
            } else {
                echo 'ERROR';
            }
        }
    } else {
        echo 'ERROR';
    }
}
