<script>
   var usuarioId = localStorage.getItem("identificador"); 
</script>
<?php


require '../../../config/database.php';

$descripcion = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$montoID = isset($_POST['montoID']) ? $_POST['montoID'] : '';
$montoPrecio = isset($_POST['montoPrecio']) ? $_POST['montoPrecio'] :'';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
$usuarioId = isset($_POST['identificador']) ? $_POST['identificador'] : '';
$nuevo = isset($_POST['precio']) ? $_POST['precio'] : '';

$sql = '';
$usuario = '';
$queryUsuario = 'SELECT Nombre, Apellido FROM persona WHERE ID = '. "'" .strval($usuarioId) ."'";
$nombreUsuario = $conn->query($queryUsuario);




if ($nombreUsuario === false) {
    header("Location: grado.php?error=105");
} else {
    $row = $nombreUsuario->fetch_assoc();
    if ($row !== null) {
        $usuario = $row['Nombre'] . ' ' . $row['Apellido'];
    } else {
        header("Location: grado.php?error=101");
    }
}

if ($nuevo === "existente") {
    $sql = "INSERT INTO grado( Descripcion, MontoID, Estado, FechaCreacion, UsuarioCreacion)
    VALUES ('$descripcion','$montoID','$estado',NOW(),'$usuario')";
    
} else {
    
    $sqlmonto = "INSERT INTO monto( Descripcion, Monto, Estado, FechaCreacion, UsuarioCreacion)
    VALUES ('$descripcion','$montoPrecio','$estado',NOW(),'$usuario')";

    $resultadoMonto = $conn->query($sqlmonto);

    if ($resultadoMonto) {
        $idMonto = $conn->insert_id;

        $sql = "INSERT INTO grado( Descripcion, MontoID, Estado, FechaCreacion, UsuarioCreacion)
        VALUES ('$descripcion','$idMonto','$estado',NOW(),'$usuario')";
    } else {
        header("Location: grado.php?error=105");
    }
}

$resultado = $conn->query($sql);

if ($resultado) {
    $id = $conn->insert_id;
    header ("Location: grado.php?success=100");
} else {
    header("Location: grado.php?error=105");
}


$conn->close();

exit;
?>