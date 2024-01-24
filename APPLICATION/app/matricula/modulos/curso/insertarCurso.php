
<?php


require '../../config/database.php';

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$montoID = isset($_POST['montoID']) ? $_POST['montoID'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
$usuario = isset($_POST['usuarioID']) ? $_POST['usuarioID'] : '';

$sql = "INSERT INTO curso( Descripcion, MontoID, Estado, FechaCreacion, UsuarioCreacion)
    VALUES ('$nombre','$montoID','$estado',NOW(),'$usuario')";



$resultado = $conn->query($sql);

if ($resultado) {
    $id = $conn->insert_id;

} else {
    echo "Error al ejecutar la consulta: " . $conn->error;
}


$conn->close();
exit;

?>