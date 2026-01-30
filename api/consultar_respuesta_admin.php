<?php
require_once "../includes/conexion.php";

$cliente_id = $_GET['cliente_id'] ?? 0;

// buscar la última respuesta del admin para este cliente
$sql = "
SELECT ra.respuesta, ra.fecha
FROM respuestas_admin ra
JOIN chatbot_mensajes cm ON cm.id = ra.mensaje_id
WHERE cm.cliente_id = ?
ORDER BY ra.fecha DESC
LIMIT 1
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$cliente_id]);

$respuesta = $stmt->fetch();

echo json_encode($respuesta ?: []);
