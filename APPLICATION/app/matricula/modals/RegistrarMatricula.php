<!-- Modal -->
<div class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 1200px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="nuevoModalLabel">Nueva matricula</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../matricula/insertarMatricula.php" method="post" enctype="multipart/form-data">
          <div class="row align-items-end">
            <div class="col-md-6">
              <label for="dni" class="form-label">Ingresa el DNI:</label>
              <input type="number" name="dni" id="dni" class="form-control" required>
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-primary form-control" id="btnBuscar"><i class="fa-solid fa-magnifying-glass"></i> BUSCAR</button>
            </div>
            <div class="col-md-4">
              <label for="nombre" class="form-label">Nombre completo:</label>
              <input type="text" name="nombre" id="nombre"  class="form-control" disabled>
            </div>
          </div>
          <div class="row  mt-3">
            <div class="col-md-6 ">
              <label for="apoderadoMat" class="form-label">Apoderado Mat.:</label>
              <input type="text" name="apoderadoMat" id="apoderadoMat" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="descripcionMat" class="form-label">Descripcion Mat.:</label>
              <input type="text" name="descripcionMat" id="descripcionMat" class="form-control" required>
            </div>
          </div>
          <div class="row mt-3 mb-3">
            <div class="col-md-6">
              <label for="grado" class="form-label">Grado:</label>
              <select class="form-select" name="grado" id="grado" aria-label="Selecciona una opción">
                <?php while ($row = $grados->fetch_assoc()) { ?>
                  <option value="<?= $row['ID'] ?>" data-monto="<?=$row['Monto'];?>"><?= $row['Descripcion'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="montoMat" class="form-label">Monto Mat.:</label>
              <input type="text" name="montoMat" id="montoMat" class="form-control" disabled>
            </div>
          </div>
          <div class="row mt-3 mb-3">
          <div class="col-md-6">
              <label for="seccion" class="form-label">Seccion:</label>
              <select class="form-select" name="seccion" id="seccion" aria-label="Selecciona una opción">
                <?php while ($row = $secciones->fetch_assoc()) { ?>
                  <option value="<?= $row['ID'] ?>"><?= $row['Descripcion'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="cursos" class="form-label">Cursos:</label>
              <br>
              <div class="btn-group row" role="group" name="cursos" aria-label="Basic checkbox toggle button group">
                <div class="col-md-12">
                  <?php while ($row = $cursos->fetch_assoc()) { ?>
                    <input type="checkbox" class="btn-check" id="<?= $row['ID']; ?>"name="cursosSeleccionados[]" value="<?=$row['ID'];?>" autocomplete="off">
                    <label class="btn btn-outline-primary mt-2" for="<?= $row['ID']; ?>"><?= $row['Descripcion']; ?></label>
                  <?php } ?>
                </div>
              </div>
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

<script>
  $(document).ready(function() {
    var identificador = localStorage.getItem("identificador");
    document.getElementById("identificador").value = identificador;

    
    $("#grado").on("change", function(){
      var gradoSeleccionado = $(this).val();
      var montoSeleccionado = $(this).find(":selected").data("monto");

      $("#montoMat").val(montoSeleccionado || "0.00");
    });
    $('#grado').trigger("change");

    $("#btnBuscar").on("click", function() {
      var dni = $("#dni").val();

      $.ajax({
        type: "POST",
        url: "../matricula/buscarAlumno.php",
        data: { dni: dni },
        success: function(response) {
          $("#nombre").val(response);
        }
      });
    });
  });


</script>
