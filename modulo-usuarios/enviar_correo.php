<?php
session_start();
include("../config/conexion.php");

$correo = $_POST["correo"] ?? "";

$stmt = $conexion->prepare("SELECT id_usuario, nombre FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $user = $resultado->fetch_assoc();
    $_SESSION["id_usuario"] = $user["id_usuario"];
    $_SESSION["nombre"] = $user["nombre"];
    echo "ok";
} else {
    echo "Correo no registrado";
}
