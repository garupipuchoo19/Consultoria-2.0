<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<div class="contenedor-login">
    <h2>Iniciar Sesión</h2>

    <form id="formLogin">
        <input type="email" id="correo" placeholder="Correo" required>
        <button type="submit">Entrar</button>
    </form>

    <div id="respuesta"></div>
</div>

<script src="../js/login.js"></script>
</body>
</html>
