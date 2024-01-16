<?php
$conn = new mysqli("127.0.0.1", "root", "", "colegio");
if ($conn->connect_error) {
    die("error de conexión" . $conn->connect_error);
}