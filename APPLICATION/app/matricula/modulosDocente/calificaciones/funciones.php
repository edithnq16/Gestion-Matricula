<?php
//iniciamos la sesion
session_start();

//importamos el archivo que contiene la variable de conexion a la base de datos

require '../../../config/db.php';

function existeNota($id_alumno, $id_curso, $conn){
    $nota = $conn->prepare("SELECT * from calificacion where CursoID = '$id_curso' and PersonaID = '$id_alumno'");
    $nota->execute();
    //si devuelve una fila significa que la nota ya es
    $nota = $nota->rowCount();
    return $nota;
}

?>