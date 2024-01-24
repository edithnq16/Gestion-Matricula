<!-- Modal -->

<div class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="nuevoModalLabel">Nuevo grado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../grado/insertarGrado.php" method="post">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary">
                <input type="radio" name="precio" value="existente"> Precio existente
              </label>

              <label class="btn btn-outline-primary">
                <input type="radio" name="precio" value="nuevo"> Nuevo Precio
              </label>
            </div>

            <div id="nuevoPrecioInput" style="display: none;" class="mt-3">
              <label for="montoPrecio">Ingrese el nuevo precio:</label>
              <input type="text" id="montoPrecio" name="montoPrecio" class="form-control">
            </div>

            <div id="precioExistenteSelect" style="display: none;" class="mt-3">
              <label for="montoID">Monto:</label>
              <select class="form-select" name="montoID" id="montoID" aria-label="Selecciona una opción">
                <?php while ($row = $montos->fetch_assoc()) { ?>
                  <option value="<?= $row['ID'] ?>"><?= $row['Monto'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="estado">Estado:</label>
            <select class="form-select" name="estado" id="estado" aria-label="Selecciona una opción">
              <option selected value="1">ACTIVO</option>
              <option value="0">INACTIVO</option>
            </select>
          </div>
          <input type="hidden" name="identificador" id="identificador" value="">
          <div class="">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script>
  $(document).ready(function(){
    $('input[name="precio"]').change(function(){
      if($(this).val() === "nuevo"){
        $('#nuevoPrecioInput').show();
        $('#precioExistenteSelect').hide();
      } else {
        $('#nuevoPrecioInput').hide();
        $('#precioExistenteSelect').show();
      }
    });
    var identificador = localStorage.getItem("identificador");
    document.getElementById("identificador").value = identificador;
  });



</script>