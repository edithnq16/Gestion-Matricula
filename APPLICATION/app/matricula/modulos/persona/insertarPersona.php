<script>
    var usuarioId = localStorage.getItem("identificador");
</script>
<?php


require '../../../config/database.php';

$descripcion = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$alumnosMax = isset($_POST['alumnosMax']) ? $_POST['alumnosMax'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
$usuarioId = isset($_POST['identificador']) ? $_POST['identificador'] : '';



$sql = '';
$usuario = '';


$queryUsuario = 'SELECT Nombre, Apellido FROM persona WHERE ID = ' . "'" . strval($usuarioId) . "'";
$nombreUsuario = $conn->query($queryUsuario);

if ($nombreUsuario === false) {
    header("Location: seccion.php?error=105");
} else {
    $row = $nombreUsuario->fetch_assoc();
    if ($row !== null) {
        $usuario = $row['Nombre'] . ' ' . $row['Apellido'];
    } else {
        header("Location: seccion.php?error=101");
    }
}

$sql = "INSERT INTO seccion( Descripcion, AlumnosMax, Estado, FechaCreacion, UsuarioCreacion)
    VALUES ('$descripcion','$alumnosMax','$estado',NOW(),'$usuario')";


$resultado = $conn->query($sql);

if ($resultado) {
    $id = $conn->insert_id;
    header("Location: seccion.php?error=100");
} else {
    header("Location: seccion.php?error=105");
}

$conn->close();

exit;
?>