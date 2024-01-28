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
                <h2 class="text-center">PAGOS</h2>


                <table class="table table-sm table-striped table-hover mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nro Boleta</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpobody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php include '../../modals/PagarCuota.php'; ?>

    <?php include '../../modals/DetalleMatricula.php'; ?>




    <script src="../../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/js/index.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        let pagarModal = document.getElementById('pagarModal');
        let detalleModal = document.getElementById('detalleModal');
        var id = localStorage.getItem("identificador");

        $.ajax({
            type: "GET",
            url: "obtenerIdentificador.php",
            data: {
                id: id
            },
            success: function(response) {
                data = response;
                var tbody = $("#cuerpobody");

                tbody.empty();
                try {
                    response = JSON.parse(response);
                } catch (error) {
                    console.error("Error al intentar convertir la respuesta a array:", error);
                    return;
                }
                if (Array.isArray(response)) {
                    response.forEach(function(row, index) {


                        var iconSvg = row.Estado !== "CO" ?
                            "<svg xmlns='http://www.w3.org/2000/svg' width='26' height='26' fill='currentColor' class='bi bi-credit-card' viewBox='0 0 16 16'>" +
                            "<path d='M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z'/>" +
                            "<path d='M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z'/>" +
                            "</svg>" :
                            "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-card-text' viewBox='0 0 16 16'>" +
                            "<path d='M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z' />" +
                            "<path d='M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5' />" +
                            "</svg>";
                        var newRow = "<tr>" +
                            "<td>" + (index + 1) + "</td>" +
                            "<td>" + row.NumeroBoleta + "</td>" +
                            "<td>" + row.Descripcion + "</td>" +
                            "<td> S/." + row.MontoBoleta + "</td>" +
                            "<td>" + (row.Estado === "CO" ? "PAGADO" : "PENDIENTE") + "</td>" +
                            "<td>" + formatDate(row.FechaRegistro) + "</td>" +
                            "<td class='text-center'>" +
                            "<a href='#' class='btn btn-sm btn-outline-primary text-dark m-1 d-flex flex-column' data-bs-toggle='modal'" + (row.Estado === "CO" ? "data-bs-target='#detalleModal'" : "data-bs-target='#pagarModal'") + "data-bs-id='" + row.id + "'>" +
                            "<div>" +
                            iconSvg +
                            "</div>" +
                            (row.Estado === "CO" ? "DETALLE" : "PAGAR") +
                            "</a>" +
                            "</td>" +
                            "</tr>";
                        tbody.append(newRow);
                    });
                } else {
                    console.error("La respuesta no es un array:", response);
                }
            },
            error: function(error) {
                console.error("Error al obtener datos desde el servidor:", error);
            }
        });


        pagarModal.addEventListener('shown.bs.modal', event => {
            let butoon = event.relatedTarget
            let id = butoon.getAttribute('data-bs-id')
            pagarModal.querySelector('.modal-body #id').value = id
        });
        detalleModal.addEventListener('shown.bs.modal', event => {
            let butoon = event.relatedTarget
            let id = butoon.getAttribute('data-bs-id')
            detalleModal.querySelector('.modal-body #idDetalle').value = id

            $.ajax({
                type: "GET",
                url: "../pagos/detallePago.php",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    var data;

                    try {
                        data = JSON.parse(response);
                    } catch (error) {
                        console.error("Error al intentar convertir la respuesta a array:", error);
                        return;
                    }

                    var tbody = $("#cuerpobodyDetalle");
                    tbody.empty();

                    if (Array.isArray(data) && data.length > 0) {
                        var row = data[0];

                        tbody.append(`
                <tr>
                    <th>Nro Boleta:</th>
                    <td>${row.NumeroBoleta}</td>
                    <th>Descripcion</th>
                    <td>${row.Descripcion}</td>
                </tr>
                <tr>
                    <th>Monto</th>
                    <td>${row.MontoBoleta}</td>
                    <th>Estado</th>
                    <td>${row.Estado === "CO" ? "PAGADO" : "PENDIENTE"}</td>
                </tr>
                <tr>
                    <th>Fecha Registro</th>
                    <td>${row.FechaRegistro=== null ? '' : formatDate(row.FechaRegistro)}</td>
                    <th>Fecha Pago</th>
                    <td>${row.FechaPago === null ? '' : formatDate(row.FechaPago)}</td>
                </tr>
                <tr>
                    <th>Nombres</th>
                    <td>${row.Nombre}</td>
                    <th>Apellidos</th>
                    <td>${row.Apellido}</td>
                </tr>
                <tr class="table-dark">
                    <th colspan="4" class="text-center">Acciones</th>
                </tr>
                <tr>
                    <td colspan="4" class="text-center"><button class="btn btn-primary">Descargar</button></td>
                </tr>
            `);
                    } else {
                        console.error("La respuesta no es un array válido o está vacía.");
                    }
                },
                error: function(error) {
                    console.error("Error al obtener datos desde el servidor:", error);
                }
            });
        });

        function formatDate(dateString) {
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            };
            const formattedDate = new Date(dateString).toLocaleDateString('es-ES', options);
            return formattedDate;
        }
    </script>
</body>

</html>