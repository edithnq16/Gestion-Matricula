<?php
if(!$_POST){
    header('location: ../alumnos/alumnos.php ');
}
else {
    //incluimos el archivo para hacer la conexion
    require 'funciones.php';
    
    //Recuperamos los valores que vamos a llenar en la BD
    $id_curso = htmlentities($_POST ['curso']);
    $id_grado = htmlentities($_POST ['grado']);
    $id_seccion = htmlentities($_POST ['seccion']);
    $num_eval = htmlentities($_POST ['num_eval']);
    $num_alumnos = htmlentities($_POST['num_alumnos']);

    //insertar es el nombre del boton guardar que esta en el archivo notas.view.php
    if (isset($_POST['insertar'])){

        /*Recorro el numero de estudiantes*/
        for($i = 0; $i < $num_alumnos; $i++){
            $id_alumno = htmlentities($_POST['AlumnoID' . $i]);
            //por cada estudiante se recorre el numero de evaluaciones para extraer la nota de cada una
                //funcion existeNota en functions.php valida que la nota no exista segun el alumno y la materia
                if(existeNota($id_alumno,$id_curso,$conn) == 0){
                    for($j = 0; $j < $num_eval; $j++) {
                        $nota = htmlentities($_POST['evaluacion' . $j . 'AlumnoID' . $i]);
                        $observaciones = htmlentities($_POST['Observaciones' . $i]);
                        $sql_insert = "INSERT into calificacion (AlumnoID, CursiID, Calificacion, Observacion) values ('$id_alumno', '$id_curso', '$nota','$observaciones' )";
                        $result = $conn->query($sql_insert);
                    }
                }elseif(existeNota($id_alumno,$id_curso,$conn) > 0){
                    //hace una actualizacion o update
                    for($j = 0; $j < $num_eval; $j++) {
                        $id_nota = htmlentities($_POST['idnota' . $j . 'AlumnoID' . $i]);
                        $nota = htmlentities($_POST['evaluacion' . $j . 'AlumnoID' . $i]);
                        $observaciones = htmlentities($_POST['Observaciones' . $i]);
                        $sql_query = "UPDATE calificacion set calificacion = '$nota', Observaciones = '$observaciones' where ID = ".$id_nota;
                        $result = $conn->query($sql_query);
                    }
                }

        }
        if (isset($result)) {
            header('location:notasVer.php?GradoID='.$id_grado.'&CursoID='.$id_curso.'&SeccionID='.$id_seccion.'&revisar=1&info=1');
        } else {
            header('location:notasVer.php?GradoID='.$id_grado.'&CursoID='.$id_curso.'&SeccionID='.$id_seccion.'&revisar=1&err=1');
        }// validación de registro*/

    //sino boton modificar que esta en el archivo alumnoedit.view.php
    }else if (isset($_POST['modificar'])) {
        //capturamos el id alumnos a modificar
            $id_alumno = htmlentities($_POST['id']);
            $result = $conn->query("UPDATE alumno set ID = '$numlista', AlumnoID = '$nombres', GradoID = '$idgrado', SeccionID = '$idseccion', FechaCreacion = '$fecha_crea', UsuarioModificacion = '$usuario_mod 'where ID = " . $id_alumno);
            // if (isset($result)) {
            //     header('location:alumnoedit.view.php?id=' . $id_alumno . '&info=1');
            // } else {
            //     header('location:alumnoedit.view.php?id=' . $id_alumno . '&err=1');
            // }// validación de registro

    }

}

