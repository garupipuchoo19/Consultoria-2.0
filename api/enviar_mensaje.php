<?php
header('Content-Type: application/json');

// ⚠️ IMPORTANTE: NO mostrar errores como HTML
ini_set('display_errors', 0);
error_reporting(0);

require_once "../includes/conexion.php";

// Leer JSON
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// Validación fuerte
if (!$data || !isset($data['cliente_id'], $data['mensaje'])) {
    echo json_encode([
        "ok" => false,
        "error" => "Datos incompletos"
    ]);
    exit;
}

$cliente_id = (int)$data['cliente_id'];
$mensaje = trim($data['mensaje']);

if ($cliente_id <= 0 || $mensaje === '') {
    echo json_encode([
        "ok" => false,
        "error" => "Datos inválidos"
    ]);
    exit;
}

try {
    $sql = "INSERT INTO chatbot_mensajes 
            (cliente_id, mensaje_usuario, respuesta_bot)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $cliente_id,
        $mensaje,
        "Gracias por tu mensaje, un asesor te responderá pronto 👨‍💼"
    ]);

    echo json_encode([
        "ok" => true,
        "respuesta_bot" => "Gracias por tu mensaje, un asesor te responderá pronto 👨‍💼"
    ]);
} catch (Exception $e) {
    // ⚠️ NUNCA devolver HTML
    echo json_encode([
        "ok" => false,
        "error" => "Error interno al guardar mensaje"
    ]);
}
