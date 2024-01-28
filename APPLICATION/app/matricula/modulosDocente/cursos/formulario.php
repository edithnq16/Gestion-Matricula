<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="../../../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../../../assets/css/styles.css">
</head>
<style>
    /* Estilos del modal */
    .modal {
        display: none;
        /* Ocultar el modal de forma predeterminada */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        /* Fondo semitransparente */

    }

    /* Estilos del contenido del modal */
    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        
    }

    /* Estilos del botón para cerrar el modal */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;

    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<body>


    <?php include '../cabecera/cabecera.php'; ?>

    <div class="d-flex">
        <!--Barra lateral-->

        <?php include '../lateral/lateral.php'; ?>


        <!--Contenido-->
        <div style="width: 100%;">
            <div class="container py-3">
                <h2 class="text-center">CURSO MATEMATICAS</h2>
                <hr>
                <div id="content" class="bg-grey w-100">
                    <section class="bg-light py-4">
                        <div class="container">
                            <br>
                            <div class="col-auto">
                                <a href="cursos.php"><strong>
                                        << Volver</strong></a>
                            </div>
                            <hr>
                            <h2>Enviar Tarea</h2>
                            <form action="formulario.php" method="post">
                                <textarea name="mensaje" rows="4" cols="50" placeholder="Ingrese la tarea"></textarea><br>
                                <input type="submit" value="Enviar Tarea">
                                <div class="row justify-content-end">
                                    <div class="col-auto">
                                        <a href="ver_tareas.php" class="btn btn-primary"> Ver tareas </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <?php
// Verificar si se ha enviado un mensaje
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el mensaje enviado por el profesor
    $mensaje = $_POST['mensaje'];

    // Conectar a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'colegio');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para insertar el mensaje en la base de datos
    $sql = "INSERT INTO tareas (mensaje) VALUES ('$mensaje')";

    // Ejecutar la consulta SQL

    if ($conexion->query($sql) === TRUE):?>
    <div id="myModal" class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close" onclick="cerrarModal()">&times;</span> <!-- Botón para cerrar el modal -->
                <p>Mensaje enviado exitosamente</p>
            </div>
        </div>

    <?php endif;
    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?> 

<script>
    // Función para cerrar el modal
    function cerrarModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>

    <script src="../../../../assets/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/js/index.js"></script>

</body>

</html>