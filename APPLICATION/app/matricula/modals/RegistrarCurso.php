<!-- Modal -->
<div class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="nuevoModalLabel">Nuevo curso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../modulos/curso/insertarCurso.php" method="post">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
          </div>
         
          <div class="mb-3"> 
          <label for="estado">Estado:</label>
            <select class="form-select" name="estado" id="estado" aria-label="Selecciona una opción">
              <option selected value="1">ACTIVO</option>
              <option value="0">INACTIVO</option>
            </select>
          </div>

          <div class="">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>