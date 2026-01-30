<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: admin/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">

<div class="login-container">
    <h2>Acceso Administrador</h2>

    <form action="validar_login.php" method="POST">
        <input type="email" name="correo" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</div>

</body>
</html>
