
<?php


require '../../../config/database.php';

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
$dni = isset($_POST['dni']) ? $_POST['dni'] : '';
$domicilio = isset($_POST['domicilio']) ? $_POST['domicilio'] : '';
$telf = isset($_POST['telf']) ? $_POST['telf'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : '';
$genero = isset($_POST['genero']) ? $_POST['genero'] : '';
$rol = isset($_POST['rol']) ? $_POST['rol'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
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
        header("Location: persona.php?error=101");
    }
}

$sqlInsertarPersona = "INSERT INTO persona( DNI
, Nombre
, Apellido
, FechaNacimiento
, Domicilio
, Genero
, Telefono
, Email
, RolID
, FechaCreacion
, UsuarioCreacion)
VALUES (
    '$dni'
    ,'$nombre'
    ,'$apellido'
    , '$fechaNacimiento'
    , '$domicilio'
    , '$genero'
    , '$telf'
    , '$email'
    , '$rol'
    ,NOW()
    ,'$usuario')";


$resultado = $conn->query($sqlInsertarPersona);
if ($resultado) {
    $id = $conn->insert_id;

    if ($id > 0) {
        $sqlInsertarUsuario = "INSERT INTO Usuario
        (
            PersonaID,RolID,Password,FechaCreacion,UsuarioCreacion
        ) VALUES ($id,$rol,'$password',NOW(),'$usuario')";

        $result = $conn->query($sqlInsertarUsuario);
        if ($result) {

            header("Location: persona.php?success=100");
        }else{
            header("Location: persona.php?error=105");
        }
    } else {
    }
} else {
}

$conn->close();

exit;
?>