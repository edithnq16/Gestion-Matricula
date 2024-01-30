<!--Modal elimina registro -->

<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header " style="margin: 0 auto;">
                <h1 class="modal-title fs-5" id="eliminarModalLabel">
                    ¿Desea eliminar el registro?</h1>
            </div>
            <div class="modal-body text-center">

                <form action="../curso/EliminarCurso.php" method="post">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="identificador" id="identificador">
                    <button type="submit" class="btn btn-danger">ELIMINAR</button>

                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="close">CANCELAR</button>
                </form>
            </div>
        </div>
    </div>
</div>