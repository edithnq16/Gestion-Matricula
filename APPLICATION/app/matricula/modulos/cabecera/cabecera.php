

<div>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold fs-2" href="#">PLATAFORMA - ADMIN</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form class="container-fluid justify-content-end">
        <button class="btn btn-light me-2 float-end" onclick="cerrarSesion()" type="button">Cerrar sesión</button>
      </form>
    </div>

  </nav>
</div>

<script>
  function cerrarSesion() {
    localStorage.clear();
    
    window.location.href = '../../index.php';
}
</script>