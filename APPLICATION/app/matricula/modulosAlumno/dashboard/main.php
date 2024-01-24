<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu principal</title>


  <link rel="stylesheet" href="../../../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../assets/css/all.min.css">
  <link rel="stylesheet" href="../../../../assets/css/styles.css">
</head>
<?php
?>

<body>
  <!--Cabecera-->
  <?php include '../cabecera/cabecera.php'; ?>

  <div class="d-flex">
    <!--Barra lateral-->
    <?php include '../lateral/lateral.php'; ?>


    <!--Contenido-->
    <div style="width: 100%;">
      <div class="container py-3">
        <h2 class="text-center">Menu principal</h2>

        <div class="row d-flex justify-content-center">
          <div class="col-md-6 p-3">
            <button class="btn btn-info btn-lg btn-block" style="width: 100%; height:200px;" onclick="window.location.href='../cursos/cursos.php'">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                </svg>
              </div>
              <div>
                Cursos
              </div>
            </button>
          </div>
          <div class="col-md-6 p-3">
            <button class="btn btn-info btn-lg btn-block" style="width: 100%; height:200px;" onclick="window.location.href='../calificaciones/calificaciones.php'">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                  <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z" />
                  <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z" />
                </svg>
              </div>
              <div>
                Calificaciones
              </div>
            </button>
          </div>
          <div class="col-md-6 p-3">
            <button class="btn btn-info btn-lg btn-block" style="width: 100%; height:200px;" onclick="window.location.href='../pagos/pagos.php'">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                  <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                </svg>
              </div>
              <div>
                Pagos
              </div>

            </button>
          </div>
          <div class="col-md-6 p-3">
            <button class="btn btn-info btn-lg btn-block" style="width: 100%; height:200px;" onclick="window.location.href='../matricula/matricula.php'">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                </svg>
              </div>
              <div>
                Matricula
              </div>
            </button>
          </div>


        </div>
      </div>
    </div>
  </div>




  <script src="../../../../assets/js/bootstrap.min.js"></script>
  <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../assets/js/index.js"></script>
</body>

</html>