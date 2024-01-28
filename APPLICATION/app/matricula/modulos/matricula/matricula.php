<?php
require '../../../config/database.php';

$sqlmatri = "SELECT m.ID, m.ApoderadoMatricula, bp.NumeroBoleta, bp.MontoBoleta,p.DNI, p.Nombre, p.Apellido, g.Descripcion, bp.Estado FROM matricula m 
INNER JOIN boletapago bp ON bp.ID = m.BoletaID 
INNER JOIN persona p ON m.PersonaID = p.ID
INNER JOIN grado g ON g.ID = m.GradoID ORDER BY m.ID desc";
$matriculas = $conn->query($sqlmatri);


$sqlgrado = "SELECT g.ID, g.Descripcion,m.Monto FROM grado g INNER JOIN monto m ON m.ID=g.MontoID WHERE g.Estado = 1";
$grados = $conn->query($sqlgrado);


$sqlcurso = "SELECT ID, Descripcion FROM curso WHERE Estado = 1";
$cursos = $conn->query($sqlcurso);

$sqlseccion = "SELECT ID, Descripcion FROM seccion WHERE Estado = 1";

$secciones = $conn->query($sqlseccion);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Matricula</title>


    <link rel="stylesheet" href="../../../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../../../assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body>


    <?php include '../cabecera/cabecera.php'; ?>

    <div class="d-flex">
        <!--Barra lateral-->

        <?php include '../lateral/lateral.php'; ?>


        <!--Contenido-->
        <div style="width: 100%;">
            <div class="container py-3">

                <?php
                if (isset($_GET["success"]) && $_GET["success"] == 100) {
                    echo '<p class="text-success";>Éxito: Se realizó la inserción exitosamente.</p>';
                }
                if (isset($_GET["error"]) && $_GET["error"] == 101) {
                    echo '<p class="text-danger";>Error: No se encontró el usuario administrativo, inicia sesión nuevamente.</p>';
                }
                if (isset($_GET["error"]) && $_GET["error"] == 105) {
                    echo '<p class="text-danger";>Error: No se pudo insertar el registro, intentalo nuevamente.</p>';
                }
                if (isset($_GET["error"]) && $_GET["error"] == 106) {
                    echo '<p class="text-danger";>Error: No se pudo insertar el registro, no seleccionó cursos.</p>';
                }
                ?>
                <h2 class="text-center">MATRICULA</h2>

                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i>
                            Nueva Matricula</a>
                    </div>
                </div>

                <table class="table table-sm table-striped table-hover mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Apoderado M.</th>
                            <th>Num. Doc.</th>
                            <th>Monto</th>
                            <th>DNI</th>
                            <th>Nombres</th>
                            <th>Grado</th>

                            <th>Estado</th>

                            <th>Accion</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $matriculas->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['ID']; ?></td>
                                <td><?= $row['ApoderadoMatricula']; ?></td>
                                <td><?= $row['NumeroBoleta']; ?></td>
                                <td><?= $row['MontoBoleta']; ?></td>
                                <td><?= $row['DNI']; ?></td>
                                <td><?= $row['Nombre'] . ' ' . $row['Apellido']; ?></td>
                                <td><?= $row['Descripcion']; ?></td>
                                <td><?php
                                    if ($row['Estado'] === "PE") {
                                        echo 'PENDIENTE';
                                    } else if ($row['Estado'] === "AN") {
                                        echo 'ANULADO';
                                    } else {
                                        echo 'PAGADO';
                                    }


                                    ?></td>
                                <td><a href="#" class="btn btn-sm btn-outline-info text-dark m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row['ID']; ?>">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                                <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                                            </svg>
                                        </div>
                                        DETALLE
                                    </a>
                                    <?php
                                    if ($row['Estado'] === "PE") {
                                        echo '<a href="#" class="btn btn-sm btn-outline-danger text-dark m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row[\'ID\']; ?>"><i class="fa-solid fa-ban"></i>ANULAR</a>';
                                    } else if ($row['Estado'] === "AN") {
                                        echo '<span class="m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row[\'ID\']; ?>"><i class="bi bi-x-circle"></i>ANULADO</span>';
                                    } else {
                                        echo '';
                                    }

                                    ?>

                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <?php include '../../modals/RegistrarMatricula.php'; ?>


    <script src="../../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/js/index.js"></script>
</body>

</html>