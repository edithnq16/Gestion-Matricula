<?php


require '../../config/database.php';

$textdni = isset($_POST['textdni']) ? $_POST['textdni'] : '';

$password = isset($_POST['password']) ? $_POST['password'] : '';
$identificador = '';
$rol = '';
$nombres = '';

$sql = "SELECT PER.ID as ID,PER.Nombre as Nombre, PER.Apellido as Apellido, R.ID as Rol FROM PERSONA PER 
    INNER JOIN USUARIO USU ON PER.ID = USU.PersonaID
    INNER JOIN Rol R ON PER.RolID = R.ID
    WHERE PER.DNI = '$textdni'  AND USU.Password = '$password'";



$resultado = $conn->query($sql);

if ($resultado) {
    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $identificador = $row['ID'];
        $rol = $row['Rol'];
        $nombres = $row['Nombre'] . ' ' . $row['Apellido'];
        echo "<script>localStorage.setItem('identificador', '$identificador');</script>";
        echo "<script>localStorage.setItem('rol', '$rol');</script>";
        echo "<script>localStorage.setItem('nombres', '$nombres');</script>";
    } else {
        header('Location:../index.php');
    }
} else {
}

$conn->close();
if( $identificador > 0){
    if($rol === "1"){
        echo "<script>window.location.href = '../modulosAlumno/dashboard/main.php';</script>";
    }
    else if($rol === "2"){
        echo "<script>window.location.href = '../modulos/dashboard/main.php';</script>";
    }
    else{
        echo "<script>window.location.href = '../modulosDocente/dashboard/main.php';</script>";
    }
}else{
    header('Location:../index.php');
}

exit;
