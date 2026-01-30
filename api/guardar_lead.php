<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

require_once "../includes/conexion.php";

$data = json_decode(file_get_contents("php://input"), true);

$correo   = isset($data['correo']) ? trim($data['correo']) : '';
$telefono = isset($data['telefono']) ? trim($data['telefono']) : '';

if ($correo === '' && $telefono === '') {
    echo json_encode([
        "ok" => false,
        "error" => "Datos vacíos"
    ]);
    exit;
}

try {
    /* 1️⃣ Buscar si el cliente ya existe */
    $sqlBuscar = "SELECT id FROM clientes WHERE correo = ? LIMIT 1";
    $stmtBuscar = $pdo->prepare($sqlBuscar);
    $stmtBuscar->execute([$correo]);
    $cliente = $stmtBuscar->fetch();

    if ($cliente) {
        // Cliente ya existe
        echo json_encode([
            "ok" => true,
            "cliente_id" => $cliente['id']
        ]);
        exit;
    }

    /* 2️⃣ Insertar nuevo cliente */
    $sqlInsert = "INSERT INTO clientes (correo, telefono, origen)
                  VALUES (?, ?, 'chatbot')";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([$correo, $telefono]);

    echo json_encode([
        "ok" => true,
        "cliente_id" => $pdo->lastInsertId()
    ]);

} catch (Exception $e) {
    echo json_encode([
        "ok" => false,
        "error" => "Error al guardar cliente"
    ]);
}
