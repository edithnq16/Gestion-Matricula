<?php


require '../../../config/database.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlgrados = "SELECT bp.id, m.Descripcion, bp.NumeroBoleta, bp.MontoBoleta, 
     bp.Estado, g.Descripcion, m.CursosID,p.Nombre,p.Apellido, bp.FechaPago, m.FechaCreacion as FechaRegistro FROM matricula m 
    INNER JOIN persona p ON m.PersonaID = p.ID 
    INNER JOIN grado g ON g.ID = m.GradoID
    INNER JOIN boletapago bp ON bp.ID = m.BoletaID 
    WHERE bp.ID = $id; ";

    $grados = $conn->query($sqlgrados);

    echo json_encode($grados->fetch_all(MYSQLI_ASSOC));
} else {
    echo "Error: 'id' no proporcionado en la solicitud.";
}
?>