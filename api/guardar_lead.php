<?php
/* =========================================
   GUARDAR LEAD (CLIENTE DEL CHATBOT)
   - Guarda cliente si no existe
   - Reutiliza cliente si ya existe
   - Envía correo automático de confirmación
   - Devuelve JSON siempre
   ========================================= */

header('Content-Type: application/json');

// No mostrar errores como HTML (rompe el JSON)
ini_set('display_errors', 0);
error_reporting(0);

// Conexión a BD
require_once "../includes/conexion.php";

// Función de correo
require_once "../mail/enviar_correo.php";

// Leer JSON del frontend
$data = json_decode(file_get_contents("php://input"), true);

// Obtener datos (opcionales)
$correo   = isset($data['correo']) ? trim($data['correo']) : '';
$telefono = isset($data['telefono']) ? trim($data['telefono']) : '';

// Validación básica
if ($correo === '' && $telefono === '') {
    echo json_encode([
        "ok" => false,
        "error" => "No se enviaron datos"
    ]);
    exit;
}

try {
    /* =====================================
       1️⃣ BUSCAR CLIENTE EXISTENTE
       ===================================== */
    if ($correo !== '') {
        $sqlBuscar = "SELECT id FROM clientes WHERE correo = ? LIMIT 1";
        $stmtBuscar = $pdo->prepare($sqlBuscar);
        $stmtBuscar->execute([$correo]);
        $cliente = $stmtBuscar->fetch();

        if ($cliente) {
            // Cliente ya existe → reutilizar
            echo json_encode([
                "ok" => true,
                "cliente_id" => $cliente['id']
            ]);
            exit;
        }
    }

    /* =====================================
       2️⃣ INSERTAR NUEVO CLIENTE
       ===================================== */
    $sqlInsert = "INSERT INTO clientes (correo, telefono, origen)
                  VALUES (?, ?, 'chatbot')";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([$correo, $telefono]);

    $clienteId = $pdo->lastInsertId();

    /* =====================================
       3️⃣ ENVIAR CORREO AUTOMÁTICO (OPCIONAL)
       ===================================== */
    if ($correo !== '') {
        // Si falla el correo, NO rompe nada
        enviarCorreoCliente($correo);
    }

    /* =====================================
       4️⃣ RESPUESTA AL FRONTEND
       ===================================== */
    echo json_encode([
        "ok" => true,
        "cliente_id" => $clienteId
    ]);

} catch (Exception $e) {
    echo json_encode([
        "ok" => false,
        "error" => "Error al guardar cliente"
    ]);
}
