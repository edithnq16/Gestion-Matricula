<?php


require '../../../config/database.php';
$idcurso = isset($_POST['id']) ? $_POST['id'] : '';
$usuarioId = isset($_POST['identificador']) ? $_POST['identificador'] : '';
$queryUsuario = 'SELECT Nombre, Apellido FROM persona WHERE ID = ' . "'" . strval($usuarioId) . "'";
$nombreUsuario = $conn->query($queryUsuario);

if ($nombreUsuario === false) {
    header("Location: grado.php?error=105");
} else {
    $row = $nombreUsuario->fetch_assoc();
    if ($row !== null) {
        $usuario = $row['Nombre'] . ' ' . $row['Apellido'];



        $queryEliminar = "UPDATE curso SET ESTADO = 0, FechaModificacion = NOW(), UsuarioModificacion = '$usuario' WHERE Id = $idcurso";
        $curso = $conn->query($queryEliminar);
        if ($curso) {
            header("Location: curso.php?delete=100");
        } else {
            header("Location: curso.php?delete=105");
        }
    } else {
        header("Location: curso.php?error=101");
    }
}
