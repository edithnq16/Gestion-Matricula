
<?php


require '../../../config/database.php';

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
$usuarioId = isset($_POST['identificador']) ? $_POST['identificador'] : '';

$queryUsuario = 'SELECT Nombre, Apellido FROM persona WHERE ID = ' . "'" . strval($usuarioId) . "'";
$nombreUsuario = $conn->query($queryUsuario);

if ($nombreUsuario === false) {
    header("Location: curso.php?error=105");
} else {
    $row = $nombreUsuario->fetch_assoc();
    if ($row !== null) {
        $usuario = $row['Nombre'] . ' ' . $row['Apellido'];

        $sql = "INSERT INTO curso( Descripcion, Estado, FechaCreacion, UsuarioCreacion)
        VALUES ('$nombre','$estado',NOW(),'$usuario')";



        $resultado = $conn->query($sql);

        if ($resultado) {
            $id = $conn->insert_id;
            header("Location: curso.php?success=100");
        } else {
            header("Location: curso.php?error=105");
        }
    } else {
        header("Location: curso.php?error=101");
    }
}




$conn->close();
exit;

?>