<?php
require '../../../config/database.php';

$sqlgrados = "SELECT p.ID, p.Descripcion,M.monto ,p.Estado, p.FechaCreacion, p.UsuarioCreacion, p.FechaModificacion, p.UsuarioModificacion FROM grado AS p
INNER JOIN monto M on p.MontoID = M.ID";

$grados = $conn->query($sqlgrados);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Grado</title>


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
                ?>
                <h2 class="text-center">GRADOS</h2>

                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i>
                            Nuevo grado</a>
                    </div>
                </div>

                <table class="table table-sm table-striped table-hover mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Fecha Creación</th>
                            <th>Usuario Creación</th>
                            <th>Fecha Modificación</th>
                            <th>Usuario Modificación</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $grados->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['ID']; ?></td>
                                <td><?= $row['Descripcion']; ?></td>
                                <td><?= $row['monto']; ?></td>
                                <td><?= $row['Estado'] == "1" ? "ACTIVO" : "INACTIVO"; ?></td>
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


    <?php

    $sqlmontos = "SELECT p.ID, p.Descripcion,p.Monto ,p.Estado, p.FechaCreacion, p.UsuarioCreacion, p.FechaModificacion, p.UsuarioModificacion FROM monto AS p";
    $montos = $conn->query($sqlmontos);
    ?>
    <?php include '../../modals/RegistrarGrado.php'; ?>

    <script src="../../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/js/index.js"></script>
</body>

</html>