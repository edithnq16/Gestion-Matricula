<!-- Modal -->
<div class="modal fade" id="pagarModal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" style="margin: 0 auto; font-size:15px;" id="nuevoModalLabel">Plataforma de pagos</h5>
            </div>
            <div class="modal-body">
                <form id="formPagar">
                    <div class="row  mt-3">
                        <div class="col-md-12 ">
                            <label for="numTarjeta" class="form-label">Tarjeta de crédito o débito:</label>
                            <input type="text" placeholder="XXXX XXXX XXXX XXXX" name="numTarjeta" id="numTarjeta" class="form-control" required>
                        </div>
                    </div>
                    <div class="row  mb-3">
                        <div class="col-md-6 ">
                            <label for="fechaTarjeta" class="form-label">MM/AA:</label>
                            <input type="text" placeholder="MM/AA" name="fechaTarjeta" id="fechaTarjeta" class="form-control" required>
                        </div>
                        <div class="col-md-6 ">
                            <label for="cvvTarjeta" class="form-label">CVV:</label>
                            <input type="text" placeholder="111" name="cvvTarjeta" id="cvvTarjeta" class="form-control" required>
                        </div>
                    </div>

                    <div class="row  mb-3">
                        <div class="col-md-6 ">
                            <label for="nombresTarjeta" class="form-label">Nombres:</label>
                            <input type="text" placeholder="Ingrese sus datos" name="nombresTarjeta" id="nombresTarjeta" class="form-control" required>
                        </div>
                        <div class="col-md-6 ">
                            <label for="apellidosTarjeta" class="form-label">Apellidos:</label>
                            <input type="text" placeholder="Ingrese sus datos" name="apellidosTarjeta" id="apellidosTarjeta" class="form-control" required>
                        </div>
                    </div>
                    <div class="row  mb-3">
                        <div class="col-md-12">
                            <label for="correoTarjeta" class="form-label">Correo electrónico:</label>
                            <input type="text" placeholder="Ingrese sus datos" name="correoTarjeta" id="correoTarjeta" class="form-control" required>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="identificador" id="identificador">
                    </div>

                    <div class="text-center">
                        <button type="button" id="btnPagar" class="btn btn-primary">Pagar</button>
                    </div>

                </form>

                <div id="mensajeExitoso" class="d-none text-center">
                    <div>
                        Pago exitoso.
                    </div>

                    <button type="button" class="btn btn-primary mt-3" id="btnAceptar" data-bs-dismiss="modal" aria-label="Close">ACEPTAR</button>
                </div>
                <div id="mensajeError" class="d-none text-center">
                    <div>
                        Hubo un error al realizar el pago.
                    </div>
                    <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        var identificador = localStorage.getItem("identificador");
        document.getElementById("identificador").value = identificador;



        $("#btnPagar").on("click", function() {
            var numTarjeta = $("#numTarjeta").val();

            var fechaTarjeta = $("#fechaTarjeta").val();
            var cvvTarjeta = $("#cvvTarjeta").val();
            var nombresTarjeta = $("#nombresTarjeta").val();
            var apellidosTarjeta = $("#apellidosTarjeta").val();
            var correoTarjeta = $("#correoTarjeta").val();
            var id = $("#id").val();



            $.ajax({
                type: "POST",
                url: "../pagos/insertarPagos.php",
                data: {
                    numTarjeta: numTarjeta,
                    fechaTarjeta: fechaTarjeta,
                    cvvTarjeta: cvvTarjeta,
                    nombresTarjeta: nombresTarjeta,
                    apellidosTarjeta: apellidosTarjeta,
                    correoTarjeta: correoTarjeta,
                    id: id,
                    identificador: identificador

                },
                success: function(response) {
                    console.log(response);
                    var formPagar = document.getElementById("formPagar");
                    var mensajeExitoso = document.getElementById("mensajeExitoso");
                    var mensajeError = document.getElementById("mensajeError");
                    if (response === 'OK') {
                        $("#formPagar").removeClass("d-block").addClass("d-none");
                        $("#mensajeExitoso").removeClass("d-none").addClass("d-block");
                    } else {
                        $("#formPagar").removeClass("d-block").addClass("d-none");
                        $("#mensajeExitoso").removeClass("d-block").addClass("d-none");
                        $("#mensajeError").removeClass("d-none").addClass("d-block");
                    }
                }
            });
        });

        $("#btnAceptar").on("click", function() {
            location.reload();
        });
    });
</script>