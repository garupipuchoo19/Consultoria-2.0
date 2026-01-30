<?php
require_once "../includes/auth.php";
require_once "../includes/conexion.php";

$sql = "INSERT INTO respuestas_admin 
(mensaje_id, admin_id, respuesta) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
  $_POST['mensaje_id'],
  $_SESSION['admin_id'],
  $_POST['respuesta']
]);

$pdo->prepare("UPDATE chatbot_mensajes SET estado='atendido' WHERE id=?")
    ->execute([$_POST['mensaje_id']]);

header("Location: chatbot.php");
