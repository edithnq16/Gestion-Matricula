<?php

require '../../../config/db.php';

// Verificar si se ha enviado un ID de mensaje para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Mensaje'])) {
    // Obtener el ID del mensaje a eliminar
    $mensaje_id = $_POST['Mensaje'];


    // Preparar la consulta SQL para eliminar el mensaje
    $sql = "DELETE FROM tareas WHERE ID = $mensaje_id";

    // Ejecutar la consulta SQL
    if ($conexion->query($sql) === TRUE) {
        echo "Mensaje eliminado exitosamente";
    } else {
        echo "Error al eliminar el mensaje: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>