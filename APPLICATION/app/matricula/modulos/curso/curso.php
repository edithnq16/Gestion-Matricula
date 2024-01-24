
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
    <title>Panel - Cursos</title>


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
                <h2 class="text-center">CURSOS</h2>

                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i>
                            Nuevo curso</a>
                    </div>
                </div>

                <table class="table table-sm table-striped table-hover mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Fecha Creación</th>
                            <th>Usuario Creación</th>
                            <th>Fecha Modificación</th>
                            <th>Usuario Modificación</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $cursos->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['ID']; ?></td>
                                <td><?= $row['Descripcion']; ?></td>
                                <td><?= $row['Estado'] ==="1" ? "ACTIVO" : "INACTIVO"; ?></td>
                                <td><?= isset($row['FechaCreacion']) ? date('Y-m-d', strtotime($row['FechaCreacion'])) : ''; ?></td>
                                <td><?= $row['UsuarioCreacion']; ?></td>
                                <td><?= isset($row['FechaModificacion']) ? date('Y-m-d', strtotime($row['FechaModificacion'])): ''; ?></td>
                                <td><?= $row['UsuarioModificacion']; ?></td>

                                <td >
                                    <a href="#" class="btn btn-sm btn-light m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row['ID']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

                                    <a href="#" class="btn btn-sm btn-light m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $row['ID']; ?>"><i class="fa-solid fa-trash"></i></i> Eliminar</a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <?php include '../../modals/RegistrarCurso.php'; ?>


    <script src="../../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/js/index.js"></script>
</body>

</html>