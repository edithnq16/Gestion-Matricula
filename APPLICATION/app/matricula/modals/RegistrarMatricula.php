<!-- Modal -->
<div class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 1200px !important;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="nuevoModalLabel">Nueva matricula</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../seccion/insertarPersona.php" method="post">



          <div class="row align-items-end">
            <div class="col-md-6">
              <label for="dni" class="form-label">Ingresa el DNI:</label>
              <input type="number" name="dni" id="dni" class="form-control" required>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary form-control"><i class="fa-solid fa-magnifying-glass"></i> BUSCAR</button>
            </div>
            <div class="col-md-4">
              <label for="nombre" class="form-label">Nombre completo:</label>
              <input type="text" name="nombre" id="nombre" class="form-control" disabled>
            </div>
          </div>
          <div class="row  mt-3">
            <div class="col-md-6 ">
              <label for="nombre" class="form-label">Apoderado Mat.:</label>
              <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="apellido" class="form-label">Descripcion Mat.:</label>
              <input type="text" name="apellido" id="apellido" class="form-control" required>
            </div>
          </div>

          <div class="row mt-3 mb-3">
            <div class="col-md-6">
              <label for="genero" class="form-label">Grado:</label>
              <select class="form-select" name="genero" id="genero" aria-label="Selecciona una opción">
                <?php while ($row = $grados->fetch_assoc()) { ?>
                  <option value="<?= $row['ID'] ?>"><?= $row['Descripcion'] ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="nombre" class="form-label">Monto Mat.:</label>
              <input type="text" name="nombre" id="nombre" class="form-control" value="0.00" disabled>
            </div>
          </div>

          <div class="row mt-3 mb-3">
          <div class="col-md-6">
              <label for="genero" class="form-label">Seccion:</label>
              <select class="form-select" name="genero" id="genero" aria-label="Selecciona una opción">
                <?php while ($row = $secciones->fetch_assoc()) { ?>
                  <option value="<?= $row['ID'] ?>"><?= $row['Descripcion'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="genero" class="form-label">Cursos:</label>
              <br>
              <div class="btn-group row" role="group" aria-label="Basic checkbox toggle button group">
                <div class="col-md-12">
                  <?php while ($row = $cursos->fetch_assoc()) { ?>
                    <input type="checkbox" class="btn-check" id="<?= $row['ID']; ?>" autocomplete="off">
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