<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $nombre = obtenerCursoPorId($id);
    echo $nombre;
}


function obtenerCursoPorId($id) {

    require '../../../config/database.php';

    $sqlCurso = "SELECT p.id,p.Descripcion as nombre, Estado as estado FROM curso as p WHERE p.id= $id ";

    $curso = $conn->query($sqlCurso);



        $datos = $curso->fetch_assoc();

        if (isset($datos['id'])) {
            echo json_encode($datos);
        } else {
            return  "Curso no encontradao";
        }

        
    
}

?>