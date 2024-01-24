
<?php
require '../../../config/database.php';

$sqlmatri = "SELECT m.ApoderadoMatricula, bp.NumeroBoleta, bp.MontoBoleta,p.DNI, p.Nombre, p.Apellido, g.Descripcion, bp.Estado FROM matricula m 
INNER JOIN boletapago bp ON bp.ID = m.BoletaID 
INNER JOIN persona p ON m.PersonaID = p.ID
INNER JOIN grado g ON g.ID = m.GradoID";
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
</head>

<body>


<?php include '../cabecera/cabecera.php'; ?>

    <div class="d-flex">
        <!--Barra lateral-->

        <?php include '../lateral/lateral.php'; ?>


        <!--Contenido-->
        <div style="width: 100%;">
            <div class="container py-3">
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
                            <th colspan="1" class="text-center">Estado</th>
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

                                <td >
                                    <?php 
                                        if($row['Descripcion'] === "PR"){
                                            echo '<a href="#" class="btn btn-sm btn-light m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row[\'ID\']; ?>"><i class="fa-solid fa-ban"></i> Cancelar Matrícula</a>';
                                        }
                                        else if ($row['Descripcion'] === "AN"){
                                            echo '<span class="m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row[\'ID\']; ?>"><i class="bi bi-x-circle"></i>ANULADO</span>';
                                        }
                                        else{
                                            echo '<span class="m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row[\'ID\']; ?>"><i class="fa-sharp fa-light fa-money-bill"></i></i>PAGADO</span>';
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