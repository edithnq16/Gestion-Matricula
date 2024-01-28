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

    if (isset($_GET['enviado']) && $_GET['enviado'] == 'true') : ?>
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