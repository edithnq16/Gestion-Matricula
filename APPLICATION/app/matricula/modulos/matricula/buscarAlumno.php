<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dni"])) {
    $dni = $_POST["dni"];

    $nombre = obtenerNombrePorDNI($dni);
    echo $nombre;
}


function obtenerNombrePorDNI($dni) {

    require '../../../config/database.php';

    $sqlAlumno = "SELECT p.DNI,p.Nombre, p.Apellido FROM persona p INNER JOIN rol r ON p.RolID = r.ID WHERE p.DNI= $dni AND r.Descripcion = 'ALUMNO' ";

    $alumnos = $conn->query($sqlAlumno);



        $datos = $alumnos->fetch_assoc();

        if (isset($datos['DNI'])) {
            return $datos['Nombre'] . ' ' . $datos['Apellido'];;
        } else {
            return  "Alumno no encontrado";
        }

        
    
}

?>