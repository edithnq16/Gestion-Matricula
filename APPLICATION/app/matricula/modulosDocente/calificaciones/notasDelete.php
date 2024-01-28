<?php
require 'funciones.php';
if($_SESSION['rol'] =='DOCENTE') {
    if (isset($_GET['AlumnoID']) && isset($_GET['CursoID']) && is_numeric($_GET['AlumnoID'])) {
        try {
            $id_alumno = $_GET['AlumnoID'];
            $id_curso = $_GET['CursoID'];
            $alumno = $conn->prepare("DELETE from calificacion where AlumnoID = " . $id_alumno . " and CursoID = " . $id_curso);
            $alumno->execute();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        die('Ha ocurrido un error');
    }
}else{
    header('location:listaNotas.php?err=1');
}
?>