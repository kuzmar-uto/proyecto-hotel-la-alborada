<?php
include 'config/conexion.php';
header('Content-Type: application/json');

$result = $conn->query("SELECT * FROM tipos_habitacion ORDER BY nombre");
$tipos = [];
while ($row = $result->fetch_assoc()) {
    $tipos[] = $row;
}
echo json_encode($tipos);
$conn->close();
?>