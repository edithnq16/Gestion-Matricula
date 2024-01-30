<?php


require '../../../config/database.php';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';

$idCurso = isset($_POST['id']) ? $_POST['id'] : '';
$usuarioId = isset($_POST['identificador']) ? $_POST['identificador'] : '';

$queryUsuario = 'SELECT Nombre, Apellido FROM persona WHERE ID = ' . "'" . strval($usuarioId) . "'";
$nombreUsuario = $conn->query($queryUsuario);


if ($nombreUsuario === false) {
    header("Location: grado.php?error=105");
} else {
    $row = $nombreUsuario->fetch_assoc();
    if ($row !== null) {
        $usuario = $row['Nombre'] . ' ' . $row['Apellido'];



        $queryActualizar = "UPDATE curso SET ESTADO = $estado, Descripcion = '$nombre', FechaModificacion = NOW(), UsuarioModificacion = '$usuario' WHERE Id = $idCurso";
        
        print_r($queryActualizar);
        $curso = $conn->query($queryActualizar);
        if ($curso) {
            header("Location: curso.php?delete=100");
        } else {
            header("Location: curso.php?delete=105");
        }
    } else {
        header("Location: curso.php?error=101");
    }
}
