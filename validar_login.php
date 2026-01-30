<?php
session_start();
require_once "includes/conexion.php";

$correo = $_POST['correo'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($correo) || empty($password)) {
    header("Location: login.php?error=1");
    exit;
}

$sql = "SELECT * FROM administradores 
        WHERE correo = :correo 
        AND password_hash = SHA2(:password, 256)
        AND activo = 1";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':correo' => $correo,
    ':password' => $password
]);

$admin = $stmt->fetch();

if ($admin) {
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_nombre'] = $admin['nombre'];
    header("Location: admin/dashboard.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}
