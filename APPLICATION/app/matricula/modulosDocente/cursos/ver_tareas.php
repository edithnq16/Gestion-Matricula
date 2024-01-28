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
                                <a href="formulario.php"><strong>
                                        << Volver</strong></a>
                            </div>
                            <br>
                            <h5>Mensajes de Tareas</h5>
                            <hr>
                            <?php
                            // Conexión a la base de datos
                            $conexion = new mysqli('localhost', 'root', '', 'colegio');

                            // Verificar la conexión
                            if ($conexion->connect_error) {
                                die("Error en la conexión a la base de datos: " . $conexion->connect_error);
                            }

                            // Consulta para obtener los mensajes de tareas
                            $sql = "SELECT * FROM tareas ORDER BY fecha_envio DESC";
                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                // Mostrar los mensajes de tareas
                                while ($row = $result->fetch_assoc()) {
                                    echo "<p><strong>ID:</strong> " . $row['ID'] . "</p>";
                                    echo "<p><strong>Fecha de envío:</strong> " . $row['Fecha_envio'] . "</p>";
                                    echo "<p><strong>Persona:</strong> " . $row['PersonaID'] . "</p>";
                                    echo "<p><strong>Tarea:</strong> " . $row['Mensaje'] . "</p>";
                                    echo "<hr>";
                                }
                            } else {
                                echo "No hay mensajes de tareas disponibles.";
                            }

                            // Cerrar la conexión
                            $conexion->close();
                            ?>

                        </div>
                    </section>
                </div>
            </div>

          

            <script src="../../../../assets/js/bootstrap.min.js"></script>
            <script src="../../../../assets/js/bootstrap.bundle.min.js"></script>
            <script src="../../../../assets/js/index.js"></script>





</body>

</html>