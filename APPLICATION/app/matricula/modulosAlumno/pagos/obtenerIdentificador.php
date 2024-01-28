<?php

require '../../../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlgrados = "SELECT bp.id, m.Descripcion, bp.NumeroBoleta, bp.MontoBoleta, 
     bp.Estado, g.Descripcion, m.CursosID, m.FechaCreacion as FechaRegistro FROM matricula m 
    INNER JOIN persona p ON m.PersonaID = p.ID 
    INNER JOIN grado g ON g.ID = m.GradoID
    INNER JOIN boletapago bp ON bp.ID = m.BoletaID 
    WHERE p.ID = $id ORDER BY bp.id desc; ";

    $grados = $conn->query($sqlgrados);

    // Puedes enviar el resultado de vuelta al cliente como JSON
    echo json_encode($grados->fetch_all(MYSQLI_ASSOC));
} else {
    // Maneja el caso en el que 'id' no está definido en la solicitud
    echo "Error: 'id' no proporcionado en la solicitud.";
}
