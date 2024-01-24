<?php
require '../../../config/database.php';

$sqlpersonas = "SELECT p.ID, p.DNI, p.Nombre, p.Apellido, p.FechaNacimiento, p.Domicilio, p.Genero, p.Telefono, p.Email, r.Descripcion, p.FechaCreacion, p.UsuarioCreacion, p.FechaModificacion, p.UsuarioModificacion
FROM persona AS p INNER JOIN rol AS r ON r.ID = p.RolID";

$personas = $conn->query($sqlpersonas);


$sqlrol = "SELECT ID, Descripcion, Estado, FechaCreacion, UsuarioCreacion, FechaModificacion, UsuarioModificacion FROM rol";

$roles = $conn->query($sqlrol);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL - PERSONAS</title>


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
                if (isset($_GET["error"]) && $_GET["error"] == 100) {
                    echo '<p class="text-success";>Éxito: Se realizó la inserción exitosamente.</p>';
                }
                if (isset($_GET["error"]) && $_GET["error"] == 101) {
                    echo '<p class="text-danger";>Error: No se encontró el usuario administrativo, inicia sesión nuevamente.</p>';
                }
                if (isset($_GET["error"]) && $_GET["error"] == 105) {
                    echo '<p class="text-danger";>Error: No se pudo insertar el registro, intentalo nuevamente.</p>';
                }
                ?>
                <h2 class="text-center">PERSONAS</h2>

                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i>
                            Nueva persona</a>
                    </div>
                </div>

                <table class="table table-sm table-striped table-hover mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>DNI</th>
                            <th>Nombres y apellidos</th>
                            <th>Fecha Nacimiento</th>
                            <th>Domicilio</th>
                            <th>Genero</th>
                            <th>Telf.</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $personas->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['ID']; ?></td>
                                <td><?= $row['DNI']; ?></td>
                                <td><?= $row['Nombre'] . ' ' . $row['Apellido']; ?></td>
                                <td><?= date('Y-m-d', strtotime($row['FechaNacimiento'])); ?></td>
                                <td><?= $row['Domicilio'];?></td>
                                <td><?= $row['Genero']; ?></td>
                                <td><?= $row['Telefono']; ?></td>
                                <td><?= $row['Email']; ?></td>
                                <td><?= $row['Descripcion']; ?></td>

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



    <?php include '../../modals/RegistrarPersona.php'; ?>

    <script src="../../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/js/index.js"></script>
</body>

</html>