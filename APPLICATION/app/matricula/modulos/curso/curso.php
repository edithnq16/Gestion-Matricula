<?php
require '../../../config/database.php';

$sqlcursos = "SELECT p.ID, p.Descripcion, p.Estado, p.FechaCreacion, p.UsuarioCreacion, p.FechaModificacion, p.UsuarioModificacion FROM curso AS p WHERE ESTADO = 1";

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
                if (isset($_GET["delete"]) && $_GET["delete"] == 100) {
                    echo '<p class="text-success";>Éxito: Se realizó la eliminación exitosamente.</p>';
                }
                if (isset($_GET["delete"]) && $_GET["delete"] == 105) {
                    echo '<p class="text-danger";>Error: No se pudo eliminar el registro, intentalo nuevamente.</p>';
                }
                ?>
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
                                <td><?= $row['Estado'] === "1" ? "ACTIVO" : "INACTIVO"; ?></td>
                                <td><?= isset($row['FechaCreacion']) ? date('Y-m-d', strtotime($row['FechaCreacion'])) : ''; ?></td>
                                <td><?= $row['UsuarioCreacion']; ?></td>
                                <td><?= isset($row['FechaModificacion']) ? date('Y-m-d', strtotime($row['FechaModificacion'])) : ''; ?></td>
                                <td><?= $row['UsuarioModificacion']; ?></td>

                                <td>
                                    <a href="#" class="btn btn-sm btn-light m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#editarModal" data-bs-id="<?= $row['ID']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

                                    <a href="#" class="btn btn-sm btn-light m-1 d-flex flex-column" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-bs-id="<?= $row['ID']; ?>"><i class="fa-solid fa-trash"></i></i> Eliminar</a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <?php include '../../modals/RegistrarCurso.php'; ?>

    <?php include '../../modals/EditarCurso.php'; ?>

    <?php include '../../modals/ValidarEliminarCurso.php'; ?>


    <script src="../../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/js/index.js"></script>
    <script>
        let editarModal = document.getElementById('editarModal');
        let eliminarModal = document.getElementById('eliminarModal');
        editarModal.addEventListener('hide.bs.modal', event => {
            editarModal.querySelector('.modal-body #nombre').value = ""
            editarModal.querySelector('.modal-body #estado').value = ""
        });

        editarModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');
            let inputNombre = editarModal.querySelector('.modal-body #nombre');
            let inputEstado = editarModal.querySelector('.modal-body #estado');
            let inputId = editarModal.querySelector('.modal-body #id');
            let inputIdentificador = editarModal.querySelector('.modal-body #identificador');
            var identificador = localStorage.getItem("identificador");
            let url = "buscarCurso.php";
            let formData = new FormData();
            formData.append('id', id);

            fetch(url, {
                    method: "POST",
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    inputId.value = data.id;
                    inputNombre.value = data.nombre;
                    inputEstado.value = data.estado;
                    inputIdentificador.value = identificador;
                }).catch(err => console.log(err));
        });

        eliminarModal.addEventListener('shown.bs.modal', event => {
            let butoon = event.relatedTarget
            let id = butoon.getAttribute('data-bs-id')
            
            var identificador = localStorage.getItem("identificador");

            eliminarModal.querySelector('.modal-body #identificador').value = identificador
            eliminarModal.querySelector('.modal-body #id').value = id
        })
    </script>
</body>

</html>