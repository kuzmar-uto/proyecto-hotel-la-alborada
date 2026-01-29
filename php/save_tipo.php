<?php
include 'config/conexion.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['nombre']) || !isset($data['capacidad']) || !isset($data['precio'])) {
    echo json_encode(["success" => false, "error" => "Campos obligatorios faltantes"]);
    exit;
}

$nombre = $conn->real_escape_string($data['nombre']);
$capacidad = intval($data['capacidad']);
$precio = floatval($data['precio']);
$descripcion = $conn->real_escape_string($data['descripcion'] ?? '');

if (empty($data['id'])) {
    // Insert
    $sql = "INSERT INTO tipos_habitacion (nombre, capacidad, precio, descripcion) VALUES ('$nombre', $capacidad, $precio, '$descripcion')";
} else {
    // Update
    $id = intval($data['id']);
    $sql = "UPDATE tipos_habitacion SET nombre='$nombre', capacidad=$capacidad, precio=$precio, descripcion='$descripcion' WHERE id=$id";
}

if ($conn->query($sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}
$conn->close();
?>