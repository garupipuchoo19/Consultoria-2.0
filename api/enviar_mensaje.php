<?php
require_once "../includes/conexion.php";
$data = json_decode(file_get_contents("php://input"), true);

$mensaje = $data['mensaje'];
$cliente_id = $data['cliente_id'];

// respuesta básica del bot
$respuesta_bot = "Gracias por tu mensaje, un asesor te responderá pronto 👨‍💼";

$sql = "INSERT INTO chatbot_mensajes 
(cliente_id, mensaje_usuario, respuesta_bot) 
VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$cliente_id, $mensaje, $respuesta_bot]);

echo json_encode([
  "respuesta_bot"=>$respuesta_bot
]);
