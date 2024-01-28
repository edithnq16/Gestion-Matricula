<!-- Modal -->

<div class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
  <div class=" modal-dialog modal-lg " style="max-width: 1200px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="nuevoModalLabel">Nueva persona</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../persona/insertarPersona.php" method="post">

          <div class="row">
            <div class="col-md-6 ">
              <label for="nombre" class="form-label">Nombre:</label>
              <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label for="apellido" class="form-label">Apellido:</label>
              <input type="text" name="apellido" id="apellido" class="form-control" required>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <label for="dni" class="form-label">DNI:</label>
              <input type="number" name="dni" id="dni" maxlength="8" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="domicilio" class="form-label">Domicilio:</label>
              <input type="text" name="domicilio" id="domicilio" class="form-control" required>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <label for="telf" class="form-label">Telefono:</label>
              <input type="number" name="telf" id="telf" maxlength="9" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Correo:</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <label for="fechaNacimiento" class="form-label">Fecha Nacimiento:</label>
              <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="genero" class="form-label">Genero:</label>
              <select class="form-select" name="genero" id="genero" aria-label="Selecciona una opción">
                <option selected value="1">MASCULINO</option>
                <option value="0">FEMENINO</option>
              </select>
            </div>
          </div>
          <div class="row mt-3 mb-3">
            <div class="col-md-6">
              <label for="rol" class="form-label">Rol:</label>
              <select class="form-select" name="rol" id="rol" aria-label="Selecciona una opción">
                <?php while ($row = $roles->fetch_assoc()) { ?>
                  <option value="<?= $row['ID'] ?>"><?= $row['Descripcion'] ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>
          </div>



          <input type="hidden" name="identificador" id="identificador" value="">

          <div class="row">
            <div class="col-md-5 mb-3">
              <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script>
  $(document).ready(function() {
    $('input[name="precio"]').change(function() {
      if ($(this).val() === "nuevo") {
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