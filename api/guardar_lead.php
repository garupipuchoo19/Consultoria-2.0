<?php
require_once "../includes/conexion.php";
$data = json_decode(file_get_contents("php://input"), true);

$sql = "INSERT INTO clientes (correo, telefono, origen) VALUES (?, ?, 'chatbot')";
$stmt = $pdo->prepare($sql);
$stmt->execute([$data['correo'], $data['telefono']]);

echo json_encode([
  "ok"=>true,
  "cliente_id"=>$pdo->lastInsertId()
]);
